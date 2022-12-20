<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Image;
use App\Helpers\Metavis;

class BlogController extends Controller
{
    private $path = 'blogs';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Metavis::lyna('admin.blog.index');
    }

    public function trash()
    {
        return Metavis::lyna('admin.blog.trash');
    }

    public function json($show = 'blogs')
    {
        //create json data from blog table
        if ($show == 'blogs') {
            $blogs = Blog::withCount('views as views_count')->get();
        } else {
            $blogs = Blog::onlyTrashed()->get();
        }
        return datatables()->of($blogs)
            ->addColumn('category_name', function ($blog) {
                return $blog->category->title;
            })
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->addColumn('visitor', function ($blog) {
                return '<a href="' . route('analytics.visitor', ['blogs', 'id' => $blog->id]) . '">' . number_format($blog->views_count, 0, '.', '.') . '</a>';
            })
            ->addColumn('status', function ($blog) {
                return $blog->status() == 'Published' ? '<span class="badge badge-light-primary">Published</span>' : '<span class="badge badge-light-warning">Draft</span>';
            })
            ->addColumn('image', function ($blog) {
                return '<img class="rounded" src="' . $blog->_thumbnail() . '" style="max-width: 50px;min-width: 50px;">';
            })
            ->addColumn('action', function ($blog) {
                return '<a href="' . route('blogs.edit', $blog->id) . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('recovery', function ($blog) {
                return '<a href="' . route('blogs.recovery', $blog->id) . '" class="btn btn-sm btn-warning">Recovery</a>';
            })
            ->addColumn('author', function ($blog) {
                return $blog->author->name;
            })
            ->addColumn('created_at', function ($blog) {
                return date('d-m-Y', strtotime($blog->created_at));
            })
            ->addColumn('deleted_at', function ($blog) {
                return date('d-m-Y', strtotime($blog->deleted_at));
            })
            ->rawColumns(['action', 'recovery', 'visitor', 'image', 'status'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Metavis::lyna('admin.blog.create', [
            'categories' => Category::where('type', 'blog')->get(),
            'tags' => Tag::where('type', 'blog')->get(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' =>  ['required', 'unique:blogs', 'alpha_dash'],
            'category' => ['required', 'exists:categories,id', 'integer'],
            'body' => ['required'],
            'status' => ['required', 'in:publish,draft'],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'tags' => ['required', 'array'],
            'ctype' => ['required'],
        ]);
        $blog = new Blog();
        // meta insert
        $blog->meta_title = $request->title;
        $blog->meta_description = Str::limit(strip_tags($request->body), 200);
        $blog->content_type = $request->ctype;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store($this->path);
            $blog->image = $image;
            // resize for thumbnail
            $filename = str_replace($this->path . '/', '', $image);
            $thumbnail = Image::make($request->file('image'))->resize((int) config('app.thumbnail_width'), (int) config('app.thumbnail_height'));
            if (!Storage::exists($this->path . '/thumbnails')) {
                Storage::makeDirectory($this->path . '/thumbnails');
            }
            $thumbnail->save(storage_path('app/public/' . $this->path . '/thumbnails/' . $filename));
            $blog->meta_thumbnail = $this->path . '/thumbnails/' . $filename;
        }
        // main content
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->category_id = $request->category;
        $blog->body = $request->body;
        $blog->author_id = auth()->user()->id;

        // check status publish or draft
        if ($request->status == 'publish') {
            $blog->published_at = now();
        }

        $blog->save();
        $blog->tags()->sync($request->tags);
        // sync tags
        if ($request->btn == 'save and edit') {
            return redirect()->route('blogs.edit', $blog->id)->with('success', 'Blog has been created');
        } else {
            return redirect()->route('blogs.index')->with('success', 'Blog has been created');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Blog $blog)
    {
        return Metavis::lyna('admin.blog.edit', [
            'categories' => Category::where('type', 'blog')->get(),
            'blog' => $blog,
            'tags' => Tag::where('type', 'blog')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' =>  ['required', 'alpha_dash', Rule::unique('blogs')->ignore($id)],
            'category' => ['required', 'exists:categories,id', 'integer'],
            'body' => ['required'],
            'status' => ['required', 'in:publish,draft'],
            'image' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'meta_title' => ['required'],
            'meta_description' => ['required'],
            'tags' => ['required', 'array'],
            'ctype' => ['required'],
        ]);
        $blog = Blog::findOrFail($id);

        // meta insert
        $blog->meta_title = $request->meta_title;
        $blog->meta_description = Str::limit(strip_tags($request->meta_description), 200);
        $blog->meta_keywords = $request->meta_keywords;
        $blog->content_type = $request->ctype;

        $blog->title = $request->title;
        $blog->slug = $request->slug;
        $blog->category_id = $request->category;
        $blog->body = $request->body;
        $blog->author_id = auth()->user()->id;

        if ($request->status == 'publish') {
            $blog->published_at = now();
        } else {
            $blog->published_at = null;
        }

        if ($request->hasFile('image')) {
            if ($blog->image != null) {
                if (\Storage::exists($blog->image)) {
                    \Storage::delete($blog->image);
                }
            }
            if ($blog->meta_thumbnail != null) {
                if (\Storage::exists($blog->meta_thumbnail)) {
                    \Storage::delete($blog->meta_thumbnail);
                }
            }
            $image = $request->file('image')->store($this->path);
            $blog->image = $image;
            // resize for thumbnail
            $filename = str_replace($this->path . '/', '', $image);
            $thumbnail = Image::make($request->file('image'))->resize((int) config('app.thumbnail_width'), (int) config('app.thumbnail_height'));
            if (!Storage::exists($this->path . '/thumbnails')) {
                Storage::makeDirectory($this->path . '/thumbnails');
            }
            $thumbnail->save(storage_path('app/public/' . $this->path . '/thumbnails/' . $filename));
            $blog->meta_thumbnail = $this->path . '/thumbnails/' . $filename;
        }
        $blog->save();
        $blog->tags()->sync($request->tags);
        if ($request->btn == 'save and edit') {
            return redirect()->route('blogs.edit', $blog->id)->with('success', 'Blog has been updated');
        } else {
            return redirect()->route('blogs.index')->with('success', 'Blog has been updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroyall(Request $request)
    {
        $ids = $request->id;
        Blog::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Blogs Deleted successfully."]);
    }

    public function recovery($id)
    {
        Blog::withTrashed()->where('id', $id)->restore();
        return redirect()->route('blogs.trash')->with('success', 'Blog has been recovery');
    }

    public function forcedelete(Request $request)
    {
        $blogs = Blog::onlyTrashed()->whereIn('id', $request->id);
        foreach ($blogs->get() as $blog) {
            if ($blog->image != null) {
                if (\Storage::exists($blog->image)) {
                    \Storage::delete($blog->image);
                }
            }
            if ($blog->meta_thumbnail != null) {
                if (\Storage::exists($blog->meta_thumbnail)) {
                    \Storage::delete($blog->meta_thumbnail);
                }
            }
        }
        $blogs->forceDelete();
        return response()->json(['success' => "Blogs Deleted successfully."]);
    }
}

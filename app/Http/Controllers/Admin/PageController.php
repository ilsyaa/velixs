<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Image;
use App\Helpers\Metavis;

class PageController extends Controller
{
    private $path = 'pages';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Metavis::lyna('admin.pages.index');
    }

    public function json()
    {
        $tags = Page::all();
        return datatables()->of($tags)
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->addColumn('status', function ($pages) {
                return $pages->published_at != null ? '<span class="badge badge-light-primary">Published</span>' : '<span class="badge badge-light-warning">Draft</span>';
            })
            ->addColumn('image', function ($pages) {
                return '<img class="rounded" src="' . $pages->_thumbnail() . '" style="max-width: 50px;min-width: 50px;">';
            })
            ->addColumn('action', function ($pages) {
                return '<a href="' . route('pages.edit', $pages->id) . '" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('author', function ($pages) {
                return $pages->author->name;
            })
            ->addColumn('created_at', function ($pages) {
                return date('d-m-Y', strtotime($pages->created_at));
            })
            ->rawColumns(['action', 'image', 'status'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Metavis::lyna('admin.pages.create');
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
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:pages',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'robots' => 'required',
        ]);
        $page = new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->body = $request->body;
        $page->author_id = auth()->user()->id;


        if ($request->hasFile('image')) {
            // resize image
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            if (!Storage::exists($this->path)) {
                Storage::makeDirectory($this->path);
            }
            $location = storage_path('app/public/' . $this->path . '/' . $filename);
            Image::make($image)->resize((int) config('app.thumbnail_width'), (int) config('app.thumbnail_height'))->save($location);
            $page->meta_thumbnail = $this->path . '/' . $filename;
        }

        $page->meta_title = $request->title;
        $page->meta_description = Str::limit(strip_tags($request->body), 200);
        $page->meta_robots = $request->meta_robots;
        if ($request->status == 'publish') {
            $page->published_at = now();
        }
        $page->meta_robots = $request->robots;

        $page->save();

        if ($request->btn == 'save and edit') {
            return redirect()->route('pages.edit', $page->id)->with('success', 'Page has been created');
        } else {
            return redirect()->route('pages.index')->with('success', 'Page has been created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return Metavis::lyna('admin.pages.edit');
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
            'title' => 'required',
            'slug' => ['required', 'alpha_dash', Rule::unique('pages')->ignore($id)],
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'robots' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'nullable',
        ]);

        $page = Page::findorfail($id);
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->body = $request->body;
        $page->author_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            if ($page->meta_thumbnail != null) {
                if (Storage::exists($page->meta_thumbnail)) {
                    Storage::delete($page->meta_thumbnail);
                }
            }
            // resize image
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            if (!Storage::exists($this->path)) {
                Storage::makeDirectory($this->path);
            }
            $location = storage_path('app/public/' . $this->path . '/' . $filename);
            Image::make($image)->resize((int) config('app.thumbnail_width'), (int) config('app.thumbnail_height'))->save($location);
            $page->meta_thumbnail = $this->path . '/' . $filename;
        }

        $page->meta_title = $request->title;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->meta_robots = $request->meta_robots;

        if ($request->status == 'publish') {
            $page->published_at = now();
        } else {
            $page->published_at = null;
        }

        $page->save();

        if ($request->btn == 'save and edit') {
            return redirect()->route('pages.edit', $page->id)->with('success', 'Page has been updated');
        } else {
            return redirect()->route('pages.index')->with('success', 'Page has been updated');
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
        // delete image
        foreach ($ids as $id) {
            $page = Page::find($id);
            if ($page->meta_thumbnail != null) {
                if (Storage::exists($page->meta_thumbnail)) {
                    Storage::delete($page->meta_thumbnail);
                }
            }
        }
        Page::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Pages Deleted successfully."]);
    }
}

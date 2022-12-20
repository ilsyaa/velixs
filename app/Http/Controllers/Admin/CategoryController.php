<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Helpers\Metavis;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = request()->segment(2);
        return Metavis::lyna('admin.categories.index', [
            'type' => $type == 'blogs' ? 'blog' : 'product',
            'title' => $type == 'blogs' ? 'Blog Categories' : 'Product Categories',
        ]);
    }

    public function json($type)
    {
        // return json data
        return datatables()->of(Category::where('type', $type)->get())
            ->addColumn('action', function ($category) {
                return '<a href="javascript:void(0)" onclick="modaledit(' . $category->id . ')" data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-sm btn-primary">Edit</a>';
            })->addColumn('image', function ($category) {
                return '<img class="rounded" src="' . $category->image() . '" height="32">';
            })->addColumn('responsive_id', function () {
                return '';
            })
            ->rawColumns(['action', 'image'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'slug' => ['required', 'alpha_dash', Rule::unique('categories')->ignore($request->id)->where('type', $request->type)],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        $category = new Category();
        $category->title = $request->title;
        $category->slug = $request->slug;
        $category->type = $request->type;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('category');
            $category->image = $image;
        }
        $category->save();
        if ($request->type == 'blog') {
            return redirect()->route('blogs.categories.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->route('product.categories.index')->with('success', 'Category created successfully.');
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
    public function edit(Category $category)
    {
        // return html view
        return view('admin.categories.edit', [
            'category' => $category,
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
            'title' => 'required',
            'slug' => ['required', 'alpha_dash', Rule::unique('categories')->ignore($id)->where('type', $request->type)],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        $category = Category::findOrFail($id);
        $category->title = $request->title;
        $category->slug = $request->slug;
        if ($request->default_image) {
            if ($category->image) {
                if (Storage::exists($category->image)) {
                    Storage::delete($category->image);
                }
            }
            $category->image = null;
        } else {
            if ($request->hasFile('image')) {
                if ($category->image) {
                    if (Storage::exists($category->image)) {
                        Storage::delete($category->image);
                    }
                }
                $image = $request->file('image')->store('category');
                $category->image = $image;
            }
        }
        $category->save();
        if ($category->type == 'blog') {
            return redirect()->route('blogs.categories.index')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->route('product.categories.index')->with('success', 'Category updated successfully.');
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
        //return susscees
        $ids = $request->id;
        // delete image
        foreach ($ids as $id) {
            $category = Category::findOrFail($id);
            if ($category->image) {
                if (\Storage::exists($category->image)) {
                    \Storage::delete($category->image);
                }
            }
        }
        Category::whereIn('id', $ids)->delete();
        return response()->json(['status' => true, 'message' => 'Categories deleted successfully.']);
    }

    public function destroy($id)
    {
    }
}

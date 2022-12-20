<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Helpers\Metavis;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = request()->segment(2);
        return Metavis::lyna('admin.tags.index', [

            'type' => $type == 'blogs' ? 'blog' : 'product',
            'title' => $type == 'blogs' ? 'Blog Tags' : 'Product Tags',
        ]);
    }
    public function json($type)
    {
        return datatables()->of(Tag::where('type', $type)->get())
            ->addColumn('action', function ($tag) {
                return '<a href="javascript:void(0)" onclick="modaledit(' . $tag->id . ')" data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->rawColumns(['action'])
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
            'name' => 'required',
            'slug' => ['required', Rule::unique('tags')->where('type', $request->type), 'alpha_dash'],
            'type' => 'required',
        ]);
        Tag::create($request->all());
        if ($request->type == 'blog') {
            return redirect()->route('blogs.tags.index')->with('success', 'Tag created successfully');
        } else {
            return redirect()->route('product.tags.index')->with('success', 'Tag created successfully');
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
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', [
            'tag' => $tag
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
            'name' => 'required',
            'slug' => ['required', Rule::unique('tags')->ignore($id)->where('type', $request->type), 'alpha_dash'],
            'type' => 'required',
        ]);
        Tag::find($id)->update($request->all());
        if ($request->type == 'blog') {
            return redirect()->route('blogs.tags.index')->with('success', 'Tag updated successfully');
        } else {
            return redirect()->route('product.tags.index')->with('success', 'Tag updated successfully');
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
        Tag::whereIn('id', $ids)->delete();
        return response()->json(['success' => "Tags Deleted successfully."]);
    }
}

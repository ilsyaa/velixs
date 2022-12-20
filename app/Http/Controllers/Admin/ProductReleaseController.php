<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRelease;
use Illuminate\Http\Request;
use App\Helpers\Metavis;

class ProductReleaseController extends Controller
{
    public function index(Product $product)
    {
        return Metavis::lyna('admin.product.release.index', [
            'title' => 'Product Release Management',
            'product' => $product,
        ]);
    }

    public function json($id)
    {
        $release = ProductRelease::where('product_id', $id)->get();
        return datatables()->of($release)
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->addColumn('action', function ($release) {
                return '<a href="javascript:void(0)" onclick="modaledit(`' . $release->id . '`)" data-bs-toggle="modal" data-bs-target="#modaledit" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addColumn('created_at', function ($release) {
                return date('d-m-Y', strtotime($release->created_at));
            })
            ->rawColumns(['action', 'image', 'status'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'version' => 'required',
            'file_url' => 'required',
        ]);
        ProductRelease::create($request->all());
        return redirect()->back()->with('success', 'Product Release has been added successfully');
    }

    public function edit($id)
    {
        $release = ProductRelease::find($id);
        return view('admin.product.release.edit', [
            'release' => $release,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'version' => 'required',
            'file_url' => 'required',
        ]);
        ProductRelease::find($id)->update($request->all());
        return redirect()->back()->with('success', 'Product Release has been updated successfully');
    }

    public function destroyall(Request $request)
    {
        ProductRelease::whereIn('id', $request->id)->delete();
        return response()->json(['success' => "Product Release Deleted successfully."]);
    }
}

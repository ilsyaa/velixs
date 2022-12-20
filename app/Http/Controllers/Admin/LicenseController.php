<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use App\Helpers\Metavis;

class LicenseController extends Controller
{
    public function index()
    {
        return Metavis::lyna('admin.license.index', [
            'title' => 'Manage License',
        ]);
    }

    public function json()
    {
        return datatables()->of(License::where('used', 'no')->get())
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->addColumn('slug', function ($query) {
                return '<a target="_blank" href="' . route('front.license.detail', $query->slug) . '">' . $query->slug . '</a>';
            })
            ->addColumn('item', function ($query) {
                return $query->item() ? $query->item->name : '';
            })
            ->rawColumns(['slug'])
            ->toJson();
    }

    public function destroyall(Request $request)
    {
        $ids = $request->id;
        License::whereIn('id',  $ids)->delete();
        return response()->json(['status' => true, 'message' => "License Deleted Successfully."]);
    }
}

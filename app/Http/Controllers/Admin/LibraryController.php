<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Helpers\Metavis;
use App\Models\ProductLibrary;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        return Metavis::lyna('admin.product.library.index', [
            'by_user' => request()->query('username', 'all'),
            'product_where' => request()->query('product', 'all'),
            'show' => 'license',
            'title' => 'License Product'
        ]);
    }

    public function trash()
    {
        return Metavis::lyna('admin.product.library.trash', [
            'by_user' => request()->query('username', 'all'),
            'product_where' => request()->query('product', 'all'),
            'show' => 'trash',
            'title' => 'Trash License Product'
        ]);
    }

    public function json($show, $username, $product)
    {
        if ($show == 'license') {
            $library = ProductLibrary::query();
        } else {
            $library = ProductLibrary::onlyTrashed();
        }
        if ($username != 'all') {
            $library->whereHas('user', function ($user) use ($username) {
                $user->where('username', $username);
            });
        }
        if ($product != 'all') {
            $library->where('product_id', $product);
        }

        return datatables()->of($library->get())
            ->addColumn('product_name', function ($lib) {
                return $lib->product->name;
            })
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->addColumn('action', function ($lib) use ($username) {
                return '<a href="' . route('product.license.recoverys', ['id' => $lib->id, 'username' => $username]) . '" class="btn btn-sm btn-warning">Recovery</a>';
            })
            ->addColumn('payment', function ($lib) {
                if ($lib->payment_id != null && $lib->payment_id != 'free' && $lib->payment_id != 'license') {
                    return '<a href="' . route('payment.index', ['payment_id' => '' . $lib->payment->payment_id . '']) . '">' . \Str::upper($lib->payment->payment_method) . '</a>';
                } else {
                    return \Str::upper($lib->payment_method());
                }
            })
            ->addColumn('username', function ($lib) {
                return $lib->user->username;
            })
            ->addColumn('created_at', function ($lib) {
                return date('d-m-Y', strtotime($lib->created_at));
            })
            ->addColumn('deleted_at', function ($lib) {
                return date('d-m-Y', strtotime($lib->deleted_at));
            })
            ->rawColumns(['action', 'payment'])
            ->toJson();
    }

    public function destroyall(Request $request)
    {
        $ids = $request->id;
        ProductLibrary::whereIn('id', $ids)->delete();
        return response()->json(['success' => "License Deleted successfully."]);
    }

    public function recovery($id)
    {
        ProductLibrary::withTrashed()->where('id', $id)->restore();
        return redirect()->route('product.license.recovery', ['username' => request()->query('username'), 'product' => request()->query('product')])->with('success', 'License has been recovery');
    }

    public function forcedelete(Request $request)
    {
        $library = ProductLibrary::onlyTrashed()->whereIn('id', $request->id);
        foreach ($library->get() as $lib) {
            if ($lib->payment_id != null && $lib->payment_id != 'free') {
                $lib->payment->delete();
            }
            License::where('license', $lib->license)->delete();
        }
        $library->forceDelete();
        return response()->json(['success' => "Force Deleted successfully."]);
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Metavis;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductLibrary;
use App\Models\License;

class FLicenseController extends Controller
{
    public function index()
    {
        return Metavis::view('license.index', [
            'license_activity' => ProductLibrary::whereNull('payment_id')->orderBy('created_at', 'desc')->limit(6)->get(),
            'page' => 'index',
            'meta' => [
                'meta_title' => 'License',
                'meta_description' => 'Claim license page, if you have a license to claim you can go here.',
            ]
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'license' => 'required',
        ]);
        $license = License::where(['license' => $request->license, 'used' => 'no'])->first();
        if ($license) {
            return redirect()->route('front.license.detail', $license->slug);
        } else {
            return redirect()->route('front.license.index')->with('error', '<i class="bi bi-app-indicator"></i> License not found.');
        }
    }

    public function detail($slug)
    {
        $license = License::where(['slug' => $slug, 'used' => 'no']);
        if ($license->count() > 0) {
            return Metavis::view('license.index', [
                'license_activity' => ProductLibrary::whereNull('payment_id')->orderBy('created_at', 'desc')->limit(10)->get(),
                'page' => 'detail',
                'license' => $license->first(),
                'meta' => [
                    'meta_title' => 'License',
                    'meta_description' => 'Claim license page, if you have a license to claim you can go here.',
                ]
            ]);
        } else {
            return redirect()->route('front.license.index')->with('error', '<i class="bi bi-app-indicator"></i> License not found');
        }
    }

    public function claim(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $license = License::where(['id' => $request->id, 'used' => 'no'])->first();
        if ($license) {
            if ($license->type == "product") {
                $product = ProductLibrary::where(['product_id' => $license->item_id, 'user_id' => auth()->user()->id])->first();
                if (!$product) {
                    ProductLibrary::create([
                        'user_id' => auth()->user()->id,
                        'product_id' => $license->item_id,
                        'license' => $license->license,
                    ]);
                    License::where('id', $license->id)->update(['used' => 'yes']);
                    return redirect()->route('front.library.index')->with('success', '<i class="bi bi-check2-all"></i> License claimed successfully');
                } else {
                    return redirect()->route('front.library.index')->with('error', '<i class="bi bi-check2-all"></i> You already have this item.');
                }
            }
        } else {
            return redirect()->route('front.license.index')->with('error', '<i class="bi bi-app-indicator"></i> License not found');
        }
    }
}

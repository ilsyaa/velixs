<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductViews;
use App\Helpers\Metavis;
use App\Models\Category;

class FProductController extends Controller
{

    public function index()
    {
        return Metavis::view('products.index', [
            'products_latest' => Product::where('status', '!=', 'draft')->limit(6)->latest()->get(),
            'products_topselling' => Product::__topselling()->where('product_type', 'pay')->get(),
            'category' => Category::where('type', 'product')->get(),
            'meta' => [
                'meta_title' => 'Landing Products | Source Code | HTML Template',
                'meta_description' => 'Discover 1000s of source code & website templates, including responsive and multipurpose Bootstrap templates, email templates & HTML templates.',
            ]
        ]);
    }

    public function category()
    {
        return Metavis::view('products.category', [
            'perpage' => config('app.product_page'),
            'meta' => [
                'meta_title' => 'Explore Products | Source Code',
                'meta_description' => 'Discover 1000s of source code & website templates, including responsive and multipurpose Bootstrap templates, email templates & HTML templates.',
            ]
        ]);
    }

    public function detail(Product $product)
    {
        ProductViews::record($product);
        return Metavis::view('products.detail', [
            'row' => $product,
            'meta' => [
                'meta_title' => $product->name,
                'meta_description' => $product->meta_description,
                'meta_image' => $product->_thumbnail(),
                'meta_type' => 'product',
                'meta_amount' => $product->price_usd,
                'meta_brand' => 'metavis',
            ]
        ]);
    }
}

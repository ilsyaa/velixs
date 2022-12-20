<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Image;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImages;
use App\Models\Tag;
use App\Helpers\Metavis;


class ProductController extends Controller
{
    private $path = 'product';

    public function index()
    {
        return Metavis::lyna('admin.product.index');
    }

    public function trash()
    {
        return Metavis::lyna('admin.product.trash');
    }

    public function json($show = 'products')
    {
        if ($show == 'products') {
            $products = Product::all();
        } else {
            $products = Product::onlyTrashed()->get();
        }
        return datatables()->of($products)
            ->addColumn('category_name', function ($products) {
                return $products->category->title;
            })
            ->addColumn('responsive_id', function () {
                return '';
            })
            ->addColumn('status', function ($products) {
                if ($products->status == 'published') {
                    return '<span class="badge badge-light-primary">Published</span>';
                } else if ($products->status == 'draft') {
                    return '<span class="badge badge-light-warning">Draft</span>';
                } else {
                    return '<span class="badge badge-light-secondary">Archived</span>';
                }
            })
            ->addColumn('product_type', function ($products) {
                if ($products->product_type == 'pay') {
                    return '<span class="badge badge-light-primary">PAY</span>';
                } else {
                    return '<span class="badge badge-light-success">FREE</span>';
                }
            })
            ->addColumn('image', function ($products) {
                return '<img class="rounded" src="' . $products->_thumbnail() . '" style="max-width: 50px;min-width: 50px;">';
            })
            ->addColumn('action', function ($products) {
                return '    <div class="d-inline-flex">
                <a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                        <circle cx="12" cy="12" r="1"></circle>
                        <circle cx="12" cy="5" r="1"></circle>
                        <circle cx="12" cy="19" r="1"></circle>
                    </svg>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="' . route('product.docs', $products->id) . '" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text me-50 font-small-4">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>Documentation
                    </a>
                    <a href="' . route('release.index', $products->id) . '" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive me-50 font-small-4">
                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                            <rect x="1" y="3" width="22" height="5"></rect>
                            <line x1="10" y1="12" x2="14" y2="12"></line>
                        </svg>Manage Release
                    </a>
                    <a href="' . route('product.images', $products->id) . '" class="dropdown-item delete-record">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    Manage Images
                    </a>
                </div>
            </div>
            <a href="' . route('product.edit', $products->id) . '" class="item-edit">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </a>';
            })
            ->addColumn('recovery', function ($products) {
                return '<a href="' . route('product.recovery', $products->id) . '" class="btn btn-sm btn-warning">Recovery</a>';
            })
            ->addColumn('author', function ($products) {
                return $products->author->name;
            })
            ->addColumn('created_at', function ($products) {
                return date('d-m-Y', strtotime($products->created_at));
            })
            ->addColumn('deleted_at', function ($products) {
                return date('d-m-Y', strtotime($products->deleted_at));
            })
            ->addColumn('views_count', function ($products) {
                return "<a style='color: #05ff92' href='" . route('analytics.visitor', ['url' => 'products', 'id' => $products->id]) . "'>" . number_format($products->views()->count(), 0, '.', '.') . "</a>";
            })
            ->rawColumns(['action', 'views_count', 'recovery', 'image', 'status', 'product_type'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Metavis::lyna('admin.product.create', [
            'categories' => Category::where('type', 'product')->get(),
            'tags' => Tag::where('type', 'product')->get(),
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
        // validator if payment_type pay price required
        $request->validate([
            'name' => 'required',
            'slug' => ['required', 'unique:products', 'alpha_dash'],
            'body' => 'required',
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1048'],
            'product_type' => 'required',
            'status' => ['required', 'in:published,draft,archived'],
            'category' => 'required',
            'tags' => ['required', 'array'],
            'live_preview' => ['nullable'],
        ]);

        $product = new Product();

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store($this->path);
            $product->image = $image;
            // resize for thumbnail
            $filename = str_replace($this->path . '/', '', $image);
            $thumbnail = Image::make($request->file('image'))->resize((int) config('app.thumbnail_width'), (int) config('app.thumbnail_height'));
            if (!Storage::exists($this->path . '/thumbnails')) {
                Storage::makeDirectory($this->path . '/thumbnails');
            }
            $thumbnail->save(storage_path('app/public/' . $this->path . '/thumbnails/' . $filename));
            $product->meta_thumbnail = $this->path . '/thumbnails/' . $filename;
        }

        // meta
        $product->meta_title = $request->name;
        $product->meta_description = Str::limit(strip_tags($request->body), 200);

        $product->live_preview = $request->live_preview;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->body = $request->body;

        $product->product_type = $request->product_type;
        $product->price_usd = $request->price_usd ? $request->price_usd : 0;
        $product->price_idr = $request->price_idr ? $request->price_idr : 0;
        $product->discount_idr = $request->discount_idr ? $request->discount_idr : null;
        $product->discount_usd = $request->discount_usd ? $request->discount_usd : null;

        $product->status = $request->status;
        $product->category_id = $request->category;
        $product->author_id = auth()->user()->id;
        $product->save();
        $product->tags()->sync($request->tags);
        // sync tags
        if ($request->btn == 'save and edit') {
            return redirect()->route('product.edit', $product->id)->with('success', 'Product has been created');
        } else {
            return redirect()->route('product.index')->with('success', 'Product has been created');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Metavis::lyna('admin.product.edit', [
            'product' => $product,
            'categories' => Category::where('type', 'product')->get(),
            'tags' => Tag::where('type', 'product')->get(),
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
            'slug' => ['required', Rule::unique('products')->ignore($id), 'alpha_dash'],
            'body' => 'required',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1048'],
            'product_type' => 'required',
            'status' => ['required', 'in:published,draft,archived'],
            'category' => 'required',
            'tags' => ['required', 'array'],
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'nullable',
            'live_preview' => ['nullable'],
        ]);

        $product = Product::findOrFail($id);

        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;

        if ($request->hasFile('image')) {
            if ($product->image != null) {
                if (Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
            }
            if ($product->meta_thumbnail != null) {
                if (Storage::exists($product->meta_thumbnail)) {
                    Storage::delete($product->meta_thumbnail);
                }
            }
            $image = $request->file('image')->store($this->path);
            $product->image = $image;
            // resize for thumbnail
            $filename = str_replace($this->path . '/', '', $image);
            $thumbnail = Image::make($request->file('image'))->resize((int) config('app.thumbnail_width'), (int) config('app.thumbnail_height'));
            if (!Storage::exists($this->path . '/thumbnails')) {
                Storage::makeDirectory($this->path . '/thumbnails');
            }
            $thumbnail->save(storage_path('app/public/' . $this->path . '/thumbnails/' . $filename));
            $product->meta_thumbnail = $this->path . '/thumbnails/' . $filename;
        }

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->body = $request->body;
        $product->live_preview = $request->live_preview;
        $product->product_type = $request->product_type;
        $product->price_usd = $request->price_usd ? $request->price_usd : 0;
        $product->price_idr = $request->price_idr ? $request->price_idr : 0;
        $product->discount_idr = $request->discount_idr ? $request->discount_idr : null;
        $product->discount_usd = $request->discount_usd ? $request->discount_usd : null;

        $product->status = $request->status;
        $product->category_id = $request->category;
        $product->save();
        // sync tags
        $product->tags()->sync($request->tags);
        if ($request->btn == 'save and edit') {
            return redirect()->route('product.edit', $product->id)->with('success', 'Product has been updated');
        } else {
            return redirect()->route('product.index')->with('success', 'Product has been updated');
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
        Product::whereIn('id', $request->id)->delete();
        return response()->json(['success' => "Products Deleted successfully."]);
    }

    public function recovery($id)
    {
        Product::withTrashed()->where('id', $id)->restore();
        return redirect()->route('product.trash')->with('success', 'Products has been recovery');
    }

    public function forcedelete(Request $request)
    {
        $products = Product::onlyTrashed()->whereIn('id', $request->id);
        foreach ($products->get() as $product) {
            if ($product->image) {
                if (Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
            }
            if ($product->meta_thumbnail) {
                if (Storage::exists($product->meta_thumbnail)) {
                    Storage::delete($product->meta_thumbnail);
                }
            }
        }
        $products->forceDelete();
        return response()->json(['success' => "Products Deleted successfully."]);
    }

    public function docs(Product $product)
    {
        return Metavis::lyna('admin.product.docs', [
            'product' => $product,
        ]);
    }

    public function docs_update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->docs = $request->docs;
        $product->save();
        if ($request->btn == 'save and edit') {
            return redirect()->route('product.docs', $product->id)->with('success', 'Docs has been updated');
        } else {
            return redirect()->route('product.index')->with('success', 'Docs has been updated');
        }
    }


    public function images(Product $product)
    {
        if (request()->query('type') == 'json') {
            return datatables()->of(ProductImages::where('product_id', $product->id)->get())
                ->addColumn('responsive_id', function () {
                    return '';
                })
                ->addColumn('image', function ($products) {
                    return '<img class="rounded" src="' . $products->image() . '" style="max-width: 50px;min-width: 50px;">';
                })
                ->addColumn('action', function ($products) {
                    return '<button class="btn btn-primary btn-sm" onclick="imageshow(' . $products->id . ')"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></button>';
                })
                ->addColumn('created_at', function ($products) {
                    return date('d-m-Y', strtotime($products->created_at));
                })
                ->rawColumns(['image', 'action'])
                ->toJson();
        } else {
            return Metavis::lyna('admin.product.images', [
                'product' => $product,
            ]);
        }
    }

    public function images_detail()
    {
        if (request()->query('id')) {
            $product = ProductImages::findOrFail(request()->query('id'));
            return '<img class="rounded" src="' . $product->image() . '" style="max-width: 100%;min-width: 100%;">';
        }
    }

    public function images_store(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image =  $request->file('image')->store($this->path . '/gallery');
            ProductImages::create([
                'product_id' => $id,
                'image' => $image,
            ]);
        }
        return true;
    }

    public function images_destroyall(Request $request)
    {
        $images = ProductImages::whereIn('id', $request->id);
        foreach ($images->get() as $image) {
            if ($image->image) {
                if (Storage::exists($image->image)) {
                    Storage::delete($image->image);
                }
            }
        }
        $images->delete();
        return response()->json(['success' => "Images Deleted successfully."]);
    }
}

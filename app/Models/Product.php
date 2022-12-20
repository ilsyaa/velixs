<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'body',
        'docs',
        'image',
        'price_usd',
        'price_idr',
        'discount',
        'product_type',
        'status',
        'author_id',
        'category_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_thumbnail',
    ];

    // uuid increment
    public $incrementing = false;
    protected $keyType = 'string';

    // uuid auto generate
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) \Str::uuid();
        });
    }

    // soft delete
    protected $dates = ['deleted_at'];

    public function _thumbnail()
    {
        if ($this->meta_thumbnail != null) {
            if (Storage::exists($this->meta_thumbnail)) {
                return asset('storage/' . $this->meta_thumbnail);
            } else {
                return 'https://via.placeholder.com/' . config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') . '.png?text=thumbnail';
            }
        } else {
            return 'https://via.placeholder.com/' . config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') . '.png?text=thumbnail';
        }
    }

    public function _image()
    {
        if ($this->image != null) {
            if (Storage::exists($this->image)) {
                return asset('storage/' . $this->image);
            } else {
                return 'https://via.placeholder.com/' . config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') . '.png?text=thumbnail';
            }
        } else {
            return 'https://via.placeholder.com/' . config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') . '.png?text=thumbnail';
        }
    }

    public function isPurchased($id_product, $user_id)
    {
        return $this->library()->where(['product_id' => $id_product, 'user_id' => $user_id])->count();
    }

    public function after_discount($curreny = 'idr')
    {
        if ($curreny == 'idr') {
            $r = $this->price_idr - ($this->price_idr * $this->discount_idr / 100);
            return number_format($r, 0, ',', '.');
        } else {
            $r = $this->price_usd - ($this->price_usd * $this->discount_usd / 100);
            return number_format($r, 2, '.', '.');
        }
    }

    public static function __topselling()
    {
        return self::join('product_libraries', 'products.id', '=', 'product_libraries.product_id')
            ->selectRaw('products.*, count(product_libraries.product_id) as total')
            ->groupBy('product_libraries.product_id')
            ->orderBy('total', 'desc')
            ->limit(6);
    }

    // relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'products_tags', 'products_id', 'tags_id');
    }

    public function release()
    {
        return $this->hasMany(ProductRelease::class, 'product_id');
    }

    public function views()
    {
        return $this->hasMany(ProductViews::class, 'product_id');
    }

    public function library()
    {
        return $this->hasMany(ProductLibrary::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class, 'product_id')->whereNull('parent_id')->where('status', 'approved');
    }
}

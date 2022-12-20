<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductLibrary extends Model
{
    use HasFactory, SoftDeletes;

    // filabvle
    protected $fillable = [
        'payment_id',
        'product_id',
        'user_id',
        'license',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) \Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function release()
    {
        return $this->belongsTo(ProductRelease::class, 'product_id', 'product_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }

    public function payment_method()
    {
        if ($this->payment_id == null) {
            return 'license';
        } else if ($this->payment_id == 'free') {
            return 'free';
        } else {
            return $this->payment->payment_method;
        }
    }

    // model fungsi

    public static function __get_total()
    {
        return self::join('products', 'products.id', '=', 'product_libraries.product_id')
            ->selectRaw('SUM(products.price_idr) as total_idr, SUM(products.price_usd) as total_usd')
            ->whereNull('product_libraries.payment_id')
            ->orWhere('product_libraries.payment_id', '!=', 'free');
    }

    public static function __income()
    {
        return self::join('products', 'products.id', '=', 'product_libraries.product_id')
            ->selectRaw('SUM(products.price_idr) as total_idr, SUM(products.price_usd) as total_usd,products.name as product_name ,products.slug as product_slug, COUNT(products.id) as total_sales,product_libraries.product_id')
            ->where('products.product_type', 'pay')
            ->groupBy('product_libraries.product_id')
            ->orderBy('total_idr', 'desc');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'payment_type',
        'payment_method',
        'payment_status',
        'payment_amount',
        'payment_currency',
        'payment_country',
        'user_id',
        'product_id'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

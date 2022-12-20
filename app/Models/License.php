<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $fillable = [
        'license',
        'slug',
        'type',
        'item_id',
        'used',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) \Str::uuid();
        });
    }

    public function item()
    {
        if ($this->item_id == null) {
            return;
        }
        if ($this->type == 'product') {
            return $this->belongsTo(Product::class, 'item_id');
        }
        return;
    }
}

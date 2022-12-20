<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blogs_tags', 'tags_id', 'blogs_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_tags', 'tags_id', 'products_id');
    }
}

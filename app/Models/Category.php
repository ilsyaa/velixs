<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'image'
    ];

    // image if null

    public function image()
    {
        if ($this->image) {
            if (Storage::exists($this->image)) {
                return Storage::url($this->image);
            }
        }
        return Storage::url('category/default.jpg');
    }


    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}

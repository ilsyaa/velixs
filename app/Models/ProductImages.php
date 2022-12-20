<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImages extends Model
{
    use HasFactory;

    // filabel
    protected $fillable = [
        'product_id',
        'image',
    ];


    public function image()
    {
        if ($this->image) {
            if (Storage::exists($this->image)) {
                return Storage::url($this->image);
            } else {
                return 'https://via.placeholder.com/800x470.png?text=thumbnail';
            }
        } else {
            return 'https://via.placeholder.com/800x470.png?text=thumbnail';
        }
    }
}

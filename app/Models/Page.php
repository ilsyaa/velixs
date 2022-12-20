<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_robots',
        'meta_thumbnail',
        'published_at',
    ];

    // relationship autho
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

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
}

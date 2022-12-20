<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    // Import softdelete
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['deleted_at', 'published_at', 'created_at', 'updated_at'];

    public function _thumbnail()
    {
        return $this->meta_thumbnail ? asset('storage/' . $this->meta_thumbnail) : 'https://via.placeholder.com/' . config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') . '.png?text=thumbnail';
    }

    public function _image()
    {
        return $this->image ? asset('storage/' . $this->image) : 'https://via.placeholder.com/' . config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') . '.png?text=thumbnail';
    }

    public function status()
    {
        if ($this->published_at == null) {
            return 'Draft';
        } else {
            return 'Published';
        }
    }

    // relationship

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blogs_tags', 'blogs_id', 'tags_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function views()
    {
        return $this->hasMany(BlogView::class, 'blog_id');
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id')->whereNull('parent_id')->where('status', 'approved');
    }
}

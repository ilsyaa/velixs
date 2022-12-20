<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'parent_id',
        'user_id',
        'comment',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id')->where('status', 'approved');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

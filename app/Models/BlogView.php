<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogView extends Model
{
    use HasFactory;

    // filabels
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function insertview($blog)
    {
        $location = \Stevebauman\Location\Facades\Location::get(request()->ip());
        if ($location) {
            $country = $location->countryName;
        } else {
            $country = 'Unknown';
        }
        $Views = new self;
        $agent = new \Jenssegers\Agent\Agent();
        $Views->blog_id = $blog->id;
        $Views->url = request()->url();
        $Views->session_id = request()->getSession()->getId();
        $Views->user_id = (auth()->check()) ? auth()->id() : null;
        $Views->ip = request()->ip();
        $Views->browser = $agent->browser();
        $Views->device = $agent->device();
        $Views->country = $country;
        $Views->save();
    }

    public function check($blog)
    {
        if (auth()->check()) {
            return self::where('blog_id', $blog->id)
                ->where('user_id', auth()->id())
                ->exists();
        } else {
            return self::where('blog_id', $blog->id)
                ->where('session_id', request()->getSession()->getId())
                ->orWhere('ip', request()->ip())
                ->first();
        }
    }

    public static function record($blog)
    {
        $object = new self();
        if (!$object->check($blog)) {
            $object->insertview($blog);
        }
    }


    // model fungsi

    public static function __countBrowser($sort = 'desc')
    {
        return self::selectRaw('browser, count(*) as total')->groupBy('browser')->orderBy("total", $sort);
    }
}

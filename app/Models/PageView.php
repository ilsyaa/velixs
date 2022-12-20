<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class PageView extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_index',
        'url',
        'session_id',
        'user_id',
        'ip',
        'browser',
        'country',
        'device',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function insertview($page_index)
    {
        $location = \Stevebauman\Location\Facades\Location::get(request()->ip());
        if ($location) {
            $country = $location->countryName;
        } else {
            $country = 'Unknown';
        }
        $Views = new self;
        $agent = new Agent();
        $Views->page_index = $page_index;
        $Views->url = request()->url();
        $Views->session_id = request()->getSession()->getId();
        $Views->user_id = (auth()->check()) ? auth()->id() : null;
        $Views->ip = request()->ip();
        $Views->browser = $agent->browser();
        $Views->device = $agent->device();
        $Views->country = $country;
        $Views->save();
    }

    public static function check($page_index)
    {
        if (auth()->check()) {
            return self::where('page_index', $page_index)
                ->where('user_id', auth()->id())
                ->exists();
        } else {
            return self::where('page_index', $page_index)
                ->where('session_id', request()->getSession()->getId())
                ->orWhere('ip', request()->ip())
                ->first();
        }
    }

    public static function record($page_index = 'master')
    {
        if (!self::check($page_index)) {
            self::insertview($page_index);
        }
    }

    public static function __countBrowser($sort = 'desc', $page_index = 'master')
    {
        return self::selectRaw('browser, count(*) as total')
            ->where('page_index', $page_index)
            ->groupBy('browser')
            ->orderBy("total", $sort);
    }
}

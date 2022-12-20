<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

class ProductViews extends Model
{
    use HasFactory;

    // filabels
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function insertview($product)
    {
        $location = \Stevebauman\Location\Facades\Location::get(request()->ip());
        if ($location) {
            $country = $location->countryName;
        } else {
            $country = 'Unknown';
        }
        $Views = new self;
        $agent = new Agent();
        $Views->product_id = $product->id;
        $Views->url = request()->url();
        $Views->session_id = request()->getSession()->getId();
        $Views->user_id = (auth()->check()) ? auth()->id() : null;
        $Views->ip = request()->ip();
        $Views->browser = $agent->browser();
        $Views->device = $agent->device();
        $Views->country = $country;
        $Views->save();
    }

    public static function check($product)
    {
        if (auth()->check()) {
            return self::where('product_id', $product->id)
                ->where('user_id', auth()->id())
                ->exists();
        } else {
            return self::where('product_id', $product->id)
                ->where('session_id', request()->getSession()->getId())
                ->orWhere('ip', request()->ip())
                ->first();
        }
    }

    public static function record($product)
    {
        $object = new self();
        if (!$object->check($product)) {
            $object->insertview($product);
        }
    }


    // model fungsi

    public static function __countBrowser($sort = 'desc')
    {
        return self::selectRaw('browser, count(*) as total')->groupBy('browser')->orderBy("total", $sort);
    }
}

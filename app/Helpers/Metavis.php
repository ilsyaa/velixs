<?php

namespace App\Helpers;

use App\Models\WebSetting;
use App\Models\User;

class Metavis
{
    public static function view($view, $data = [], $merge_data = [])
    {
        $data['websetting'] = WebSetting::first();
        $data['auth_user'] = auth()->user();

        $ua = User::where('last_seen', '>=', date('Y-m-d H:i:s', strtotime('-' . config('app.active_user_interval') . ' minutes')));
        $usercount = (15 - $ua->count());
        if ($usercount <= 0) {
            $usercount = 0;
        }
        $data['user_list'] = User::where('last_seen', '<=', date('Y-m-d H:i:s', strtotime('-' . config('app.active_user_interval') . ' minutes')))
            ->limit($usercount)
            ->orderBy('last_seen', 'desc')
            ->get();
        $data['user_active'] = $ua->get();
        return view('frontend.' . $view, $data, $merge_data);
    }

    public static function lyna($view, $data = [], $merge_data = [])
    {
        $data['websetting'] = WebSetting::first();
        return view($view, $data, $merge_data);
    }

    public static function abort($title, $message, $button = null)
    {
        return self::view('abort', [
            'title' => $title,
            'message' => $message,
            'button' => $button
        ]);
    }

    public static function parse_md($text)
    {
        $text = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $text);
        $text = preg_replace('/<iframe\b[^>]*>(.*?)<\/iframe>/is', "", $text);
        $text = preg_replace('/<object\b[^>]*>(.*?)<\/object>/is', "", $text);
        $text = preg_replace('/<embed\b[^>]*>(.*?)<\/embed>/is', "", $text);
        $text = preg_replace('/<applet\b[^>]*>(.*?)<\/applet>/is', "", $text);
        $text = preg_replace('/<frameset\b[^>]*>(.*?)<\/frameset>/is', "", $text);
        $text = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', "", $text);
        $text = preg_replace('/<link\b[^>]*>(.*?)<\/link>/is', "", $text);
        $text = preg_replace('/<meta\b[^>]*>(.*?)<\/meta>/is', "", $text);
        $text = preg_replace('/<noscript\b[^>]*>(.*?)<\/noscript>/is', "", $text);
        // markdown link
        $text = preg_replace('/\[(.*?)\]\s*\(((?:http:\/\/|https:\/\/)(?:.+))\)/', '<a href="$2">$1</a>', $text);
        return $text;
    }
}

<?php

namespace App\Helpers;

class Ilsyaa
{
    public static function license_unique($prefix = null)
    {
        $prefix = $prefix ? $prefix : config('app.prefix_license');
        do {
            $num_segments = 3;
            $segment_chars = 5;
            $tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
            $license_string = '';
            // Build Default License String
            for ($i = 0; $i < $num_segments; $i++) {
                $segment = '';
                for ($j = 0; $j < $segment_chars; $j++) {
                    $segment .= $tokens[rand(0, strlen($tokens) - 1)];
                }
                $license_string .= $segment;
                if ($i < ($num_segments - 1)) {
                    $license_string .= '-';
                }
            }
            $lc = "$prefix-$license_string";
            $check = \DB::table('licenses')->where("license", $lc)->first();
        } while ($check ? true : false);
        return $lc;
    }

    public static function slug_unique($lenght = 10)
    {
        do {
            $slug = \Str::slug(\Str::random($lenght));
            $check = \DB::table('licenses')->where("slug", $slug)->first();
        } while ($check ? true : false);
        return $slug;
    }

    public static function browsers($agent)
    {
        $browser = "Unknown Browser";
        $browser_array = array(
            '/msie/i' => 'Internet Explorer',
            '/Trident/i' => 'Internet Explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/netscape/i' => 'Netscape',
            '/maxthon/i' => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/ubrowser/i' => 'UC Browser',
            '/mobile/i' => 'Mobile Browser'
        );
        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $agent)) {
                $browser = $value;
            }
        }
        return $browser;
    }
}

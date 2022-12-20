<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebSetting;
use App\Helpers\Metavis;
use Illuminate\Http\Request;

class WebsettingController extends Controller
{
    public function index(Request $request)
    {
        return Metavis::lyna('admin.websetting.general', [
            'tab' => $request->tab ?? 'general',
        ]);
    }

    public function general_update(Request $request)
    {
        $filed = $request->validate([
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'meta_author' => 'required',
            'app_title' => 'required',
        ]);
        $websetting = WebSetting::first();
        $websetting->update($filed);
        return redirect()->route('websetting.index', 'tab=' . $request->tab)->with('success', 'Successfully updated.');
    }

    public function style_update(Request $request)
    {
        $request->validate([
            'logo' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1048'],
            'meta_favicon' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1048'],
            'meta_thumbnail' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1048'],
        ]);
        $websetting = WebSetting::first();
        $websetting->footer = $request->footer;
        if ($request->hasFile('logo')) {
            if ($websetting->logo) {
                if (\Storage::exists($websetting->logo)) {
                    \Storage::delete($websetting->logo);
                }
            }
            $websetting->logo = $request->file('logo')->store('websetting');
        }
        if ($request->hasFile('meta_favicon')) {
            if ($websetting->meta_favicon) {
                if (\Storage::exists($websetting->meta_favicon)) {
                    \Storage::delete($websetting->meta_favicon);
                }
            }
            $websetting->meta_favicon = $request->file('meta_favicon')->store('websetting');
        }
        if ($request->hasFile('meta_thumbnail')) {
            if ($websetting->meta_thumbnail) {
                if (\Storage::exists($websetting->meta_thumbnail)) {
                    \Storage::delete($websetting->meta_thumbnail);
                }
            }
            $websetting->meta_thumbnail = $request->file('meta_thumbnail')->store('websetting');
        }
        $websetting->update();
        return redirect()->route('websetting.index', 'tab=' . $request->tab)->with('success', 'Successfully updated.');
    }

    public function addons_update(Request $request)
    {
        $filed = $request->validate([
            'addons_head' => ['string'],
            'addons_body' => ['string']
        ]);
        $websetting = WebSetting::first();
        $websetting->update($filed);
        return redirect()->route('websetting.index', 'tab=' . $request->tab)->with('success', 'Successfully updated.');
    }

    public function maintenance_update(Request $request)
    {
        $request->validate([
            'maintenance' => ['required', 'string'],
            'maintenance_message' => ['required', 'string']
        ]);
        $websetting = WebSetting::first();
        $websetting->update([
            'maintenance_message' => $request->maintenance_message,
        ]);
        $this->setEnv('APP_MAINTENANCE', $request->maintenance);

        return redirect()->route('websetting.index', 'tab=' . $request->tab)->with('success', 'Successfully updated.');
    }

    public function setEnv($envKey, $envValue)
    {
        $path = app()->environmentFilePath();
        $escaped = preg_quote('=' . env($envKey), '/');
        file_put_contents($path, preg_replace(
            "/^{$envKey}{$escaped}/m",
            "{$envKey}={$envValue}",
            file_get_contents($path)
        ));
        $fp = fopen($path, "r");
        $content = fread($fp, filesize($path));
        fclose($fp);
        if (strpos($content, $envKey . '=' . $envValue) == false && strpos($content, $envKey . '=' . '\"' . $envValue . '\"') == false) {
            file_put_contents($path, $content . "\n" . $envKey . '=' . $envValue);
        }
    }
}

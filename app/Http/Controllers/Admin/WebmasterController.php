<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebMaster;
use App\Helpers\Metavis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebmasterController extends Controller
{
    public function index(Request $request)
    {
        return Metavis::lyna('admin.webmaster.index', [
            'webmaster' => WebMaster::first(),
            'tab' => $request->tab ?? 'general',
        ]);
    }

    public function general(Request $request)
    {
        $request->validate([
            'admin_path' => 'required|alpha_dash',
            'thumbnail_size' => 'required',
            'prefix_license' => 'required',
            'active_user_interval' => 'required',
            'product_perpage' => 'required',
            'blog_perpage' => 'required',
        ]);
        if (config('app.active_user_interval') != $request->active_user_interval) {
            $this->setEnv('ACTIVE_USER_INTERVAL', $request->active_user_interval);
        }
        if (config('app.prefix_license') != $request->prefix_license) {
            $this->setEnv('PREFIX_LICENSE', $request->prefix_license);
        }
        if (config('app.product_page') != $request->product_perpage) {
            $this->setEnv('PRODUCT_PAGE', $request->product_perpage);
        }
        if (config('app.blog_page') != $request->blog_perpage) {
            $this->setEnv('BLOG_PAGE', $request->blog_perpage);
        }
        if (config('app.thumbnail_width') . 'x' . config('app.thumbnail_height') != $request->thumbnail_size) {
            $thumbnail_size = explode('x', $request->thumbnail_size);
            $request->merge([
                'thumbnail_width' => $thumbnail_size[0],
                'thumbnail_height' => $thumbnail_size[1],
            ]);
            $this->setEnv('THUMBNAIL_WIDTH', $thumbnail_size[0]);
            $this->setEnv('THUMBNAIL_HEIGHT', $thumbnail_size[1]);
        }
        if (config('app.admin_path') != $request->admin_path) {
            $this->setEnv('ADMIN_PATH', $request->admin_path);
            return redirect()->to($request->admin_path . '/webmaster', ['tab' => 'general'])->with('success', 'Admin path changed successfully');
        }
        return redirect()->route('webmaster.index', ['tab' => 'general'])->with('success', 'Admin path not changed');
    }

    public function smtp(Request $request)
    {
        $request->validate([
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required',
        ]);
        // if (config('mail.mailers.smtp.driver') != $request->mail_driver) {
        //     $this->setEnv('MAIL_DRIVER', $request->mail_driver);
        // }
        if (config('mail.mailers.smtp.host') != $request->mail_host) {
            $this->setEnv('MAIL_HOST', $request->mail_host);
        }
        if (config('mail.mailers.smtp.port') != $request->mail_port) {
            $this->setEnv('MAIL_PORT', $request->mail_port);
        }
        if (config('mail.mailers.smtp.username') != $request->mail_username) {
            $this->setEnv('MAIL_USERNAME', $request->mail_username);
        }
        if (config('mail.mailers.smtp.password') != $request->mail_password) {
            $this->setEnv('MAIL_PASSWORD', $request->mail_password);
        }
        if (config('mail.mailers.smtp.encryption') != $request->mail_encryption) {
            $this->setEnv('MAIL_ENCRYPTION', $request->mail_encryption);
        }
        if (config('mail.mailers.smtp.from.address') != $request->mail_from_address) {
            $this->setEnv('MAIL_FROM_ADDRESS', $request->mail_from_address);
        }
        // if (config('mail.mailers.smtp.from.name') != $request->mail_from_name) {
        //     $this->setEnv('MAIL_FROM_NAME', $request->mail_from_name);
        // }
        return redirect()->route('webmaster.index', ['tab' => 'smtp'])->with('success', 'SMTP settings updated successfully');
    }

    public function payment(Request $request)
    {
        $request->validate([
            'whatsapp' => ['string', 'required'],
            'whatsapp_message' => ['string'],
            'paypal_status' => ['required'],
            'paypal_mode' => ['required'],
            'sandbox_client_id' => ['nullable'],
            'sandbox_client_secret' => ['nullable'],
            'live_client_id' => ['nullable'],
            'live_client_secret' => ['nullable'],
        ]);
        $webmaster = WebMaster::first();
        $webmaster->payment_whatsapp = $request->whatsapp;
        $webmaster->payment_whatsapp_message = $request->whatsapp_message;
        $webmaster->paypal_status = $request->paypal_status;
        $webmaster->paypal_mode = $request->paypal_mode;
        $webmaster->paypal_sandbox_client_id = $request->sandbox_client_id;
        $webmaster->paypal_sandbox_client_secret = $request->sandbox_client_secret;
        $webmaster->paypal_live_client_id = $request->live_client_id;
        $webmaster->paypal_live_client_secret = $request->live_client_secret;
        $webmaster->update();
        return redirect()->route('webmaster.index', ['tab' => 'payment'])->with('success', 'Payment settings updated successfully');
    }

    public function test_smtp()
    {
        Mail::to('admin@gmail.com')->send(new \App\Mail\TestSmtp([
            'name' => 'Testing Kirim Email',
            'body' => 'Ini adalah email testing',
        ]));
        // check smtp connect
        if (Mail::flushMacros()) {
            return redirect()->route('webmaster.index', ['tab' => 'smtp'])->with('success', 'SMTP Test Failed');
        } else {
            return redirect()->route('webmaster.index', ['tab' => 'smtp'])->with('success', 'SMTP Test Success');
        }
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

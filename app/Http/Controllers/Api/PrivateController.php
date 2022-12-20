<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Helpers\Notify;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

class PrivateController extends Controller
{
    public $secret_key = '123';

    public function whatsapp_verify(Request $request)
    {
        if ($this->secret_key !== $request->secret_key) {
            return ApiFormatter::error([], "Invalid Secret Key", 401);
        }
        $validator = \Validator::make($request->all(),  [
            'whatsapp' => 'required',
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return ApiFormatter::error($validator->errors(), 'Validation Error', 422);
        }
        if (RateLimiter::tooManyAttempts('wai:' . $request->whatsapp, 3)) {
            $seconds = RateLimiter::availableIn('wai:' . $request->whatsapp);
            return ApiFormatter::error(['seconds' => $seconds], 'Too Many Attempts',  429);
        }
        RateLimiter::hit('wai:' . $request->whatsapp);
        $user = User::where('username', explode('-', $request->token)[0])->first();
        if ($user) {
            $token = $user->username . '-' . hash('ripemd160', $user->username . $user->password);
            if ($token == $request->token) {
                if ($user->whatsapp != null) {
                    return ApiFormatter::error([], 'Whatsapp Already Linked',  401);
                } else {
                    if (User::where('whatsapp', $request->whatsapp)->first()) {
                        return ApiFormatter::error([], 'Whatsapp is already linked to another account.',  401);
                    }
                }
                $user->whatsapp = $request->whatsapp;
                $user->save();
                return ApiFormatter::success(['whatsapp' => $user->whatsapp], 'Success');
            } else {
                return ApiFormatter::error([], 'Token Not Valid', 401);
            }
        } else {
            return ApiFormatter::error([], 'Token Not Valid', 401);
        }
    }

    public function whatsapp_unverify(Request $request)
    {
        if ($this->secret_key != $request->secret_key) {
            return ApiFormatter::error([], "Invalid Secret Key", 401);
        }
        $validator = \Validator::make($request->all(),  [
            'whatsapp' => 'required',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return ApiFormatter::error($validator->errors(), 'Validation Error', 422);
        }
        if (RateLimiter::tooManyAttempts('waun:' . $request->whatsapp, 3)) {
            $seconds = RateLimiter::availableIn('waun:' . $request->whatsapp);
            return ApiFormatter::error(['seconds' => $seconds], 'Too Many Attempts',  429);
        }
        RateLimiter::hit('waun:' . $request->whatsapp);
        $user = User::where('whatsapp', $request->whatsapp)->first();
        if ($user) {
            if (password_verify($request->password, $user->password)) {
                $user->whatsapp = null;
                $user->save();
                return ApiFormatter::success(['whatsapp' => $user->whatsapp], 'Success');
            } else {
                return ApiFormatter::error([], 'Password Not Valid', 401);
            }
        } else {
            return ApiFormatter::error([], 'Whatsapp Not Valid', 401);
        }
    }

    public function notify(Request $request)
    {
        if ($this->secret_key !== $request->secret_key) {
            return ApiFormatter::error([], "Invalid Secret Key", 401);
        }
        if ($request->method == 'get') {
            $data = Notify::get();
            return ApiFormatter::success($data, 'Success');
        } else if ($request->method == "delete") {
            $data = Notify::delete();
            return ApiFormatter::success($data, 'Success');
        } else {
            return ApiFormatter::error([], 'Method Not Valid', 401);
        }
    }
}

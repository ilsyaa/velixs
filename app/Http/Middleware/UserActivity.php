<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = auth();
        if ($auth->check()) {
            if (!\Cache::has('user-is-online-' . $auth->user()->id)) {
                $auth->user()->last_seen = date('Y-m-d H:i:s');
                $auth->user()->save();
                \Cache::put('user-is-online-' . auth()->user()->id, true, now()->addMinutes(config('app.active_user_interval')));
            }
        }
        return $next($request);
    }
}

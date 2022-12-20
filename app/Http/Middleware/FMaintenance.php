<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FMaintenance
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
        if (config('app.mt') == 1) {
            return response(view('maintenance', [
                'websetting' => \App\Models\WebSetting::first(),
            ]));
        }
        return $next($request);
    }
}

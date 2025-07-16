<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class ForceArabicIfNoLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        // $segments = $request->segments();

        // if (!in_array($segments[0] ?? '', ['en', 'ar'])) {
        //     App::setLocale('ar');
        //     Session::put('locale', 'ar');
        // }

        return $next($request);
    }
}

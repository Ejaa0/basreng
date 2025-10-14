<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('admin_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }

        return $next($request);
    }
}

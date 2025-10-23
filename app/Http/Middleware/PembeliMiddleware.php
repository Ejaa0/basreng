<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PembeliMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah session role ada dan user adalah pembeli
        if (!$request->session()->has('role') || $request->session('role') != 'pembeli') {
            return redirect('/login');
        }

        return $next($request);
    }
}

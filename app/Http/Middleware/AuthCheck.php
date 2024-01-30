<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah login
        if (Auth::check()) {
            return $next($request);
        }

        // Jika belum login, redirect ke halaman login
        return redirect('/register')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
}

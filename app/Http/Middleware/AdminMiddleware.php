<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin' && Auth::user()->is_active) {
            return $next($request);
        }

        // Redirect if not admin or not active
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses ditolak. Anda bukan admin atau akun Anda tidak aktif.');
        }

        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request and check user roles.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('warning', 'Silakan login terlebih dahulu untuk mengakses portal ini.');
        }

        $user = Auth::user();

        // If user has admin role, allow access to admin and cashier
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Check if user's role matches any allowed roles
        if (in_array($user->role, $roles, true)) {
            return $next($request);
        }

        abort(403, 'Akses ditolak. Anda tidak memiliki hak akses untuk halaman ini.');
    }
}

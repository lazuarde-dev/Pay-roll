<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class KaryawanMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isKaryawan()) {
            return $next($request);
        }
        // abort(403, 'Unauthorized action.');
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses karyawan.');
    }
}

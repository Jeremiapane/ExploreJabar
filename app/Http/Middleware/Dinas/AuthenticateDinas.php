<?php

namespace App\Http\Middleware\Dinas;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateDinas
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('pegawai')->check()) {
            return redirect()->to('/');
        }
    

        return $next($request);
    }
}


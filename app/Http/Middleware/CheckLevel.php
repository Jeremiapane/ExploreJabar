<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLevel
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if (Auth::check() && in_array(Auth::user()->id_level, $levels)) {
            return $next($request);
        }

        return redirect('/');
    }
}
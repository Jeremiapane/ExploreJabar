<?php

namespace App\Http\Middleware\Dinas;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckJabatan
{
    public function handle(Request $request, Closure $next, ...$jabatans): Response
    {
        $pegawai = auth('pegawai')->user();

        // Check if the user's jabatan is in the allowed list
        if (!in_array($pegawai->jabatan_id, $jabatans)) {
            // Redirect or show an unauthorized page if the user does not have access
            return redirect()->route('notfound')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
        return $next($request);
    }
}

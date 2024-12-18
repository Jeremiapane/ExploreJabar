<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Operasional;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Cek kredensial pengguna
        if (!Auth::attempt($request->only('email', 'password'))) {
            Alert::warning('Warning', 'Email atau password Anda salah.');
            return back()->withErrors(['email' => 'Email atau password Anda salah.'])->withInput();
        }

        $request->session()->regenerate();
        $user = Auth::user();
        $id_level = $user->id_level;

        $request->session()->put([
            'level' => $id_level,
            'username' => $user->username,
            'nama' => $user->nama,
        ]);

        if (in_array($id_level, [2, 3, 4, 5, 6])) {
            if ($id_level == 2) {
                $id_operasional = Operasional::where('id_user', $user->id)->pluck('id');
                $operasional_data = Operasional::where('id_user', $user->id)->first();
                $request->session()->put('id_operasional', $id_operasional[0]);
                $request->session()->put('status_verifikasi', $operasional_data->status_verifikasi);
            } else {
                $id_operasional = Operasional::where('id_user', $user->id)->pluck('id_parent_operasional');
                $request->session()->put('id_operasional', $id_operasional[0]);
                $request->session()->put('status_verifikasi', 'Aktif');
            }
            $request->session()->put([
                'nama' => $user->nama,
                'role' => $user->nama,
            ]);
        }

        switch ($id_level) {
            case 2:
                return redirect()->route('manager-operasional.dashboard');
            case 3:
                return redirect()->route('operasional.dashboard');
            case 4:
                return redirect()->route('manager-marketing.dashboard');
            case 5:
                return redirect()->route('marketing.dashboard');
            case 6:
                return redirect()->route('penjualan.dashboard');
            case 8:
                return redirect()->route('wisatawan.landingpage');
            default:
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

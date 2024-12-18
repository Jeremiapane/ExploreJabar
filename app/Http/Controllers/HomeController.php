<?php

namespace App\Http\Controllers;

use App\Models\Dinas\Artikel;
use App\Models\Dinas\ObjekWisata;
use App\Models\Operasional;
use App\Models\User;
use App\Models\Wisatawan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if (!$user) {
                return $next($request);
            }
            if ($user->id_level == 8) {
                return $next($request);
            }
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        });
    }

    public function index(Request $request)
    {
        //ambil artikel view terbanyak
        $list_artikel = Artikel::where('status', 'aktif')->skip(0)->orderBy('views','desc')->take(3)->get();
        $wisata = ObjekWisata::with('daerah')->skip(0)->take(4)->get();
        $operasional = Operasional::where('status_verifikasi', 'aktif')->skip(0)->take(4)->get();
        return view('customer.landingpage', compact('wisata', 'operasional', 'list_artikel'));
    }


    public function signup()
    {
        if (Auth::check()) {
            return redirect()->route('wisatawan.homepage');
        }
        return view('customer.signup');
    }

    public function storeSignup(Request $request): RedirectResponse
    {

        $request->validate([
            'nama_depan' => ['required', 'string', 'max:255'],
            'nama_belakang' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()->min(4)],
        ]);

        $user = User::create([
            'nama' => $request->nama_depan . ' ' . $request->nama_belakang,
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_level' => 8,
        ]);

        Wisatawan::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'deskripsi' => null,
            'id_user' => $user->id,
        ]);
        return redirect()->route('login');
    }

    public function helpCenter()
    {
        return view('customer.help_center');
    }

}

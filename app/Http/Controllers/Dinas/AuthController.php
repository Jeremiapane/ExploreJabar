<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\Dinas\Pegawai;
use Illuminate\Support\Facades\DB;
use App\Notifications\CustomResetPasswordNotification;

class AuthController extends Controller
{
    // Menampilkan form permintaan link reset password
    public function showLinkRequestForm()
    {
        return view('dinas.auth.passwords.email');
    }

    // Mengirim link reset password ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pegawais,email',
        ],[           
            'email.exists' => 'Email tidak ditemukan di database.',
        ]);

        $pegawai = Pegawai::where('email', $request->input('email'))->first();

        if (!$pegawai) {
            return back()->withErrors(['email' => 'Email tidak ditemukan di database.']);
        }

        // Generate the password reset token
        $token = Password::broker('pegawais')->createToken($pegawai);

        // Send custom notification
        $pegawai->notify(new CustomResetPasswordNotification($token));

        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    // Menampilkan form reset password
    public function showResetForm($token)
    {
        return view('dinas.auth.passwords.reset')->with(['token' => $token]);
    }

    // Mengatur ulang kata sandi
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:pegawais,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.exists' => 'Email tidak ditemukan di database.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $response = Password::broker('pegawais')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'), 
            function ($pegawai, $password) {
                $pegawai->password = $password;
                $pegawai->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            DB::table('password_resets')->where('email', $request->email)->delete();
            return redirect()->route('dinas.login')->with('success', 'Kata sandi berhasil diubah.');
        } else {
            return back()->withErrors(['email' => __($response)]);
        }
    }
}

<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:6',
        ]);

        $pegawai = auth('pegawai')->user();

        // Update photo if a new one is uploaded
        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($pegawai->foto && Storage::exists($pegawai->foto)) {
                Storage::delete($pegawai->foto);
            }

            // Store the new photo and update the path
            $fotoPath = $request->file('foto')->store('photos', 'public');
            $pegawai->foto = $fotoPath;
        }

        // Update password if a new one is provided
        if ($request->filled('password')) {
            $pegawai->password = $request->password;
        }

        // Save changes to the database
        $pegawai->save();

        // Redirect back with success message
        return redirect()->back()->with('status', 'Akun berhasil diperbarui!');
    }
}

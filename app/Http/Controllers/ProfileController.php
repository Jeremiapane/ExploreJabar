<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\User;
use App\Models\Wisatawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function index()
    {
        $wisatawan = Wisatawan::with(['user', 'attachment'])->where('id_user', Auth::user()->id)->first();
        return view('customer.profile', compact('wisatawan'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        // Update data user
        $user->username = $request->username;
        $user->email = $request->email;
        $user->no_telp = $request->phone;
        $user->alamat = $request->alamat;
        $user->save();

        // Update data wisatawan
        $wisatawan = Wisatawan::where('id_user', $user->id)->first();
        if (!$wisatawan) {
            $wisatawan = new Wisatawan();
            $wisatawan->id_user = $user->id;
        }
        $wisatawan->nama_depan = $request->first_name;
        $wisatawan->nama_belakang = $request->last_name;
        $wisatawan->deskripsi = $request->about;
        $wisatawan->save();

        // Handle file upload
        if ($request->hasFile('avatar')) {
            // Check if the user already has an avatar
            $existingAttachment = Attachment::where('id_type', $wisatawan->id)
                                            ->where('type', 'foto profile')
                                            ->first();

            // Delete the old avatar if it exists
            if ($existingAttachment) {
                $existingFilePath = public_path($existingAttachment->path);
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
                $existingAttachment->forceDelete();
            }

            // Upload the new avatar
            $avatar = $request->file('avatar');
            $fileName = time() . '_' . $avatar->getClientOriginalName();
            $filePath = 'assets/travel/img/profile-picture/' . $fileName;
            $avatar->move(public_path('assets/travel/img/profile-picture'), $fileName);
            // Save the new attachment
            Attachment::create([
                'name' => $fileName,
                'path' => $filePath,
                'type' => 'foto profile',
                'id_type' => $wisatawan->id,
            ]);

        }

        Alert::success('Success', 'Profile updated successfully.');
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        // Validasi data
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ], [
            'current_password.required' => 'Current password is required.',
            'current_password.min' => 'Current password must be at least 8 characters.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'New password confirmation does not match.',
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah current password sesuai
        if (!Hash::check($request->current_password, $user->password)) {
            Alert::warning('Error', 'Current password is incorrect');
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        Alert::success('Success', 'Password changed successfully.');
        return redirect()->back();
    }

}

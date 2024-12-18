<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use App\Models\Dinas\Pegawai;
use App\Models\Dinas\Jabatan;
use Illuminate\Http\Request;
use App\Models\Dinas\HakAkses;
use Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{
    public function index(Request $request)
    {
        $pegawais = Pegawai::with('jabatan')->get();
        $jabatans = Jabatan::all();
        $activeTab = $request->query('tab', 'tab-pegawai');

        return view('dinas.pegawai.index', compact('pegawais', 'jabatans', 'activeTab'));
    }

    public function storePegawai(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawais',
            'password' => 'required|string|min:8|confirmed',
            'jabatan_id' => 'required|exists:jabatans,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pegawais', 'public');
        }

        Pegawai::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'jabatan_id' => $request->jabatan_id,
            'foto' => $fotoPath,
        ]);

        return redirect()
            ->route('dinas.manajemen-pegawai.index', ['tab' => 'tab-pegawai'])
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function destroyPegawai($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);

            // Hapus foto jika ada
            if ($pegawai->foto) {
                Storage::disk('public')->delete($pegawai->foto);
            }

            $pegawai->delete();

            return redirect()
                ->route('dinas.manajemen-pegawai.index', ['tab' => 'tab-pegawai'])
                ->with('success', 'Pegawai berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle foreign key constraint violation
            return redirect()
                ->route('dinas.manajemen-pegawai.index', ['tab' => 'tab-pegawai'])
                ->with('error', 'Pegawai tidak dapat dihapus karena memiliki data terkait.');
        }
    }

    public function storeJabatan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Jabatan::create(['nama' => $request->nama]);

        return redirect()
            ->route('dinas.manajemen-pegawai.index', ['tab' => 'tab-jabatan'])
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function updateJabatan(Request $request, $id)
    {
        $jabatan = Jabatan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $jabatan->update(['nama' => $request->nama]);

        return redirect()
            ->route('dinas.manajemen-pegawai.index', ['tab' => 'tab-jabatan'])
            ->with('success', 'Jabatan berhasil diupdate.');
    }

    public function destroyJabatan($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        // Check if the jabatan is assigned to any pegawai
        if ($jabatan->pegawai()->exists()) {
            return redirect()
                ->route('dinas.manajemen-pegawai.index', ['tab' => 'tab-jabatan'])
                ->with('error', 'Jabatan tidak dapat dihapus karena ada pegawai yang menggunakan jabatan ini.');
        }

        $jabatan->delete();

        return redirect()
            ->route('dinas.manajemen-pegawai.index', ['tab' => 'tab-jabatan'])
            ->with('success', 'Jabatan berhasil dihapus.');
    }
}

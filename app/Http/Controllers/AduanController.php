<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AduanController extends Controller
{
    // Menampilkan daftar aduan status Diajukan
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $aduans = Aduan::where('status', 'Diajukan')
            ->where('judul', 'like', "%{$search}%")
            ->paginate(10);

        if ($request->ajax()) {
            return view('dinas.aduan.partials.table', compact('aduans'))->render();
        }
        return view('dinas.aduan.index', compact('aduans'));
    }

    // Menampilkan detail aduan status Diajukan
    public function show($id)
    {
        $aduan = Aduan::findOrFail($id);
        return view('dinas.aduan.show', compact('aduan'));
    }

    // Proses verifikasi aduan
    public function verify(Request $request, $id)
    {
        try {
            $aduan = Aduan::findOrFail($id);
            $aduan->update([
                'status' => 'Diverifikasi',
                'tanggal_verifikasi' => now(),
                'verifikator_id' => Auth::guard('pegawai')->id(),
            ]);

            return redirect()->route('dinas.verifikasi-aduan.index')->with('success', 'Aduan berhasil diverifikasi.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memverifikasi aduan.']);
        }
    }

    // Proses penolakan aduan
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);

        try {
            $aduan = Aduan::findOrFail($id);
            $aduan->update([
                'status' => 'Ditolak',
                'keterangan' => $request->input('catatan'),
                'tanggal_penyelesaian' => now(),
                'penyelesai_id' => Auth::guard('pegawai')->id(),
                'tanggal_verifikasi' => now(),
            ]);

            return redirect()->route('dinas.verifikasi-aduan.index')->with('success', 'Aduan ditolak dan catatan penolakan telah dikirim.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menolak aduan.']);
        }
    }

    // Menampilkan daftar aduan status Diverifikasi, Ditolak, dan Diselesaikan
    public function completed(Request $request)
    {
        $search = $request->input('search', '');
        $aduans = Aduan::with(['pemohon', 'verifikator', 'penyelesai'])
            ->whereIn('status', ['Diverifikasi', 'Ditolak', 'Diselesaikan'])
            ->where('judul', 'like', "%{$search}%")
            ->paginate(10);

        if ($request->ajax()) {
            return view('dinas.aduan.penyelesaian-aduan.partials.table', compact('aduans'))->render();
        }
        return view('dinas.aduan.penyelesaian-aduan.index', compact('aduans'));
    }

    // Proses penyelesaian aduan
    public function resolve(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string',
        ]);
        try {
            $aduan = Aduan::findOrFail($id);
            $aduan->update([
                'status' => 'Diselesaikan',
                'tanggal_penyelesaian' => now(),
                'penyelesai_id' => Auth::guard('pegawai')->id(),
                'keterangan' => $request->input('catatan'),
            ]);

            return redirect()->route('dinas.penyelesaian-aduan.index')->with('success', 'Aduan berhasil diselesaikan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyelesaikan aduan.']);
        }
    }

    // Menyimpan aduan baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'bukti_path' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Pastikan file selalu ada
        ]);

        $aduan = new Aduan();
        $aduan->judul = $request->input('judul');
        $aduan->deskripsi = $request->input('deskripsi');
        $aduan->pemohon_id = Auth::id(); // Set pemohon_id sebagai ID user yang login
        $aduan->tanggal_kejadian = $request->input('tanggal_kejadian');

        if ($request->hasFile('bukti_path')) {
            $file = $request->file('bukti_path');
            $filePath = $file->store('bukti', 'public');
            $aduan->bukti_path = $filePath;
        } else {
            // Tambahkan pengecekan untuk memastikan file ada
            return back()->withErrors(['bukti_path' => 'File bukti harus diunggah.']);
        }

        $aduan->status = 'Diajukan'; // Set status awal
        $aduan->save();

        return redirect()->route('aduan.create')->with('success', 'Aduan berhasil dibuat.');
    }
}

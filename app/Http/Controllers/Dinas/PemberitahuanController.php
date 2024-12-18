<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Dinas\Pemberitahuan;
use App\Models\Operasional;

class PemberitahuanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $pemberitahuan = Pemberitahuan::where('pengirim_id', Auth::guard('pegawai')->id())
            ->with('pengirim', 'penerima')
            ->where('perihal', 'like', "%{$search}%")
            ->paginate(10);

        if ($request->ajax()) {
            return view('dinas.pemberitahuan.partials.table', compact('pemberitahuan'))->render();
        }

        return view('dinas.pemberitahuan.index', compact('pemberitahuan'));
    }

    public function create()
    {
        // Mendapatkan semua data agen terverifikasi sebagai penerima
        $agens = Operasional::where('status_verifikasi', 'aktif')->whereNull('id_parent_operasional')->get();

        return view('dinas.pemberitahuan.create', compact('agens'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'penerima_id' => 'required|exists:agen_travel,id',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        try {
            $lampiranPath = null;

            // Menyimpan file lampiran jika ada
            if ($request->hasFile('lampiran')) {
                // Menyimpan file ke direktori public storage
                $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            }

            // Mendapatkan ID pegawai yang sedang login
            $pengirimId = Auth::guard('pegawai')->id();

            // Menyimpan data pemberitahuan ke database
            Pemberitahuan::create([
                'pengirim_id' => $pengirimId,
                'penerima_id' => $request->penerima_id,
                'perihal' => $request->perihal,
                'isi' => $request->isi,
                'lampiran' => $lampiranPath,
            ]);

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('dinas.pemberitahuan.index')->with('success', 'Pemberitahuan berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengirim pemberitahuan. Coba Kembali']);
        }
    }

    // Method show untuk menampilkan detail pemberitahuan
    public function show($id)
    {
        // Memuat pemberitahuan dengan relasi pengirim dan penerima
        $pemberitahuan = Pemberitahuan::with('pengirim', 'penerima')->findOrFail($id);

        return view('dinas.pemberitahuan.show', compact('pemberitahuan'));
    }
}

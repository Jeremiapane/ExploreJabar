<?php

namespace App\Http\Controllers\Dinas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dinas\Pengajuan;
use App\Models\Dinas\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        $pengajuans = Pengajuan::where('pemohon_id', Auth::guard('pegawai')->id())
            ->where('judul', 'like', "%{$search}%")
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10);

        if ($request->ajax()) {
            $html = view('dinas.pengajuan.partials.table', compact('pengajuans'))->render();
            $pagination = (string) $pengajuans->links();
            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
            ]);
        }

        return view('dinas.pengajuan.index', compact('pengajuans'));
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('dinas.pengajuan.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'dokumen' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240', // 10MB max
            'approver1_id' => 'required|exists:pegawais,id',
            'approver2_id' => 'nullable|exists:pegawais,id',
        ]);

        try {
            // Proses penyimpanan dokumen
            $dokumenPath = $request->file('dokumen')->store('dokumen', 'public');

            // Tentukan status berdasarkan ada tidaknya approver kedua
            $status = $request->approver2_id ? 'pending approver 1' : 'pending';

            // Buat entri baru dalam database
            Pengajuan::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'dokumen' => $dokumenPath,
                'pemohon_id' => Auth::guard('pegawai')->id(),
                'approver1_id' => $request->approver1_id,
                'approver2_id' => $request->approver2_id,
                'status' => $status,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('dinas.pengajuan.index')->with('success', 'Pengajuan berhasil dibuat.');
        } catch (\Exception $e) {
            // Redirect kembali dengan pesan error
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat pengajuan. Silakan coba lagi.']);
        }
    }

    public function show(Pengajuan $pengajuan)
    {
        $approver1 = Pegawai::find($pengajuan->approver1_id);
        $approver2 = Pegawai::find($pengajuan->approver2_id);
        return view('dinas.pengajuan.approval.show', compact('pengajuan', 'approver1', 'approver2'));
    }

    public function approve(Pengajuan $pengajuan)
    {
        $pegawaiId = Auth::guard('pegawai')->id();

        if ($pengajuan->approver1_id == $pegawaiId) {
            // Approver 1 approval logic
            if ($pengajuan->status == 'pending') {
                $pengajuan->update([
                    'status' => $pengajuan->approver2_id ? 'pending approver 2' : 'disetujui',
                ]);
            } elseif ($pengajuan->status == 'pending approver 1') {
                $pengajuan->update([
                    'status' => $pengajuan->approver2_id ? 'pending approver 2' : 'disetujui',
                ]);
            }
        } elseif ($pengajuan->approver2_id == $pegawaiId && $pengajuan->status == 'pending approver 2') {
            // Approver 2 approval logic
            $pengajuan->update(['status' => 'disetujui']);
        }

        return redirect()->route('dinas.approval.index')->with('success', 'Pengajuan disetujui.');
    }

    public function reject(Request $request, Pengajuan $pengajuan)
    {
        $request->validate([
            'catatan_penolakan' => 'required|string',
        ]);

        $pegawaiId = Auth::guard('pegawai')->id();
        try {
            if ($pengajuan->approver1_id == $pegawaiId) {
                // Approver 1 rejection logic
                $pengajuan->update([
                    'status' => 'ditolak',
                    'catatan_penolakan' => $request->catatan_penolakan,
                ]);
            } elseif ($pengajuan->approver2_id == $pegawaiId && $pengajuan->status == 'pending approver 2') {
                // Approver 2 rejection logic
                $pengajuan->update([
                    'status' => 'ditolak',
                    'catatan_penolakan' => $request->catatan_penolakan,
                ]);
            }

            return redirect()->route('dinas.approval.index')->with('success', 'Pengajuan ditolak.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menolak pengajuan. Coba Kembali']);
        }
    }
    public function approvalIndex(Request $request)
    {
        // Default sorting
        $sortBy = $request->input('sort_by', 'created_at'); // Default sort by 'created_at'
        $sortDirection = $request->input('sort_direction', 'asc'); // Default direction is 'asc'
        $pegawaiId = Auth::guard('pegawai')->id();
        $pengajuans = Pengajuan::where(function ($query) use ($pegawaiId) {
            $query->where('approver1_id', $pegawaiId)->orWhere(function ($query) use ($pegawaiId) {
                $query->where('approver2_id', $pegawaiId)->where('status', 'pending approver 2');
            });
        })
            ->whereIn('status', ['pending', 'pending approver 1', 'pending approver 2'])
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10);

        return view('dinas.pengajuan.approval.index', compact('pengajuans'));
    }
}

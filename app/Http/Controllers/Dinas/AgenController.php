<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Operasional;
use App\Models\Paket;

class AgenController extends Controller
{
    public function index(Request $request)
    {
        $sortColumn = $request->input('sort', 'created_at'); // Default sorting column
        $sortDirection = $request->input('direction', 'asc'); // Default sorting direction

        // Validate sort column
        $validColumns = ['nama_perusahaan', 'no_telp_perusahaan', 'status_verifikasi', 'created_at'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'created_at';
        }

        // Validate sort direction
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        // Fetch data with sorting and pagination
        $agens = Operasional::whereIn('status_verifikasi', ['diproses', 'pending'])
            ->orderByRaw("FIELD(status_verifikasi, 'diproses', 'pending')")
            ->where('id_parent_operasional', null)
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(10);

        return view('dinas.verifikasi-agen.index', [
            'agens' => $agens,
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
        ]);
    }

    public function show($id)
    {
        $agen = Operasional::with('attachments')->findOrFail($id);
        return view('dinas.verifikasi-agen.show', compact('agen'));
    }

    public function verifikasi(Request $request, $id)
    {
        try {
            $agen = Operasional::findOrFail($id);
            $agen->status_verifikasi = 'aktif';
            $agen->verifikator_id = Auth::guard('pegawai')->id();
            $agen->save();

            return redirect()->route('dinas.verifikasi-agen.index')->with('success', 'Agen berhasil diverifikasi.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memverifikasi agen.']);
        }
    }

    public function tolak(Request $request, $id)
    {
        try {
            $agen = Operasional::findOrFail($id);
            $agen->status_verifikasi = 'ditolak';
            $agen->catatan = $request->catatan_penolakan;
            $agen->verifikator_id = Auth::guard('pegawai')->id(); // Simpan catatan perbaikan
            $agen->save();

            return redirect()->route('dinas.verifikasi-agen.index')->with('success', 'Agen ditolak dan catatan perbaikan telah dikirim.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menolak agen.']);
        }
    }

    public function indexMonitoring(Request $request)
    {
        $search = $request->input('search', '');
        $sortColumn = $request->input('sort', 'tanggal_verifikasi'); // Default sorting column
        $sortDirection = $request->input('direction', 'asc'); // Default sorting direction

        // Validasi kolom sorting
        $validColumns = ['nama_perusahaan', 'no_telp_perusahaan', 'status_verifikasi', 'updated_at'];
        if (!in_array($sortColumn, $validColumns)) {
            $sortColumn = 'updated_at';
        }

        // Validasi arah sorting
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        // Query untuk pencarian dan sorting
        $query = Operasional::where('status_verifikasi', 'aktif')
        ->where('id_parent_operasional', null)
        ->where('nama_perusahaan', 'like', "%{$search}%");

        $agens = $query->orderBy($sortColumn, $sortDirection)->paginate(10);

        if ($request->ajax()) {
            return view('dinas.monitoring-agen.partials.table', compact('agens'))->render();
        }

        return view('dinas.monitoring-agen.index', compact('agens'));
    }

    public function showMonitoring($id)
    {
        $agen = Operasional::with('attachments', 'review', 'verifikator')->findOrFail($id);
        $averageRating = round($agen->review->avg('rating'), 1);
        $paket = Paket::where('created_by',$id)->get();
        $totalPaket = $paket->count();
        $totalBooking = 0;
        foreach ($paket as $item) {
            $totalBooking += $item->booking()->count();
        }

        return view('dinas.monitoring-agen.show', compact('agen','averageRating','totalPaket','totalBooking'));
    }
}

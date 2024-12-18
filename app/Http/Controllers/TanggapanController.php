<?php

namespace App\Http\Controllers;

use App\Models\Dinas\Pemberitahuan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', '');
    $sort = $request->input('sort', 'created_at'); // Initialize $sort with default value
    $direction = $request->input('direction', 'asc'); // Initialize $direction with default value

    $validSortColumns = ['pengirim_id', 'perihal', 'created_at']; // Add 'tanggal' if it's a valid column
    $sort = in_array($sort, $validSortColumns) ? $sort : 'created_at';
    $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

    // Ambil ID pegawai yang sedang login
    $pegawaiId = Auth::guard('pegawai')->id();

    // Ambil pemberitahuan yang dibuat oleh pegawai
    $pemberitahuanIds = Pemberitahuan::where('pengirim_id', $pegawaiId)->pluck('id');

    // Ambil tanggapan yang terkait dengan pemberitahuan yang dibuat oleh pegawai
    $tanggapans = Tanggapan::whereIn('pemberitahuan_id', $pemberitahuanIds)
        ->when($search, function ($query, $search) {
            return $query->whereHas('pemberitahuan', function ($query) use ($search) {
                $query->where('perihal', 'like', "%{$search}%");
            });
        })
        ->with('pemberitahuan') // Ensure 'pemberitahuan' is eager loaded for sorting by 'perihal'
        ->orderBy($sort, $direction)
        ->paginate(10);

    if ($request->ajax()) {
        return view('dinas.tanggapan.partials.table', compact('tanggapans'))->render();
    }

    return view('dinas.tanggapan.index', compact('tanggapans'));
}


    public function show($id)
    {
        // Ambil tanggapan beserta pemberitahuan terkait
        $tanggapan = Tanggapan::with('pemberitahuan', 'pengirim')->findOrFail($id);

        return view('dinas.tanggapan.show', compact('tanggapan'));
    }
}

<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use App\Models\Dinas\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortColumn = $request->input('sortColumn', 'kecamatan'); // default to 'kecamatan'
        $sortOrder = $request->input('sortOrder', 'asc'); // default to 'asc'

        $daerahs = Daerah::withCount('objekWisatas')
            ->where(function ($query) use ($search) {
                $query->where('kecamatan', 'like', "%{$search}%")->orWhere('provinsi', 'like', "%{$search}%");
            })
            ->orderBy($sortColumn, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return view('dinas.objek-wisata.daerah.partials.table', compact('daerahs'))->render();
        }

        return view('dinas.objek-wisata.daerah.index', compact('daerahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kecamatan' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/', // Validasi agar hanya huruf dan spasi yang diizinkan
            ],
        ]);

        // Konversi nama kecamatan menjadi Sentence Case
        $kecamatanFormatted = ucwords(strtolower($request->kecamatan));

        // Periksa apakah kecamatan sudah ada di database (case-insensitive)
        $exists = Daerah::whereRaw('LOWER(kecamatan) = ?', [strtolower($kecamatanFormatted)])->exists();

        if ($exists) {
            return redirect()->route('dinas.daerah.index')->with('error', 'Daerah dengan kecamatan ini sudah tersedia.');
        }

        Daerah::create([
            'kecamatan' => $kecamatanFormatted,
            'provinsi' => $request->provinsi ?? 'Jawa Barat',
        ]);

        return redirect()->route('dinas.daerah.index')->with('success', 'Daerah berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kecamatan' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/', // Validasi agar hanya huruf dan spasi yang diizinkan
            ],
        ]);

        // Konversi nama kecamatan menjadi Sentence Case
        $kecamatanFormatted = ucwords(strtolower($request->kecamatan));

        // Ambil data daerah yang sedang diupdate
        $currentDaerah = Daerah::findOrFail($id);

        // Periksa apakah ada kecamatan lain yang sama kecuali kecamatan saat ini (case-insensitive)
        $exists = Daerah::whereRaw('LOWER(kecamatan) = ?', [strtolower($kecamatanFormatted)])
            ->where('id', '!=', $currentDaerah->id)
            ->exists();

        if ($exists) {
            return redirect()->route('dinas.daerah.index')->with('error', 'Daerah dengan kecamatan ini sudah tersedia.');
        }

        $currentDaerah->update([
            'kecamatan' => $kecamatanFormatted,
            'provinsi' => $request->provinsi ?? $currentDaerah->provinsi,
        ]);

        return redirect()->route('dinas.daerah.index')->with('success', 'Daerah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $daerah = Daerah::findOrFail($id);

        // Cek apakah daerah ini digunakan oleh objek wisata
        if ($daerah->objekWisatas()->exists()) {
            return redirect()->route('dinas.daerah.index')->with('error', 'Daerah ini tidak dapat dihapus karena sedang digunakan dalam objek wisata.');
        }

        $daerah->delete();

        return redirect()->route('dinas.daerah.index')->with('success', 'Daerah berhasil dihapus.');
    }
}

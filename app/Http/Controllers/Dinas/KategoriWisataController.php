<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use App\Models\Dinas\KategoriWisata;
use App\Models\Dinas\ObjekWisata;
use Illuminate\Http\Request;

class KategoriWisataController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortColumn = $request->input('sort_column', 'nama');
        $sortDirection = $request->input('sort_direction', 'asc');

        $kategoris = KategoriWisata::withCount('ObjekWisatas')
            ->where('nama', 'like', "%{$search}%")
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(10);

        if ($request->ajax()) {
            return view('dinas.objek-wisata.kategori.partials.table', compact('kategoris'))->render();
        }

        return view('dinas.objek-wisata.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('dinas.objek-wisata.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
        ]);

        // Konversi nama kategori menjadi Capitalize Each Word
        $namaFormatted = ucwords(strtolower($request->nama));

        // Periksa apakah nama kategori wisata sudah ada di database (case-insensitive)
        $exists = KategoriWisata::whereRaw('LOWER(nama) = ?', [strtolower($namaFormatted)])->exists();

        if ($exists) {
            return redirect()->route('dinas.kategori-wisata.index')->with('error', 'Kategori Wisata dengan nama ini sudah tersedia.');
        }

        KategoriWisata::create([
            'nama' => $namaFormatted,
        ]);

        return redirect()->route('dinas.kategori-wisata.index')->with('success', 'Kategori Wisata berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategori = KategoriWisata::findOrFail($id);
        return view('dinas.objek-wisata.kategori.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = KategoriWisata::findOrFail($id);
        return view('dinas.objek-wisata.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/', //validasi hanya huruf dan spasi yang diizinkan
        ]);

        // Konversi nama kategori menjadi Capitalize Each Word
        $namaFormatted = ucwords(strtolower($request->nama));

        $kategoriWisata = KategoriWisata::findOrFail($id);

        // Periksa apakah ada nama kategori lain yang sama kecuali kategori saat ini (case-insensitive)
        $exists = KategoriWisata::whereRaw('LOWER(nama) = ?', [strtolower($namaFormatted)])
            ->where('id', '!=', $kategoriWisata->id)
            ->exists();

        if ($exists) {
            return redirect()->route('dinas.kategori-wisata.index')->with('error', 'Kategori Wisata dengan nama ini sudah tersedia.');
        }

        $kategoriWisata->update([
            'nama' => $namaFormatted,
        ]);

        return redirect()->route('dinas.kategori-wisata.index')->with('success', 'Kategori Wisata berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategoriWisata = KategoriWisata::findOrFail($id);

        // Cek apakah kategori ini digunakan oleh objek wisata
        $isUsedInObjekWisata = ObjekWisata::where('kategori_id', $id)->exists();

        if ($isUsedInObjekWisata) {
            return redirect()->route('dinas.kategori-wisata.index')->with('error', 'Kategori Wisata tidak dapat dihapus karena sedang digunakan oleh objek wisata.');
        }

        $kategoriWisata->delete();

        return redirect()->route('dinas.kategori-wisata.index')->with('success', 'Kategori Wisata berhasil dihapus.');
    }
}

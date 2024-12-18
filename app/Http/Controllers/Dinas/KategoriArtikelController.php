<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use App\Models\Dinas\KategoriArtikel;
use App\Models\Dinas\Artikel;
use Illuminate\Http\Request;

class KategoriArtikelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortColumn = $request->input('sort_column', 'nama'); // Default sort column
        $sortDirection = $request->input('sort_direction', 'asc'); // Default sort direction

        $kategoriArtikel = KategoriArtikel::withCount('artikels')
            ->where('nama', 'like', "%{$search}%")
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(10);

        if ($request->ajax()) {
            return view('dinas.artikel.kategori.partials.table', compact('kategoriArtikel'))->render();
        }

        return view('dinas.artikel.kategori.index', compact('kategoriArtikel'));
    }

    public function create()
    {
        return view('dinas.artikel.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
        ]);

        // Konversi nama kategori menjadi Capitalize Each Word
        $namaFormatted = ucwords(strtolower($request->nama));

        // Periksa apakah nama kategori artikel sudah ada di database (case-insensitive)
        $exists = KategoriArtikel::whereRaw('LOWER(nama) = ?', [strtolower($namaFormatted)])->exists();

        if ($exists) {
            return redirect()->route('dinas.kategori-artikel.index')->with('error', 'Kategori Artikel dengan nama ini sudah tersedia.');
        }

        KategoriArtikel::create([
            'nama' => $namaFormatted,
        ]);

        return redirect()->route('dinas.kategori-artikel.index')->with('success', 'Kategori Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, KategoriArtikel $kategoriArtikel)
    {
        $request->validate([
            'nama' => 'required|string|max:255|regex:/^[A-Za-z\s]+$/',
        ]);

        // Konversi nama kategori menjadi Capitalize Each Word
        $namaFormatted = ucwords(strtolower($request->nama));

        // Periksa apakah ada nama kategori lain yang sama kecuali kategori saat ini (case-insensitive)
        $exists = KategoriArtikel::whereRaw('LOWER(nama) = ?', [strtolower($namaFormatted)])
            ->where('id', '!=', $kategoriArtikel->id)
            ->exists();

        if ($exists) {
            return redirect()->route('dinas.kategori-artikel.index')->with('error', 'Kategori Artikel dengan nama ini sudah tersedia.');
        }

        $kategoriArtikel->update([
            'nama' => $namaFormatted,
        ]);

        return redirect()->route('dinas.kategori-artikel.index')->with('success', 'Kategori Artikel berhasil diperbarui.');
    }

    public function destroy(KategoriArtikel $kategoriArtikel)
    {
        try {
            $isUsedInArtikel = Artikel::where('kategori_id', $kategoriArtikel->id)->exists();

            if ($isUsedInArtikel) {
                return redirect()->route('dinas.kategori-artikel.index')->with('error', 'Kategori Artikel tidak dapat dihapus karena sedang digunakan oleh artikel.');
            }

            $kategoriArtikel->delete();

            return redirect()->route('dinas.kategori-artikel.index')->with('success', 'Kategori Artikel berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('dinas.kategori-artikel.index')->with('error', 'Terjadi kesalahan saat menghapus kategori artikel.');
        }
    }
}

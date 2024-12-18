<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dinas\Artikel;
use App\Models\Dinas\KategoriArtikel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortColumn = $request->input('sort_column', 'created_at'); // Default to created_at
        $sortDirection = $request->input('sort_direction', 'desc'); // Default to descending

        $artikels = Artikel::with('kategori', 'penulis')
            ->leftJoin('kategori_artikels', 'artikels.kategori_id', '=', 'kategori_artikels.id')
            ->where('judul', 'like', "%{$search}%")
            ->orderBy($sortColumn, $sortDirection)
            ->select('artikels.*', 'kategori_artikels.nama as kategori_nama') // Tambahkan nama kategori sebagai alias
            ->paginate(10);

        if ($request->ajax()) {
            return view('dinas.artikel.partials.table', compact('artikels'))->render();
        }

        // Kembalikan view dengan data artikel
        return view('dinas.artikel.index', compact('artikels'));
    }

    public function create()
    {
        $kategori_artikels = KategoriArtikel::all();
        return view('dinas.artikel.create', compact('kategori_artikels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail' => 'required',
            'kategori_id' => 'required|exists:kategori_artikels,id',
            'status' => 'required|in:draf,aktif',
        ]);

        $path = $request->file('foto_sampul')->store('artikel', 'public');

        Artikel::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul), // Tambahkan slug di sini
            'foto_sampul' => $path,
            'detail' => $request->detail,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'penulis_id' => Auth::guard('pegawai')->id(),
            'views' => 0,
        ]);

        return redirect()->route('dinas.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        $kategori_artikels = KategoriArtikel::all();
        return view('dinas.artikel.edit', compact('artikel', 'kategori_artikels'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:255',
            'foto_sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'detail' => 'required',
            'kategori_id' => 'required|exists:kategori_artikels,id',
            'status' => 'required|in:draf,aktif',
        ]);

        if ($request->hasFile('foto_sampul')) {
            Storage::disk('public')->delete($artikel->foto_sampul);
            $path = $request->file('foto_sampul')->store('artikel-images', 'public');
            $artikel->foto_sampul = $path;
        }

        $artikel->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'detail' => $request->detail,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'penulis_id' => Auth::guard('pegawai')->id(),
        ]);

        return redirect()->route('dinas.artikel.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        Storage::disk('public')->delete($artikel->foto_sampul);
        $artikel->delete();
        return redirect()->route('dinas.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        return view('dinas.artikel.show', compact('artikel'));
    }
}

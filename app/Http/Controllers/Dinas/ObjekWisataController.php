<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use App\Models\Dinas\ObjekWisata;
use App\Models\Dinas\KategoriWisata;
use App\Models\Dinas\Daerah;
use App\Models\Dinas\ObjekWisataImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ObjekWisataController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', '');
    $sortColumn = $request->input('sort_column', 'nama'); // Default to 'nama'
    $sortDirection = $request->input('sort_direction', 'asc'); // Default to ascending

    $allowedSortColumns = ['nama', 'kategori_nama', 'kecamatan', 'provinsi', 'status'];
    $sortColumn = in_array($sortColumn, $allowedSortColumns) ? $sortColumn : 'nama';

    $objekWisatas = ObjekWisata::with('kategori', 'daerah')
        ->leftJoin('kategori_wisatas', 'objek_wisatas.kategori_id', '=', 'kategori_wisatas.id')
        ->leftJoin('daerahs', 'objek_wisatas.daerah_id', '=', 'daerahs.id')
        ->where('objek_wisatas.nama', 'like', "%{$search}%")
        ->orderBy($sortColumn, $sortDirection)
        ->select('objek_wisatas.*', 'kategori_wisatas.nama as kategori_nama', 'daerahs.kecamatan', 'daerahs.provinsi')
        ->paginate(10);

    if ($request->ajax()) {
        return view('dinas.objek-wisata.partials.table', compact('objekWisatas'))->render();
    }

    return view('dinas.objek-wisata.index', compact('objekWisatas'));
}


    public function create()
    {
        $kategoriWisatas = KategoriWisata::all();
        $daerahs = Daerah::all();
        return view('dinas.objek-wisata.create', compact('kategoriWisatas', 'daerahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori_wisatas,id',
            'daerah_id' => 'required|exists:daerahs,id',
            'detail' => 'required|string',
            'url_peta' => 'required|url',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120', // max 5MB per image
            'status' => 'required|in:active,inactive',
        ]);

        $objekWisata = ObjekWisata::create([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'daerah_id' => $request->daerah_id,
            'detail' => $request->detail,
            'url_peta' => $request->url_peta,
            'status' => $request->status,
            'penulis_id' => Auth::guard('pegawai')->id(),
        ]);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $images = array_slice($images, 0, 5);

            foreach ($images as $image) {
                $path = $image->store('public/objek-wisata-images');
                ObjekWisataImage::create([
                    'objek_wisata_id' => $objekWisata->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('dinas.objek-wisata.index')->with('success', 'Objek Wisata berhasil ditambahkan.');
    }

    public function edit(ObjekWisata $objekWisata)
    {
        $kategoriWisatas = KategoriWisata::all();
        $daerahs = Daerah::all();
        return view('dinas.objek-wisata.edit', compact('objekWisata', 'kategoriWisatas', 'daerahs'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'kategori_id' => 'nullable|exists:kategori_wisatas,id',
            'daerah_id' => 'nullable|exists:daerahs,id',
            'detail' => 'nullable|string',
            'url_peta' => 'nullable|url',
            'status' => 'nullable|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Ukuran maksimal 2MB per gambar
            'deleted_images' => 'nullable|array',
            'deleted_images.*' => 'nullable|exists:objek_wisata_images,id', // Validasi gambar yang dihapus
        ]);

        $objekWisata = ObjekWisata::findOrFail($id);

        // Update only fields that are present in the request
        $objekWisata->update(
            array_filter($validated, function ($value) {
                return $value !== null;
            }),
        );

        // Hapus gambar yang dihapus
        if ($request->has('deleted_images')) {
            $deletedImages = $request->input('deleted_images');
            foreach ($deletedImages as $imageId) {
                $image = ObjekWisataImage::find($imageId);
                if ($image) {
                    // Hapus file fisik gambar
                    Storage::disk('public')->delete($image->path);
                    // Hapus data gambar dari database
                    $image->delete();
                }
            }
        }

        // Tambahkan gambar baru
        if ($request->hasFile('images')) {
            $existingImagesCount = $objekWisata->images()->count();
            $newImages = $request->file('images');
            $remainingSlots = max(0, 5 - $existingImagesCount);
            $newImages = array_slice($newImages, 0, $remainingSlots); // Batasi maksimal 5 gambar

            foreach ($newImages as $image) {
                $path = $image->store('public/objek-wisata-images');
                ObjekWisataImage::create([
                    'objek_wisata_id' => $objekWisata->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('dinas.objek-wisata.index')->with('success', 'Objek Wisata berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $objekWisata = ObjekWisata::findOrFail($id);

        // Delete images
        foreach ($objekWisata->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $objekWisata->delete();

        return redirect()->route('dinas.objek-wisata.index')->with('success', 'Objek Wisata berhasil dihapus.');
    }
}

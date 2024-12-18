<?php

namespace App\Http\Controllers\Dinas;

use App\Http\Controllers\Controller;
use App\Models\Dinas\ObjekWisataImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ObjekWisataImageController extends Controller
{
    public function destroy($id)
{
    $image = ObjekWisataImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->path)) {
        Storage::disk('public')->delete($image->path);
    }
    $image->delete();

    return back()->with('success', 'Gambar berhasil dihapus.');
}

}

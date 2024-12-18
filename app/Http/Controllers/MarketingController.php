<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Attachment;
use App\Models\Dinas\Daerah;
use App\Models\Dinas\ObjekWisata;
use App\Models\KategoriPaket;
use App\Models\Kendaraan;
use App\Models\Paket;
use App\Models\PemanduWisata;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MarketingController extends Controller
{

    public function dashboard()
    {
        $list_kategori = KategoriPaket::get();
        $paket = Paket::where('created_by', session('id_operasional'))->get();
        return view('travel.marketing.dashboard', compact('list_kategori', 'paket'));
    }

    public function dashboardManager()
    {
        $paketWisata = Paket::where('created_by', session('id_operasional'))->with(['kategoriPaket', 'wisata', 'pemanduWisata'])->get();
        $diproses = Paket::where('created_by', session('id_operasional'))->where('status_verifikasi', 'diproses')->get();
        $diterima = Paket::where('created_by', session('id_operasional'))->where('status_verifikasi', 'aktif')->get();
        $paketWisata = Paket::where('created_by', session('id_operasional'))->with(['kategoriPaket', 'wisata', 'pemanduWisata'])->get();
        $list_kategori = KategoriPaket::get();

        $paketFavorit = Paket::where('created_by', session('id_operasional'))
        ->withCount('booking')
        ->withAvg('review', 'rating')
        ->having('booking_count', '>', 0)
        ->orderBy('booking_count', 'desc')
        ->take(5)
        ->get();
        return view('travel.marketing.manager-dashboard', compact('paketWisata', 'list_kategori', 'diproses', 'diterima', 'paketFavorit'));
    }

    public function paketWisata()
    {
        $paketWisata = Paket::where('created_by', session('id_operasional'))->with(['kategoriPaket', 'wisata', 'pemanduWisata'])->get();
        return view('travel.marketing.paket-wisata', compact('paketWisata'));
    }

    public function tambahPaketWisata()
    {
        $kategoriPaket = KategoriPaket::all();
        $wilayah = Daerah::all();
        return view('travel.marketing.tambah-paket-wisata', compact('kategoriPaket', 'wilayah'));
    }

    public function showPaketWisata($id)
    {
        $paket = Paket::with(['kategoriPaket', 'attachment', 'wisata.daerah', 'pemanduWisata.user', 'kendaraan', 'aktivitas'])->findOrFail($id);
        return view('travel.marketing.detail-paket-wisata', compact('paket'));
    }

    public function storePaket(Request $request)
    {
        try {
            // Simpan foto
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('assets/travel/img/paket');
                $file->move($path, $filename);

                // Simpan data ke tabel attachments
                $attachment = new Attachment();
                $attachment->name = $filename;
                $attachment->path = 'assets/travel/img/paket/' . $filename;
                $attachment->type = 'paket';
                $attachment->id_type = null; // akan di-update setelah pemandu_wisata disimpan
                $attachment->save();
            }

            $paket = new Paket();
            $paket->nama = $request->nama;
            $paket->deskripsi = $request->deskripsi;
            $paket->harga = $request->harga;
            $paket->include = $request->include;
            $paket->exclude = $request->exclude;
            $paket->jumlah_peserta = $request->jumlah_peserta;
            $paket->status_paket = 'tidak tersedia';
            $paket->status_verifikasi = 'diproses';
            $paket->id_objek_wisata = $request->wisata_ids[0]; // Assuming one wisata for simplicity
            $paket->id_pemandu_wisata = $request->pemandu_id;
            $paket->id_kendaraan = $request->kendaraan_id;
            $paket->id_kategori_paket = $request->kategori_paket_id;
            $paket->created_by = session('id_operasional');
            $paket->save();

            $pemandu = PemanduWisata::findOrFail($request->pemandu_id);
            $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);
            $pemandu->status_pemandu = 'tidak tersedia';
            $pemandu->save();
            $kendaraan->status_kendaraan = 'tidak tersedia';
            $kendaraan->save();

            // Update id_type di attachment
            if (isset($attachment)) {
                $attachment->id_type = $paket->id;
                $attachment->save();
            }

            foreach ($request->aktivitas as $aktivitas) {
                $newAktivitas = new Aktivitas();
                $newAktivitas->aktivitas = $aktivitas;
                $newAktivitas->id_paket = $paket->id;
                $newAktivitas->save();
            }
            Alert::success('Success', 'Paket Wisata Ditambahkan');
            return redirect()->route('marketing.paket');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['msg' => 'There was an error saving the kendaraan. Please try again.']);
        }
    }

    public function deletePaket($id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();
        Alert::success('Success', 'Paket deleted !');
        return redirect()->back()->with('success', 'Paket Wisata Terhapus');
    }

    public function updateStatusPaket(Request $request)
    {
        $paket = Paket::findOrFail($request->id);
        $paket->update([
            'status_verifikasi' => $request->status_verifikasi,
            'status_paket' => $request->status_verifikasi == 'aktif' ? 'tersedia' : 'tidak tersedia',
            'catatan' => $request->catatan,
        ]);
        Alert::success('Success', 'Status Paket wisata berhasil diperbaharui');
        return redirect()->back()->with('success', 'Status Paket wisata Diperbarui');
    }

    public function getWisataByWilayah($daerah_id)
    {
        $wisata = ObjekWisata::where('daerah_id', $daerah_id)->get();
        return response()->json($wisata);
    }

    public function getKendaraanByJumlahPeserta(Request $request, $jumlah)
    {
        $kendaraan = Kendaraan::where('kapasitas_minimum', '<=', $jumlah)
            ->where('kapasitas_maximum', '>=', $jumlah)
            ->where('status_kendaraan', 'tersedia')
            ->where('created_by', $request->id)
            ->get();
        return response()->json($kendaraan);
    }

    public function getPemanduWisataTersedia(Request $request)
    {
        $pemanduWisata = PemanduWisata::where('status_pemandu', 'tersedia')
            ->where('created_by', $request->id)
            ->with('user:id,nama')
            ->get();

        return response()->json($pemanduWisata);
    }

}

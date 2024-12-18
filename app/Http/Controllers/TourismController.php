<?php

namespace App\Http\Controllers;

use App\Models\Aduan;
use App\Models\Booking;
use App\Models\Dinas\ObjekWisata;
use App\Models\Kendaraan;
use App\Models\Operasional;
use App\Models\Paket;
use App\Models\PemanduWisata;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TourismController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();

            if (!$user) {
                return $next($request);
            }

            if ($user->id_level == 8) {
                return $next($request);
            }
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        });
    }

    public function index(Request $request)
    {
        $query = ObjekWisata::where('status', 'active')->with('daerah', 'images');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%{$search}%")->orWhereHas('daerah', function ($q) use ($search) {
                $q->where('kecamatan', 'LIKE', "%{$search}%");
            });
        }

        $list_wisata = $query->paginate(3);
        return view('customer.objek-wisata', compact('list_wisata'));
    }

    public function showWisata($id)
    {
        $wisata = ObjekWisata::with('daerah', 'images')->findOrFail($id);
        return view('customer.detail-wisata', compact('wisata'));
    }

    public function listTravel(Request $request)
    {
        $query = Operasional::where('id_parent_operasional', null)->where('status_verifikasi', 'aktif')->with('review');

        // Handle search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_perusahaan', 'LIKE', "%{$search}%");
        }

        // Handle rating filtering
        if ($request->has('rating')) {
            $rating = (int) $request->input('rating');

            $query->whereHas('review', function ($query) use ($rating) {
                $query
                    ->select('id_type')
                    ->groupBy('id_type')
                    ->havingRaw('AVG(rating) >= ? AND AVG(rating) < ?', [$rating, $rating + 1]);
            });
        }

        $count_travel = $query->count();
        $travels = $query->paginate(3);

        return view('customer.travel', compact('travels', 'count_travel'));
    }
    public function listTravelDestination($id, Request $request)
    {
        $agen = Operasional::findOrFail($id);
        $query = Paket::where('created_by', $id)->where('status_verifikasi', 'aktif')->where('status_paket', 'tersedia');

        // Handle search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%{$search}%");
        }

        // Handle rating filtering
        if ($request->has('rating')) {
            $rating = (int) $request->input('rating');

            $query->whereHas('review', function ($query) use ($rating) {
                $query
                    ->select('id_type')
                    ->groupBy('id_type')
                    ->havingRaw('AVG(rating) >= ? AND AVG(rating) < ?', [$rating, $rating + 1]);
            });
        }

        $count_paket = $query->count();
        $pakets = $query->paginate(3);

        return view('customer.travel-destination', compact('id', 'pakets', 'count_paket', 'agen'));
    }

    public function detail($id)
    {
        $paket = Paket::with(['kategoriPaket', 'attachment', 'wisata', 'pemanduWisata', 'aktivitas'])->findOrFail($id);

        return view('customer.detail_tourism', compact('paket'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jumlah_peserta' => 'required|integer',
            'catatan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $paket = Paket::findOrFail($request->input('id_paket'));
            $paket->status_paket = 'tidak tersedia';
            $paket->save();

            $kendaraan = Kendaraan::findOrFail($paket->id_kendaraan);
            $kendaraan->status_kendaraan = 'tidak tersedia';
            $kendaraan->save();

            $pemandu = PemanduWisata::findOrFail($paket->id_pemandu_wisata);
            $pemandu->status_pemandu = 'tidak tersedia';
            $pemandu->save();

            $booking = new Booking();
            $booking->id_paket = $request->input('id_paket');
            $booking->id_wisatawan = $request->input('id_wisatawan');
            $booking->nama = $request->input('nama');
            $booking->no_hp = $request->input('no_hp');
            $booking->tanggal = $request->input('tanggal');
            $booking->jumlah_peserta = $request->input('jumlah_peserta');
            $booking->harga = $request->input('jumlah_peserta') * $request->input('harga');
            $booking->catatan = $request->input('catatan');
            $booking->status = 'diproses';
            $booking->save();
            DB::commit();
            Alert::success('Success', 'Paket berhasil di booking!');
            return redirect()->route('wisatawan.booking');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::warning('Warning', 'Paket gagal booking!');
            return redirect()->back()->with('success', 'Booking berhasil dilakukan.');
        }
    }

    public function booking()
    {
        $user_id = Auth::id();
        $list_booking = Booking::where('id_wisatawan', $user_id)->with('paket.operasional', 'paket', 'review_operasional', 'review_paket')->paginate(5);
        return view('customer.booking', compact('list_booking'));
    }

    public function pengaduan()
    {
        $user_id = Auth::id();
        $list_pengaduan = Aduan::where('pemohon_id', $user_id)->get();

        return view('customer.pengaduan', compact('list_pengaduan'));
    }

    public function storePengaduan(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal_kejadian' => 'required|date',
                'bukti_path' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048', // Pastikan file selalu ada
            ]);

            $aduan = new Aduan();
            $aduan->judul = $request->input('judul');
            $aduan->deskripsi = $request->input('deskripsi');
            $aduan->pemohon_id = Auth::id(); // Set pemohon_id sebagai ID user yang login
            $aduan->tanggal_kejadian = $request->input('tanggal_kejadian');

            if ($request->hasFile('bukti_path')) {
                $file = $request->file('bukti_path');
                $filePath = $file->store('bukti', 'public');
                $aduan->bukti_path = $filePath;
            } else {
                // Tambahkan pengecekan untuk memastikan file ada
                return back()->withErrors(['bukti_path' => 'File bukti harus diunggah.']);
            }

            $aduan->status = 'Diajukan'; // Set status awal
            $aduan->save();

            Alert::success('Success', 'Aduan tersimpan!');
            return redirect()->route('wisatawan.pengaduan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['msg' => 'There was an error saving the kendaraan. Please try again.']);
        }
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'deskripsi' => 'required|string|max:255',
            'id_type' => 'required|integer',
            'id_booking' => 'required|integer',
        ]);

        Review::create([
            'rating' => $request->input('rating'),
            'type' => $request->input('type'),
            'deskripsi' => $request->input('deskripsi'),
            'id_type' => $request->input('id_type'),
            'id_booking' => $request->input('id_booking'),
            'created_by' => Auth::id(),
        ]);

        Alert::success('Success', 'Anda berhasil memberikan review!');
        return redirect()->back()->with('success', 'Review berhasil disimpan.');
    }

    public function about()
    {
        return view('customer.about');
    }
}

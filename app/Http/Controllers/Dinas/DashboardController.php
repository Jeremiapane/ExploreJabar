<?php

namespace App\Http\Controllers\Dinas;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aduan;
use App\Models\Operasional; // Pastikan ini diimport
use App\Models\Dinas\Artikel; // Pastikan ini diimport
use App\Models\Dinas\ObjekWisata; // Pastikan ini diimport
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pegawai');
    }

    public function index()
    {
        $pegawai = auth('pegawai')->user()->load('jabatan');

        // Mengambil data jumlah wisatawan (users dengan level 8)
        $total_wisatawan = User::where('id_level', 8)->count();

        // Tanggal minggu ini dan minggu lalu
        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();

        // Hitung jumlah pengguna minggu ini dan minggu lalu
        $thisWeekCount = User::where('id_level', 8)
            ->whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])
            ->count();
        $lastWeekCount = User::where('id_level', 8)
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->count();

        // Menentukan warna dan ikon perubahan
        $change_wisatawan = $thisWeekCount - $lastWeekCount;
        $change_wisatawan_class = $change_wisatawan >= 0 ? 'text-green-500' : 'text-red-500';
        $change_wisatawan_icon = $change_wisatawan >= 0 ? '<svg class="ms-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" /></svg>' : '<svg class="ms-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0L1 9m4 4 4-4" /></svg>';

        // Hitung jumlah aduan minggu ini dan minggu lalu
        $thisWeekAduanCount = Aduan::whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])->count();
        $lastWeekAduanCount = Aduan::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();

        // Menentukan warna dan ikon perubahan aduan
        $change_aduan = $thisWeekAduanCount - $lastWeekAduanCount;
        $change_aduan_class = $change_aduan >= 0 ? 'text-red-500' : 'text-green-500';
        $change_aduan_icon = $change_aduan >= 0 ? '<svg class="ms-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" /></svg>' : '<svg class="ms-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0L1 9m4 4 4-4" /></svg>';

        // Hitung jumlah agen baru aktif minggu ini dan minggu lalu
        $thisWeekAgenCount = Operasional::where('status_verifikasi', 'aktif')
            ->whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])
            ->count();
        $lastWeekAgenCount = Operasional::where('status_verifikasi', 'aktif')
            ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->count();

        // Menentukan warna dan ikon perubahan agen
        $change_agen = $thisWeekAgenCount - $lastWeekAgenCount;
        $change_agen_class = $change_agen >= 0 ? 'text-green-500' : 'text-red-500';
        $change_agen_icon = $change_agen >= 0 ? '<svg class="ms-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4" /></svg>' : '<svg class="ms-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1v12m0 0L1 9m4 4 4-4" /></svg>';

        // Data untuk chart wisatawan
        $dates = [];
        $visitor_counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('d F');
            $dates[] = $date;
            $visitor_counts[] = User::where('id_level', 8)->whereDate('created_at', Carbon::today()->subDays($i))->count();
        }

        // Data untuk chart aduan
        $aduan_dates = [];
        $aduan_counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('d F');
            $aduan_dates[] = $date;
            $aduan_counts[] = Aduan::whereDate('created_at', Carbon::today()->subDays($i))->count();
        }

        // Data untuk chart agen baru aktif
        $operasional_dates = [];
        $operasional_counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('d F');
            $operasional_dates[] = $date;
            $operasional_counts[] = Operasional::where('status_verifikasi', 'aktif')->whereDate('updated_at', Carbon::today()->subDays($i))->count();
        }

        // Ambil artikel aktif
        $artikel_aktif = Artikel::with('kategori', 'penulis')->orderBy('views', 'desc')->take(10)->get();

        // Ambil objek wisata aktif
        $objekWisataAktif = ObjekWisata::where('status', 'active')->latest()->get();

        // Tambahkan URL pencarian untuk setiap objek wisata
        foreach ($objekWisataAktif as $objek) {
            $objek->search_url = $this->convertEmbedUrlToSearchUrl($objek->url_peta);
        }

        return view('dinas.dashboard', [
            'pegawai' => $pegawai,
            'total_wisatawan' => $total_wisatawan,
            'thisWeekCount' => $thisWeekCount,
            'change_wisatawan_class' => $change_wisatawan_class,
            'change_wisatawan_icon' => $change_wisatawan_icon,
            'dates' => $dates,
            'visitor_counts' => $visitor_counts,
            'thisWeekAduanCount' => $thisWeekAduanCount,
            'change_aduan_class' => $change_aduan_class,
            'change_aduan_icon' => $change_aduan_icon,
            'aduan_dates' => $aduan_dates,
            'aduan_counts' => $aduan_counts,
            'operasional_dates' => $operasional_dates,
            'operasional_counts' => $operasional_counts,
            'artikel_aktif' => $artikel_aktif,
            'thisWeekAgenCount' => $thisWeekAgenCount,
            'lastWeekAgenCount' => $lastWeekAgenCount,
            'change_agen_class' => $change_agen_class,
            'change_agen_icon' => $change_agen_icon,
            'objekWisata' => $objekWisataAktif,
        ]);
    }

    private function convertEmbedUrlToSearchUrl($embedUrl)
    {
        // Ekstrak nama tempat dari URL embed
        if (preg_match('/2s([^!]+)/', $embedUrl, $matches)) {
            $placeName = urldecode($matches[1]);
        } else {
            return null; // Nama tempat tidak ditemukan
        }

        // Bangun URL pencarian hanya menggunakan nama tempat
        $searchUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($placeName);

        return $searchUrl;
    }
}

<?php

use Illuminate\Support\Facades\Route;

// General Controllers
use App\Http\Controllers\AduanController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\OperasionalController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\TourismController;
use App\Http\Controllers\TravelController;

// Dinas Controllers
use App\Http\Controllers\Dinas\{AuthController,AgenController, ArtikelController, DaerahController, DashboardController, ForgotPasswordController, KategoriArtikelController, KategoriWisataController, LoginController, ManagementController, ObjekWisataController, ObjekWisataImageController, PegawaiController, PemberitahuanController, PengajuanController, ResetPasswordController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth', 'check.level:2'])->group(function () {
    Route::get('/manager-operasional', [OperasionalController::class, 'dashboardManagerOperasional'])->name('manager-operasional.dashboard');
    Route::get('/manager-operasional/akses', [OperasionalController::class, 'showAksesAkun'])->name('manager-operasional.akses');
    Route::get('/manager-operasional/profile', [OperasionalController::class, 'showProfile'])->name('manager-operasional.profile');

    Route::post('/manager-operasional/akses', [OperasionalController::class, 'storeAkses'])->name('manager-operasional.akses.store');
    Route::put('/operasional/profile/{id}', [OperasionalController::class, 'updateProfile'])->name('operasional.update-profile');
    Route::get('/manager-operasional/informasi', [OperasionalController::class, 'informasi'])->name('manager-operasional.informasi');
    Route::get('/manager-operasional/informasi/{id}', [OperasionalController::class, 'showInformasi'])->name('manager-operasional.informasi.show');

    Route::get('/manager-operasional/tambah-tanggapan/{id}', [OperasionalController::class, 'tanggapan'])->name('manager-operasional.tanggapan');
    Route::post('/manager-operasional/tambah-tanggapan', [OperasionalController::class, 'storeTanggapan'])->name('manager-operasional.tanggapan.store');
    Route::get('/manager-operasional/tanggapan/{id}', [OperasionalController::class, 'showTanggapan'])->name('manager-operasional.tanggapan.show');
});

Route::middleware(['auth', 'check.level:2,3'])->group(function () {
    Route::get('/operasional/kendaraan/{id}', [OperasionalController::class, 'showKendaraan'])->name('operasional.kendaraan.show');
    Route::get('/operasional/kendaraan/edit/{id}', [OperasionalController::class, 'editKendaraan'])->name('operasional.kendaraan.edit');
    Route::put('/operasional/kendaraan/update/{id}', [OperasionalController::class, 'updateKendaraan'])->name('operasional.kendaraan.update');
    Route::get('/operasional/pemandu-wisata/{id}', [OperasionalController::class, 'showPemanduWisata'])->name('operasional.pemandu-wisata.show');
    Route::get('/operasional/pemandu-wisata/{id}/edit', [OperasionalController::class, 'editPemanduWisata'])->name('operasional.pemandu-wisata.edit');
    Route::put('/operasional/pemandu-wisata/{id}', [OperasionalController::class, 'updatePemanduWisata'])->name('operasional.pemandu-wisata.update');
    Route::put('/operasional/kendaraan/update-status/{id}', [OperasionalController::class, 'updateStatusKendaraan'])->name('operasional.kendaraan.update-status');
    Route::put('/operasional/pemandu-wisata/update-status/{id}', [OperasionalController::class, 'updateStatusPemandu'])->name('operasional.pemandu-wisata.update-status');
});

Route::middleware(['auth', 'check.level:3'])->group(function () {
    Route::get('/operasional', [OperasionalController::class, 'dashboardOperasional'])->name('operasional.dashboard');
    Route::get('/operasional/pemandu-wisata', [OperasionalController::class, 'pemanduWisata'])->name('operasional.pemandu-wisata');
    Route::get('/operasional/tambah-pemandu-wisata', [OperasionalController::class, 'tambahPemanduWisata']);
    Route::post('/operasional/pemandu-wisata', [OperasionalController::class, 'storePemanduWisata'])->name('pemandu-wisata.store');
    Route::get('/operasional/kendaraan', [OperasionalController::class, 'kendaraan'])->name('operasional.kendaraan');
    Route::post('/operasional/kendaraan', [OperasionalController::class, 'storeKendaraan'])->name('kendaraan.store');
    Route::get('/operasional/tambah-kendaraan', [OperasionalController::class, 'tambahKendaraan']);
    Route::delete('/operasional/pemandu/{id}', [OperasionalController::class, 'deletePemandu'])->name('operasional.pemandu.delete');
    Route::delete('/operasional/kendaraan/{id}', [OperasionalController::class, 'deleteKendaraan'])->name('operasional.kendaraan.delete');
    Route::get('/operasional/aduan', [OperasionalController::class, 'aduan'])->name('operasional.aduan');
});

Route::get('/operasional/register', [OperasionalController::class, 'register'])->name('operasional.register');
Route::post('/operasional/register', [OperasionalController::class, 'registerStore'])->name('operasional.register.store');
Route::get('/operasional/login', [OperasionalController::class, 'login'])->name('operasional.login');

Route::middleware(['auth', 'check.level:4'])->group(function () {
    Route::get('/manager-marketing', [MarketingController::class, 'dashboardManager'])->name('manager-marketing.dashboard');
    Route::put('/manager-marketing/update-status', [MarketingController::class, 'updateStatusPaket'])->name('marketing.paket.update-status');
});

Route::middleware(['auth', 'check.level:4,5'])->group(function () {
    Route::get('/marketing/paket-wisata/{id}', [MarketingController::class, 'showPaketWisata'])->name('marketing.paket.show');
});

Route::middleware(['auth', 'check.level:5'])->group(function () {
    Route::get('/marketing', [MarketingController::class, 'dashboard'])->name('marketing.dashboard');
    Route::get('/marketing/paket-wisata', [MarketingController::class, 'paketWisata'])->name('marketing.paket');
    Route::get('/marketing/tambah-paket-wisata', [MarketingController::class, 'tambahPaketWisata']);
    Route::post('/marketing/paket-wisata-store', [MarketingController::class, 'storePaket'])->name('marketing.paket.store');
    Route::delete('/marketing/paket/{id}/delete', [MarketingController::class, 'deletePaket'])->name('marketing.paket.delete');
});

Route::middleware(['auth', 'check.level:6'])->group(function () {
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.dashboard');
    Route::get('/penjualan/detail/{id}', [PenjualanController::class, 'detailBooking'])->name('penjualan.detail');
    Route::put('/penjualan/update-status', [PenjualanController::class, 'updateBooking'])->name('penjualan.booking.update-status');
});

Route::middleware(['auth', 'check.level:8'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::get('/pengaduan', [TourismController::class, 'pengaduan'])->name('wisatawan.pengaduan');
    Route::post('/pengaduan', [TourismController::class, 'storePengaduan'])->name('wisatawan.pengaduan.store');
    Route::get('/booking', [TourismController::class, 'booking'])->name('wisatawan.booking');
    Route::post('/booking', [TourismController::class, 'storeBooking'])->name('wisatawan.booking.store');
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/review', [TourismController::class, 'storeReview'])->name('wisatawan.review.store');
});

Route::get('/', [HomeController::class, 'index'])->name('wisatawan.landingpage');
Route::get('/signup', [HomeController::class, 'signup'])->name('wisatawan.signup');
Route::post('/signup', [HomeController::class, 'storeSignup'])->name('wisatawan.signup.store');
Route::get('/blog', [BlogController::class, 'index'])->name('wisatawan.blogpage');
Route::get('/blog/{slug}', [BlogController::class, 'detail']);
Route::get('/destination', [TourismController::class, 'index'])->name('wisatawan.destination');
Route::get('/destination/{id}', [TourismController::class, 'showWisata'])->name('wisatawan.destination.show');
Route::get('/travel', [TourismController::class, 'listTravel'])->name('wisatawan.travel');
Route::get('/travel-destination/{id}', [TourismController::class, 'listTravelDestination'])->name('wisatawan.travel-destination');
Route::get('/destination-detail/{id}', [TourismController::class, 'detail']);
Route::get('/help-center', [HomeController::class, 'helpCenter'])->name('wisatawan.aboutpage');

// Route::get('/travel-dashboard', [TravelController::class, 'index']);
// Route::get('/travel-access-account', [TravelController::class, 'accessAccount']);
// Route::get('/penjualan-dashboard', [TravelController::class, 'dashboardPenjualan']);
// Route::get('/travel-paket-wisata', [TravelController::class, 'paketWisata']);
// Route::get('/travel-request-pemandu', [TravelController::class, 'requestPemanduWisata']);

//Dinas

// routes/web.php
Route::get('/notfound', function () {
    return view('dinas.404'); // Pastikan tampilan ini ada
})->name('notfound');

// Rute dengan pemeriksaan pengguna
Route::prefix('dinas')
    ->middleware('auth.dinas')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dinas.dashboard');

        // Setting
        Route::put('/pegawai/update', [PegawaiController::class, 'update'])->name('dinas.pegawai.update');

        // Logout
        Route::post('/logout', [LoginController::class, 'logout'])->name('dinas.logout');

        // Rute dengan Middleware untuk Atasan
        Route::middleware(['check.jabatan:1,2,3'])->group(function () {
            Route::get('/approval/{pengajuan}', [PengajuanController::class, 'show'])->name('dinas.approval.show');
            Route::post('/pengajuan/{pengajuan}/approve', [PengajuanController::class, 'approve'])->name('dinas.pengajuan.approve');
            Route::post('/pengajuan/{pengajuan}/reject', [PengajuanController::class, 'reject'])->name('dinas.pengajuan.reject');
            Route::get('/approval', [PengajuanController::class, 'approvalIndex'])->name('dinas.approval.index');
        });

        // Rute dengan Middleware untuk Jabatan Staf Humas dan Staf Industri Pariwisata
        Route::middleware(['check.jabatan:4,5'])->group(function () {
            Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('dinas.pengajuan.index');
            Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('dinas.pengajuan.create');
            Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('dinas.pengajuan.store');
            // Route::get('/pengajuan/{pengajuan}', [PengajuanController::class, 'getPengajuan'])->name('dinas.pengajuan.get');

            Route::prefix('pemberitahuan')
                ->name('dinas.pemberitahuan.')
                ->group(function () {
                    Route::get('/create', [PemberitahuanController::class, 'create'])->name('create');
                    Route::post('/', [PemberitahuanController::class, 'store'])->name('store');
                    Route::get('/', [PemberitahuanController::class, 'index'])->name('index');
                    Route::get('/{id}', [PemberitahuanController::class, 'show'])->name('show');
                });

            //Tanggapan
            Route::get('tanggapan', [TanggapanController::class, 'index'])->name('dinas.tanggapan.index');

            // Route untuk menampilkan detail pemberitahuan dan tanggapan
            Route::get('tanggapan/{id}', [TanggapanController::class, 'show'])->name('dinas.tanggapan.show');
        });

        // Rute dengan Middleware untuk Jabatan Staf Industri Pariwisata
        Route::middleware('check.jabatan:5')->group(function () {
            Route::prefix('verifikasi-agen')
                ->name('dinas.verifikasi-agen.')
                ->group(function () {
                    Route::get('/', [AgenController::class, 'index'])->name('index');
                    Route::get('/{id}', [AgenController::class, 'show'])->name('show');
                    Route::post('/{id}/verifikasi', [AgenController::class, 'verifikasi'])->name('verifikasi');
                    Route::post('/{id}/tolak', [AgenController::class, 'tolak'])->name('tolak');
                });

            Route::prefix('monitoring-agen')
                ->name('dinas.monitoring-agen.')
                ->group(function () {
                    Route::get('/', [AgenController::class, 'indexMonitoring'])->name('index');
                    Route::get('/{id}', [AgenController::class, 'showMonitoring'])->name('show');
                });
        });

        // Rute dengan Middleware untuk Jabatan Staf Humas
        Route::middleware('check.jabatan:4')->group(function () {
            Route::prefix('aduan')
                ->name('dinas.')
                ->group(function () {
                    Route::get('/verifikasi', [AduanController::class, 'index'])->name('verifikasi-aduan.index');
                    Route::get('/verifikasi/{id}', [AduanController::class, 'show'])->name('verifikasi-aduan.show');
                    Route::post('/verifikasi/{id}/verify', [AduanController::class, 'verify'])->name('verifikasi-aduan.verify');
                    Route::post('/verifikasi/{id}/reject', [AduanController::class, 'reject'])->name('verifikasi-aduan.reject');
                    Route::get('/penyelesaian', [AduanController::class, 'completed'])->name('penyelesaian-aduan.index');
                    Route::get('/penyelesaian/{id}', [AduanController::class, 'show'])->name('penyelesaian-aduan.show');
                    Route::post('/penyelesaian/{id}/resolve', [AduanController::class, 'resolve'])->name('penyelesaian-aduan.resolve');
                });

            Route::resource('objek-wisata', ObjekWisataController::class)
                ->parameters(['objek-wisata' => 'objekWisata'])
                ->names('dinas.objek-wisata');
            Route::get('/objek-wisata/search', [KategoriWisataController::class, 'search'])->name('dinas.objek-wisata.search');
            Route::delete('objek-wisata/images/{image}', [ObjekWisataImageController::class, 'destroy'])->name('dinas.objek-wisata.images.destroy');

            Route::resource('kategori-wisata', KategoriWisataController::class)
                ->parameters(['kategori-wisata' => 'kategoriWisata'])
                ->names('dinas.kategori-wisata');

            Route::resource('daerah', DaerahController::class)
                ->parameters(['daerah' => 'daerah'])
                ->names('dinas.daerah');

            Route::resource('artikel', ArtikelController::class)
                ->parameters(['artikel' => 'slug'])
                ->names('dinas.artikel');

            Route::resource('kategori-artikel', KategoriArtikelController::class)
                ->parameters(['kategori-artikel' => 'kategoriArtikel'])
                ->names('dinas.kategori-artikel');
        });

        // Rute dengan Middleware untuk Jabatan Kasubag TU
        Route::prefix('manajemen-pegawai')
            ->name('dinas.manajemen-pegawai.')
            ->middleware('check.jabatan:2')
            ->group(function () {
                Route::get('/', [ManagementController::class, 'index'])->name('index');
                Route::post('/store-pegawai', [ManagementController::class, 'storePegawai'])->name('store-pegawai');
                Route::delete('/destroy-pegawai/{pegawai}', [ManagementController::class, 'destroyPegawai'])->name('destroy-pegawai');
                Route::post('/store-jabatan', [ManagementController::class, 'storeJabatan'])->name('store-jabatan');
                Route::put('/update-jabatan/{jabatan}', [ManagementController::class, 'updateJabatan'])->name('update-jabatan');
                Route::delete('/destroy-jabatan/{jabatan}', [ManagementController::class, 'destroyJabatan'])->name('destroy-jabatan');
            });
    });

// Routes for login and password reset processes
Route::middleware(['guest'])->group(function () {
    Route::get('/dinas/login', [LoginController::class, 'showLoginForm'])->name('dinas.login');
    Route::post('/dinas/login', [LoginController::class, 'login'])->name('dinas.login.post');
    Route::get('/dinas/password/reset', [AuthController::class, 'showLinkRequestForm'])->name('pegawai.password.request');
    Route::post('/dinas/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('pegawai.password.email');
    Route::get('/dinas/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('pegawai.password.reset');
    Route::post('/dinas/password/reset', [AuthController::class, 'reset'])->name('pegawai.password.update');
});

require __DIR__ . '/auth.php';

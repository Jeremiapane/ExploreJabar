<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Dinas\Pemberitahuan;
use App\Models\KategoriPaket;
use App\Models\Kendaraan;
use App\Models\Level;
use App\Models\Operasional;
use App\Models\Paket;
use App\Models\PemanduWisata;
use App\Models\Tanggapan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class OperasionalController extends Controller
{
    // Start Manager Operasional

    public function login()
    {
        return view('travel.login');
    }

    private function storeDocument($file, $documentType, $userId)
    {
        $fileName = $documentType . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = 'assets/travel/dokumen/' . $fileName;

        $attachment = new Attachment();
        $attachment->name = $fileName;
        $attachment->path = $filePath;
        $attachment->type = $documentType;
        $attachment->id_type = $userId;
        $attachment->save();

        $file->move(public_path('assets/travel/dokumen/'), $fileName);
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string',
            'no_telp' => 'required',
            'email_perusahaan' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'alamat_perusahaan' => 'required|string',
            'deskripsi' => 'required|string',
            'dokumen_akte' => 'required|max:10000',
            'dokumen_sk' => 'required|max:10000',
            'dokumen_npwp' => 'required|max:10000',
            'dokumen_nib' => 'required|max:10000',
            'dokumen_sertifikasi' => 'required|max:10000',
            'dokumen_ktp' => 'required|max:10000',
            'password' => 'required|string',
        ]);

        try {
            $user = new User();
            $user->nama = $request->input('nama_perusahaan');
            $user->username = $request->input('username');
            $user->email = $request->input('email_perusahaan');
            $user->password = Hash::make($request->input('password'));
            $user->alamat = $request->input('alamat_perusahaan');
            $user->no_telp = $request->input('no_telp');
            $user->id_level = 2;
            $user->save();

            $operasional = new Operasional();
            $operasional->nama_perusahaan = ucwords(strtolower($request->input('nama_perusahaan')));
            $operasional->no_telp_perusahaan = $request->input('no_telp');
            $operasional->alamat_perusahaan = $request->input('alamat_perusahaan');
            $operasional->deskripsi = $request->input('deskripsi');
            $operasional->status_verifikasi = 'diproses';
            $operasional->id_parent_operasional = null;
            $operasional->id_user = $user->id;
            $operasional->save();

            // Simpan dokumen-dokumen ke dalam tabel attachments
            $this->storeDocument($request->file('dokumen_akte'), 'Akte Pendirian', $operasional->id);
            $this->storeDocument($request->file('dokumen_profile'), 'foto profile agen', $operasional->id);
            $this->storeDocument($request->file('dokumen_sk'), 'SK Kemenkumham', $operasional->id);
            $this->storeDocument($request->file('dokumen_npwp'), 'NPWP', $operasional->id);
            $this->storeDocument($request->file('dokumen_nib'), 'NIB', $operasional->id);
            $this->storeDocument($request->file('dokumen_sertifikasi'), 'Sertifikasi Usaha', $operasional->id);
            $this->storeDocument($request->file('dokumen_ktp'), 'KTP Pemilik', $operasional->id);

            Alert::success('Success', 'Registrasi Berhasil!');
            return redirect()->route('operasional.login');
        } catch (\Exception $e) {
            Alert::warning('Warning', 'Registrasi gagal!');
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan agen: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function updateDocument($file, $documentType, $operasionalId)
    {
        // Check if there's an existing document of the same type
        $existingDocument = Attachment::where('type', $documentType)
            ->where('id_type', $operasionalId)
            ->first();

        if ($existingDocument) {
            // Delete the existing file
            $existingFilePath = public_path($existingDocument->path);
            if (file_exists($existingFilePath)) {
                unlink($existingFilePath);
            }

            // Delete the existing document record
            $existingDocument->delete();
        }

        // Store the new document
        $this->storeDocument($file, $documentType, $operasionalId);
    }

    public function updateProfile(Request $request, $id)
    {
        // $request->validate([
        //     'nama_perusahaan' => 'required|string',
        //     'no_telp' => 'required',
        //     'email_perusahaan' => 'required|email|unique:users,email,' . $id,
        //     'alamat_perusahaan' => 'required|string',
        //     'dokumen_akte' => 'nullable|max:10000',
        //     'dokumen_sk' => 'nullable|max:10000',
        //     'dokumen_npwp' => 'nullable|max:10000',
        //     'dokumen_nib' => 'nullable|max:10000',
        //     'dokumen_sertifikasi' => 'nullable|max:10000',
        //     'dokumen_ktp' => 'nullable|max:10000',
        // ]);

        try {
            $operasional = Operasional::find($id);
            $operasional->nama_perusahaan = ucwords(strtolower($request->input('nama_perusahaan')));
            $operasional->no_telp_perusahaan = $request->input('no_telp');
            $operasional->alamat_perusahaan = $request->input('alamat_perusahaan');
            $operasional->save();

            if ($request->hasFile('dokumen_akte')) {
                $this->updateDocument($request->file('dokumen_akte'), 'Akte Pendirian', $operasional->id);
            }
            if ($request->hasFile('dokumen_sk')) {
                $this->updateDocument($request->file('dokumen_sk'), 'SK Kemenkumham', $operasional->id);
            }
            if ($request->hasFile('dokumen_npwp')) {
                $this->updateDocument($request->file('dokumen_npwp'), 'NPWP', $operasional->id);
            }
            if ($request->hasFile('dokumen_nib')) {
                $this->updateDocument($request->file('dokumen_nib'), 'NIB', $operasional->id);
            }
            if ($request->hasFile('dokumen_sertifikasi')) {
                $this->updateDocument($request->file('dokumen_sertifikasi'), 'Sertifikasi Usaha', $operasional->id);
            }
            if ($request->hasFile('dokumen_ktp')) {
                $this->updateDocument($request->file('dokumen_ktp'), 'KTP Pemilik', $operasional->id);
            }

            Alert::success('Success', 'Profile updated successfully!');
            return redirect()
                ->back();
        } catch (\Exception $e) {
            Alert::warning('Warning', 'Update failed!');
            return redirect()
                ->back()
                ->with('error', 'An error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function dashboardManagerOperasional()
    {
        $list_kendaraan = Kendaraan::where('created_by', session('id_operasional'))->with('attachment')->orderBy('created_at', 'desc')->get();
        $pemandu_wisata = PemanduWisata::where('created_by', session('id_operasional'))->with('user', 'attachment')->orderBy('created_at', 'desc')->get();
        $paket = Paket::where('created_by', session('id_operasional'))->get();
        $totalBooking = 0;
        foreach ($paket as $item) {
            $totalBooking += $item->booking()->count();
        }
        $operasional = Operasional::with('review')->find(session('id_operasional'));
        $averageRating = round($operasional->review->avg('rating'), 1);
        $list_kategori = KategoriPaket::get();

        return view('travel.manager-operasional.dashboard', compact('list_kendaraan', 'pemandu_wisata', 'totalBooking', 'averageRating', 'list_kategori'));
    }

    public function showAksesAkun()
    {
        $levels = Level::whereBetween('id', [3, 6])->get();
        $id_operasional = Operasional::where('id_user', Auth::user()->id)->pluck('id');
        $operasionals = Operasional::with('user.level')
            ->where('id_parent_operasional', $id_operasional[0])
            ->get();
        return view('travel.manager-operasional.akses', compact('levels', 'operasionals'));
    }

    public function showProfile()
    {
        $operasional = Operasional::with('user')->find(session('id_operasional'));
        // dd($operasional);

        return view('travel.manager-operasional.profile', compact('operasional'));
    }

    public function storeAkses(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'deskripsi' => 'nullable|string|max:500',
            'id_level' => 'required',
            'password' => 'required|string|min:8',
        ]);

        DB::beginTransaction();
        try {
            $user = new User();
            $user->nama = $request->input('nama');
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->id_level = $request->input('id_level');
            $user->save();

            $id_operasional = Operasional::where('id_user', Auth::user()->id)->pluck('id');
            $operasional = new Operasional();
            $operasional->id_parent_operasional = $id_operasional[0];
            $operasional->id_user = $user->id;
            $operasional->deskripsi = $request->input('deskripsi');
            $operasional->save();

            DB::commit();
            Alert::success('Success', 'Akses Akun Ditambahkan');
            return redirect()->route('manager-operasional.akses')->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::warning('Warning', 'Akses Akun Sudah Ada!');
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan pengguna: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function dashboardOperasional()
    {
        $list_kendaraan = Kendaraan::where('created_by', session('id_operasional'))->with('attachment')->orderBy('created_at', 'desc')->get();
        $pemandu_wisata = PemanduWisata::where('created_by', session('id_operasional'))->with('user', 'attachment')->orderBy('created_at', 'desc')->get();
        return view('travel.operasional.dashboard', compact('list_kendaraan', 'pemandu_wisata'));
    }

    public function pemanduWisata()
    {
        $pemanduWisata = PemanduWisata::with('user', 'attachment')
            ->where('created_by', session('id_operasional'))
            ->orderBy('created_at', 'desc')->get();
        return view('travel.operasional.pemandu-wisata', compact('pemanduWisata'));
    }

    public function showPemanduWisata($id)
    {
        $pemandu = PemanduWisata::with('user', 'attachment', 'kategoriPaket')->findOrFail($id);
        return view('travel.operasional.detail-pemandu', compact('pemandu'));
    }

    public function tambahPemanduWisata()
    {
        $kategoriPaket = KategoriPaket::all();
        return view('travel.operasional.tambah-pemandu-wisata', compact('kategoriPaket'));
    }

    public function storePemanduWisata(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'jenis_kelamin' => 'nullable|string|max:10',
            'alamat' => 'required|string',
            'kategori_paket_id' => 'required',
            'no_telp' => 'required|string|max:15',
            'keahlian' => 'required|string',
            'sertifikasi' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $username = Str::random(10);
            $password = Str::random(10);

            $user = new User();
            $user->nama = $request->nama;
            $user->username = $username;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->alamat = $request->alamat;
            $user->no_telp = $request->no_telp;
            $user->id_level = 7;
            $user->save();

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('assets/travel/img/pemandu');
                $file->move($path, $filename);

                $attachment = new Attachment();
                $attachment->name = $filename;
                $attachment->path = 'assets/travel/img/pemandu/' . $filename;
                $attachment->type = 'pemandu wisata';
                $attachment->id_type = null;
                $attachment->save();
            }

            $pemanduWisata = new PemanduWisata();
            $pemanduWisata->keahlian = $request->keahlian;
            $pemanduWisata->sertifikasi = $request->sertifikasi;
            $pemanduWisata->deskripsi = $request->deskripsi;
            $pemanduWisata->status_pemandu = 'tidak tersedia';
            $pemanduWisata->status_verifikasi = 'diproses';
            $pemanduWisata->id_user = $user->id;
            $pemanduWisata->id_kategori_paket = $request->kategori_paket_id;
            $pemanduWisata->created_by = session('id_operasional');
            $pemanduWisata->save();

            if (isset($attachment)) {
                $attachment->id_type = $pemanduWisata->id;
                $attachment->save();
            }

            DB::commit();

            Alert::success('Success', 'Pemandu Wisata Ditambahkan');
            return redirect()->route('operasional.pemandu-wisata')->with('success', 'Pemandu Wisata Ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menambahkan Pemandu Wisata: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function editPemanduWisata($id)
    {
        $pemanduWisata = PemanduWisata::with('user', 'attachment', 'kategoriPaket')->findOrFail($id);
        $kategoriPaket = KategoriPaket::all();
        return view('travel.operasional.edit-pemandu-wisata', compact('pemanduWisata', 'kategoriPaket'));
    }

    public function updatePemanduWisata(Request $request, $id)
    {
        $pemanduWisata = PemanduWisata::findOrFail($id);
        $user = User::findOrFail($pemanduWisata->id_user);

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|string|max:10',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'keahlian' => 'required|string',
            'sertifikasi' => 'required|string',
            'deskripsi' => 'required|string',
            'kategori_paket_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Update data user
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->alamat = $request->alamat;
            $user->no_telp = $request->no_telp;
            $user->save();

            // Update foto jika ada
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('assets/travel/img/pemandu');
                $file->move($path, $filename);

                // Simpan data ke tabel attachments
                $attachment = Attachment::where('id_type', $pemanduWisata->id)
                    ->where('type', 'pemandu wisata')
                    ->first();
                if ($attachment) {
                    // Hapus file lama
                    if (file_exists(public_path($attachment->path))) {
                        unlink(public_path($attachment->path));
                    }
                    $attachment->name = $filename;
                    $attachment->path = 'assets/travel/img/pemandu/' . $filename;
                    $attachment->save();
                } else {
                    $attachment = new Attachment();
                    $attachment->name = $filename;
                    $attachment->path = 'assets/travel/img/pemandu/' . $filename;
                    $attachment->type = 'pemandu wisata';
                    $attachment->id_type = $pemanduWisata->id;
                    $attachment->save();
                }
            }

            $pemanduWisata->keahlian = $request->keahlian;
            $pemanduWisata->sertifikasi = $request->sertifikasi;
            $pemanduWisata->deskripsi = $request->deskripsi;
            $pemanduWisata->id_kategori_paket = $request->kategori_paket_id;
            if (Auth::user()->id_level == 2 && $request->has('status_verifikasi')) {
                $pemanduWisata->status_verifikasi = $request->status_verifikasi;
                if ($request->status_verifikasi == 'aktif') {
                    $pemanduWisata->status_pemandu = 'tersedia';
                } else {
                    $pemanduWisata->status_pemandu = 'tidak tersedia';
                }
            }
            $pemanduWisata->save();

            DB::commit();

            Alert::success('Success', 'Pemandu Wisata Diperbarui');
            return redirect()->route('operasional.pemandu-wisata')->with('success', 'Pemandu Wisata Diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengupdate Pemandu Wisata: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function updateStatusPemandu(Request $request, $id)
    {
        $pemandu = PemanduWisata::findOrFail($id);
        $pemandu->update([
            'catatan' => $request->catatan,
            'status_verifikasi' => $request->status_verifikasi,
            'status_pemandu' => $request->status_verifikasi == 'aktif' ? 'tersedia' : 'tidak tersedia',
        ]);
        Alert::success('Success', 'Status Pemandu Wisata Diperbarui');
        return redirect()->route('manager-operasional.dashboard');
    }

    public function kendaraan()
    {
        $list_kendaraan = Kendaraan::where('created_by', session('id_operasional'))->with('attachment')->orderBy('created_at', 'desc')->get();
        return view('travel.operasional.kendaraan', compact('list_kendaraan'));
    }

    public function showKendaraan($id)
    {
        $kendaraan = Kendaraan::with('attachment')->where('created_by', session('id_operasional'))->findOrFail($id);
        return view('travel.operasional.detail-kendaraan', compact('kendaraan'));
    }

    public function tambahKendaraan()
    {
        return view('travel.operasional.tambah-kendaraan');
    }

    public function storeKendaraan(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'no_plat' => 'required|string|max:255',
            'tahun_pembuatan' => 'required|string|max:4',
            'warna' => 'required|string|max:255',
            'kapasitas_minimum' => 'required|integer',
            'kapasitas_maximum' => 'required|integer',
            'fitur' => 'required|string',
            'foto_kendaraan' => 'required|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        try {
            $kendaraan = Kendaraan::create([
                'jenis' => $request->jenis,
                'merk' => $request->merk,
                'no_plat' => $request->no_plat,
                'tahun_pembuatan' => $request->tahun_pembuatan,
                'warna' => $request->warna,
                'kapasitas_minimum' => $request->kapasitas_minimum,
                'kapasitas_maximum' => $request->kapasitas_maximum,
                'fitur' => $request->fitur,
                'status_verifikasi' => 'diproses',
                'status_kendaraan' => 'tidak tersedia',
                'created_by' => session('id_operasional'),
            ]);

            if ($request->hasFile('foto_kendaraan')) {
                $file = $request->file('foto_kendaraan');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'assets/travel/img/kendaraan/' . $fileName;
                $file->move(public_path('assets/travel/img/kendaraan'), $fileName);

                Attachment::create([
                    'name' => $fileName,
                    'path' => $filePath,
                    'type' => 'kendaraan',
                    'id_type' => $kendaraan->id,
                ]);
            }

            Alert::success('Success', 'Kendaraan Ditambahkan');
            return redirect()->route('operasional.kendaraan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['msg' => 'There was an error saving the kendaraan. Please try again.']);
        }
    }

    public function editKendaraan($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('travel.operasional.edit-kendaraan', compact('kendaraan'));
    }

    public function updateStatusKendaraan(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update([
            'catatan' => $request->catatan,
            'status_verifikasi' => $request->status_verifikasi,
            'status_kendaraan' => $request->status_verifikasi == 'aktif' ? 'tersedia' : 'tidak tersedia',
        ]);
        Alert::success('Success', 'Status Kendaraan Diperbarui');
        return redirect()->route('manager-operasional.dashboard');
    }

    public function updateKendaraan(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'merk' => 'required|string|max:255',
            'no_plat' => 'required|string|max:255',
            'tahun_pembuatan' => 'required|string|max:4',
            'warna' => 'required|string|max:255',
            'kapasitas_minimum' => 'required|integer',
            'kapasitas_maximum' => 'required|integer',
            'fitur' => 'required|string',
            'foto_kendaraan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update([
            'jenis' => $request->jenis,
            'merk' => $request->merk,
            'no_plat' => $request->no_plat,
            'tahun_pembuatan' => $request->tahun_pembuatan,
            'warna' => $request->warna,
            'kapasitas_minimum' => $request->kapasitas_minimum,
            'kapasitas_maximum' => $request->kapasitas_maximum,
            'fitur' => $request->fitur,
        ]);
        if (Auth::user()->id_level == 2 && $request->has('status_verifikasi')) {
            $kendaraan->update([
                'status_verifikasi' => $request->status_verifikasi,
                'status_kendaraan' => $request->status_verifikasi == 'aktif' ? 'tersedia' : 'tidak tersedia',
            ]);
        }

        if ($request->hasFile('foto_kendaraan')) {
            $file = $request->file('foto_kendaraan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'assets/travel/img/kendaraan/' . $fileName;
            $file->move(public_path('assets/travel/img/kendaraan'), $fileName);

            $attachment = Attachment::where('id_type', $kendaraan->id)
                ->where('type', 'kendaraan')
                ->first();
            if ($attachment) {
                $attachment->update([
                    'name' => $fileName,
                    'path' => $filePath,
                ]);
            } else {
                Attachment::create([
                    'name' => $fileName,
                    'path' => $filePath,
                    'type' => 'kendaraan',
                    'id_type' => $kendaraan->id,
                ]);
            }
        }

        Alert::success('Success', 'Kendaraan Diperbarui');
        return redirect()->route('operasional.kendaraan');
    }

    public function deleteKendaraan($id)
    {
        $kendaraan = Kendaraan::find($id);
        if ($kendaraan) {
            if ($kendaraan->attachment) {
                // Delete the attachment file if exists
                $filePath = public_path($kendaraan->attachment->path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                // Delete attachment record
                $kendaraan->attachment->delete();
            }
            $kendaraan->delete();

            Alert::success('Success', 'Kendaraan Terhapus');
        } else {
            Alert::error('Error', 'Kendaraan tidak ditemukan!');
        }

        return redirect()->route('operasional.kendaraan');
    }

    public function deletePemandu($id)
    {
        $pemandu = PemanduWisata::find($id);
        if ($pemandu) {
            if ($pemandu->attachment) {
                // Delete the attachment file if exists
                $filePath = public_path($pemandu->attachment->path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                // Delete attachment record
                $pemandu->attachment->delete();
            }
            $pemandu->delete();

            Alert::success('Success', 'pemandu Terhapus');
        } else {
            Alert::error('Error', 'pemandu tidak ditemukan!');
        }

        return redirect()->route('operasional.pemandu-wisata');
    }

    public function register()
    {
        return view('travel.operasional.register');
    }

    public function informasi()
    {
        $list_pemberitahuan = Pemberitahuan::where('penerima_id', session('id_operasional'))->get();
        return view('travel.manager-operasional.informasi', compact('list_pemberitahuan'));
    }

    public function showInformasi($id)
    {
        $informasi = Pemberitahuan::with('tanggapans')->findOrFail($id);
        return view('travel.manager-operasional.detail-informasi', compact('informasi'));
    }

    public function tanggapan($id)
    {
        $id_pemberitahuan = $id;
        $informasi = Pemberitahuan::findOrFail($id_pemberitahuan);
        return view('travel.manager-operasional.tanggapan', compact('id_pemberitahuan', 'informasi'));
    }

    public function storeTanggapan(Request $request)
    {
        $request->validate([
            'lampiran' => 'required|file|max:10000',
            'perihal' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        try {
            $lampiranPath = null;

            if ($request->hasFile('lampiran')) {
                $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
            }

            $tanggapan = new Tanggapan();
            $tanggapan->perihal = $request->input('perihal');
            $tanggapan->isi = $request->input('isi');
            $tanggapan->lampiran = $lampiranPath ?? null;
            $tanggapan->pemberitahuan_id = $request->input('id_pemberitahuan');
            $tanggapan->pengirim_id = session('id_operasional');
            $tanggapan->save();
            Alert::success('Success', 'Tanggapan Diperbarui');
            return redirect()->route('manager-operasional.tanggapan.show', $tanggapan->id);
        } catch (\Exception $e) {
            Alert::warning('Warning', 'Failed to submit Tanggapan!');
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function showTanggapan($id_tanggapan)
    {
        $tanggapan = Tanggapan::findOrFail($id_tanggapan);
        $informasi = Pemberitahuan::findOrFail($tanggapan->pemberitahuan_id);
        return view('travel.manager-operasional.detail-tanggapan', compact('tanggapan', 'informasi'));
    }

    //Dinas
    public function showVerifikasiAgen()
    {
        // Mendapatkan daftar agen yang belum diverifikasi
        $agens = Operasional::where('id_parent_operasional', null)->where('status_verifikasi', 'diproses')->get();

        return view('operasional.verifikasi-agen', compact('agens'));
    }

    public function prosesVerifikasiAgen(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:aktif,ditolak',
            'catatan' => 'nullable|string|max:500',
        ]);

        $operasional = Operasional::findOrFail($id);

        // Mengubah status verifikasi agen
        $operasional->status_verifikasi = $request->status_verifikasi;
        $operasional->catatan = $request->status_verifikasi == 'ditolak' ? $request->catatan : null;
        $operasional->save();

        return redirect()->route('dinas.verifikasi.agen')->with('success', 'Status Verifikasi Agen Berhasil Diperbarui!');
    }
}

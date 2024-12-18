<?php
namespace App\Models;

use App\Models\Dinas\Pegawai;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operasional extends Model
{
    use HasFactory;

    protected $table = 'agen_travel';
    protected $fillable = [
        'nama_perusahaan', 'no_telp_perusahaan', 'alamat_perusahaan', 'deskripsi', 'status_verifikasi',
        'id_parent_operasional', 'id_user', 'verifikator_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function verifikator()
    {
        return $this->belongsTo(Pegawai::class, 'verifikator_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'id_type', 'id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'id_type')->where('type', 'operasional');
    }

    // Relasi untuk setiap jenis dokumen secara spesifik
    public function dokumenAkte()
    {
        return $this->attachments()->where('type', 'Akte Pendirian');
    }

    public function dokumenSK()
    {
        return $this->attachments()->where('type', 'SK Kemenkumham');
    }

    public function dokumenNPWP()
    {
        return $this->attachments()->where('type', 'NPWP');
    }

    public function dokumenNIB()
    {
        return $this->attachments()->where('type', 'NIB');
    }

    public function dokumenSertifikasi()
    {
        return $this->attachments()->where('type', 'Sertifikasi Usaha');
    }

    public function dokumenKTP()
    {
        return $this->attachments()->where('type', 'KTP Pemilik');
    }

    public function foto_profile()
    {
        return $this->attachments()->where('type', 'foto profile agen');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id', 'created_by');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id', 'created_by');
    }

    public function pemandu_wisata()
    {
        return $this->belongsTo(PemanduWisata::class, 'id', 'created_by');
    }
}

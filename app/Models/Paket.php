<?php

namespace App\Models;

use App\Models\Dinas\ObjekWisata;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';
    protected $fillable = [
        'status_verifikasi', 'status_paket', 'created_by', 'catatan',
    ];

    public function kategoriPaket()
    {
        return $this->belongsTo(KategoriPaket::class, 'id_kategori_paket');
    }

    public function wisata()
    {
        return $this->belongsTo(ObjekWisata::class, 'id_objek_wisata');
    }

    public function pemanduWisata()
    {
        return $this->belongsTo(PemanduWisata::class, 'id_pemandu_wisata');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'id_paket');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'id_paket');
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'id_type')->where('type', 'paket');
    }

    public function operasional()
    {
        return $this->belongsTo(Operasional::class, 'created_by');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'id_type')->where('type', 'paket');
    }

}

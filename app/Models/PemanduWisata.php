<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemanduWisata extends Model
{
    use HasFactory;

    protected $table = 'pemandu_wisata';

    protected $fillable = [
        'keahlian', 'sertifikasi', 'deskripsi', 'status_pemandu', 'status_verifikasi', 'id_user', 'created_by', 'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'id_type')->where('type', 'pemandu wisata');
    }

    public function kategoriPaket()
    {
        return $this->belongsTo(KategoriPaket::class, 'id_kategori_paket');
    }

    public function paket()
    {
        return $this->hasMany(Paket::class, 'id_pemandu_wisata');
    }

}

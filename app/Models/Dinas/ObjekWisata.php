<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisata extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kategori_id', 'detail', 'daerah_id', 'url_peta', 'status', 'penulis_id'];

    public function kategori()
    {
        return $this->belongsTo(KategoriWisata::class, 'kategori_id');
    }

    public function daerah()
    {
        return $this->belongsTo(Daerah::class, 'daerah_id');
    }

    public function penulis()
    {
        return $this->belongsTo(Pegawai::class, 'penulis_id');
    }

    public function images()
    {
        return $this->hasMany(ObjekWisataImage::class, 'objek_wisata_id');
    }
}

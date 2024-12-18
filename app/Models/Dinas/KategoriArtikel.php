<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriArtikel extends Model
{
    use HasFactory;

    protected $table = 'kategori_artikels'; // Nama tabel sesuai dengan yang ada di database

    protected $fillable = ['nama'];

    // Relasi ke Artikel

    public function artikels()
    {
        return $this->hasMany(Artikel::class, 'kategori_id');
    }

    public function getArtikelsCountAttribute()
    {
        return $this->artikels()->count();
    }
}

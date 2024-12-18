<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels'; // Pastikan nama tabel sesuai

    protected $fillable = ['judul','slug', 'foto_sampul', 'detail', 'kategori_id', 'status', 'penulis_id', 'views'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategori_id');
    }

    // Relasi ke Pegawai
    public function penulis()
    {
        return $this->belongsTo(Pegawai::class, 'penulis_id');
    }
}

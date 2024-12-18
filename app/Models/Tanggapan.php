<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dinas\Pemberitahuan;
use App\Models\Operasional;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapans';

    protected $fillable = [
        'perihal', 'isi', 'pengirim_id', 'pemberitahuan_id', 'lampiran',
    ];

    public function pemberitahuan()
    {
        return $this->belongsTo(Pemberitahuan::class, 'pemberitahuan_id');
    }

    public function pengirim()
    {
        return $this->belongsTo(Operasional::class, 'pengirim_id'); // Pastikan ini sesuai dengan tabel yang benar
    }
}


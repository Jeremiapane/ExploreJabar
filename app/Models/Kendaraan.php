<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $fillable = [
        'jenis', 'merk', 'no_plat', 'tahun_pembuatan', 'warna', 'kapasitas_minimum', 'kapasitas_maximum', 'fitur', 'status_verifikasi', 'status_kendaraan', 'created_by', 'catatan',
    ];

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'id_type')->where('type', 'kendaraan');
    }

}

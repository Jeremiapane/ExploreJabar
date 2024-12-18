<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dinas\Pegawai;
use App\Models\User;

class Aduan extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'pemohon_id', 'tanggal_kejadian', 'status', 'bukti_path', 'tanggal_verifikasi', 'verifikator_id', 'tanggal_penyelesaian', 'penyelesai_id', 'keterangan'];

    protected $casts = [
        'tanggal_kejadian' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'tanggal_penyelesaian' => 'datetime',
    ];

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'pemohon_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(Pegawai::class, 'verifikator_id');
    }

    public function penyelesai()
    {
        return $this->belongsTo(Pegawai::class, 'penyelesai_id');
    }
}

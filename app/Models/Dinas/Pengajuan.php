<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'deskripsi',
        'dokumen',
        'pemohon_id',
        'approver1_id',
        'approver2_id',
        'status',
        'catatan_penolakan'
    ];

    public function pemohon()
    {
        return $this->belongsTo(Pegawai::class, 'pemohon_id');
    }

    public function approver1()
    {
        return $this->belongsTo(Pegawai::class, 'approver1_id');
    }

    public function approver2()
    {
        return $this->belongsTo(Pegawai::class, 'approver2_id');
    }
}

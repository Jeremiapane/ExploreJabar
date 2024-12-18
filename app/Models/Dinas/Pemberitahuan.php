<?php

namespace App\Models\Dinas;

use App\Models\Dinas\Pegawai;
use App\Models\Operasional;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tanggapan;


class Pemberitahuan extends Model
{

    use HasFactory; // Ensure this trait is used if you're using Laravel factories

    protected $table = 'pemberitahuans';

    protected $fillable = [
        'pengirim_id', 'penerima_id', 'perihal', 'isi', 'lampiran', 'status', 'catatan', 'lampiran_balasan', 'tanggal_respon', 'disposisi_id',
    ];

    public function pengirim()
    {
        return $this->belongsTo(Pegawai::class, 'pengirim_id'); // Ensure the Pegawai model is correct
    }

    public function penerima()
    {
        return $this->belongsTo(Operasional::class, 'penerima_id'); // Ensure the Operasional model is correct
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'pemberitahuan_id', 'id');
    }
}

<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    // Relasi ke model Pegawai
    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'jabatan_id');
    }

}

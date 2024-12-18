<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekWisataImage extends Model
{
    use HasFactory;

    protected $fillable = ['objek_wisata_id', 'path'];

    public function objekWisata()
    {
        return $this->belongsTo(ObjekWisata::class);
    }
}

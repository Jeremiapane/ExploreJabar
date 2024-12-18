<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $table = 'attachment';
    protected $fillable = [
        'name', 'path', 'type', 'id_type'
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_type');
    }

    public function pemanduWisata()
    {
        return $this->belongsTo(PemanduWisata::class, 'id_type');
    }
}

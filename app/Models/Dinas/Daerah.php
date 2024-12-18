<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daerah extends Model
{
    use HasFactory;
    
    protected $fillable = ['kecamatan', 'provinsi'];

    public function objekWisatas()
    {
        return $this->hasMany(ObjekWisata::class);
    }

    // Mutator to count wisata related to daerah
    public function getWisatasCountAttribute()
    {
        return $this->objekWisatas()->count();
    }
}

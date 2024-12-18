<?php

namespace App\Models\Dinas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWisata extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama'];

    public function objekWisatas()
    {
        return $this->hasMany(ObjekWisata::class, 'kategori_id');
    }

    public function getWisatasCountAttribute()
    {
        return $this->objekWisatas()->count();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'review';

    protected $fillable = [
        'rating',
        'type',
        'id_type',
        'deskripsi',
        'created_by',
        'id_booking',
    ];

    public function operasional()
    {
        return $this->hasOne(Operasional::class, 'id_type')->where('type', 'operasional');
    }

    public function paket()
    {
        return $this->hasOne(Paket::class, 'id_type')->where('type', 'paket');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}

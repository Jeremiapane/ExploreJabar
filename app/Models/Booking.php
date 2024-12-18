<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking';

    protected $fillable = ['nama', 'no_hp', 'tanggal', 'jumlah_peserta', 'catatan', 'harga', 'status', 'catatan_agen'];

    public function wisatawan()
    {
        return $this->belongsTo(User::class, 'id_wisatawan');
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function review_operasional()
    {
        return $this->hasOne(Review::class, 'id_booking')->where('type', 'operasional');
    }

    public function review_paket()
    {
        return $this->hasOne(Review::class, 'id_booking')->where('type', 'paket');
    }

}

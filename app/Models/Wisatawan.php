<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisatawan extends Model
{
    use HasFactory;
    protected $table = 'wisatawan';

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'id_user',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'id_type')->where('type', 'foto profile');
    }
}

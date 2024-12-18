<?php

namespace App\Models\Dinas;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pegawais';
    protected $fillable = ['nama', 'email', 'password', 'jabatan_id', 'foto'];

    protected $hidden = ['password'];

    // Relasi ke model Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    // Encrypt password automatically before saving to the database
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($pegawai) {
            if ($pegawai->isDirty('password')) {
                $pegawai->attributes['password'] = Hash::make($pegawai->attributes['password']);
            }
        });
    }
}

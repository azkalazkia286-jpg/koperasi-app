<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Yang bisa diisi secara massal (Mass Assignable).
     * Kolom 'nama' dan 'role' wajib dimasukkan di sini.
     */
    protected $fillable = [
        'nama',     // Mengizinkan pengisian kolom nama
        'email',
        'password',
        'role',     // Mengizinkan pengisian kolom role
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi tipe data otomatis dari Laravel.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Model Anggota (Satu User memiliki Satu Profil Anggota)
     */
    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'user_id', 'id');
    }
}
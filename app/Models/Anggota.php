<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    // Mengunci nama tabel
    protected $table = 'anggotas';

    protected $fillable = [
        'user_id', 'kode_anggota', 'nik', 'jenis_kelamin', 
        'tanggal_lahir', 'alamat', 'no_hp', 'pekerjaan'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function pinjaman() { return $this->hasMany(Pinjaman::class); }
    public function simpanan() { return $this->hasMany(Simpanan::class); }
}
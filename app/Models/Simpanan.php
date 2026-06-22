<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    // Mengunci nama tabel agar tidak diubah oleh Laravel
    protected $table = 'simpanans';

    protected $fillable = ['anggota_id', 'jenis_simpanan', 'nominal', 'tanggal', 'keterangan'];
    
    public function anggota() { return $this->belongsTo(Anggota::class); }
}
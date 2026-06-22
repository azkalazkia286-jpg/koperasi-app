<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    // Beri tahu Laravel nama tabel yang benar secara spesifik
    protected $table = 'pinjamans';

    protected $fillable = [
        'anggota_id', 'nomor_pinjaman', 'tanggal_pengajuan', 
        'jumlah_pinjaman', 'tenor', 'bunga', 'total_pinjaman', 'status'
    ];

    public function anggota() { return $this->belongsTo(Anggota::class); }

    // Hitung otomatis saat data dibuat
    public static function boot()
    {
        parent::boot();
        static::creating(function ($pinjaman) {
            $totalBunga = $pinjaman->jumlah_pinjaman * ($pinjaman->bunga / 100);
            $pinjaman->total_pinjaman = $pinjaman->jumlah_pinjaman + $totalBunga;
        });
    }
}
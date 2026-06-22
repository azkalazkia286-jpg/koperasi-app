<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    // --- FITUR ADMIN ---
    public function index()
    {
        // Admin melihat semua pinjaman
        $pinjaman = Pinjaman::with('anggota.user')->latest()->get();
        return view('admin.pinjaman.index', compact('pinjaman'));
    }

    public function approve($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->update(['status' => 'Disetujui']);
        return back()->with('success', 'Pinjaman berhasil disetujui!');
    }

    // --- FITUR ANGGOTA ---
    // --- FITUR ANGGOTA ---
    public function riwayat()
    {
        // 1. Ambil user menggunakan Facade Auth (Garis merah akan hilang)
        $user = Auth::user();

        // 2. Cek kemanan: Pastikan user login DAN punya relasi data anggota
        if (!$user || !$user->anggota) {
            return back()->with('error', 'Profil anggota Anda belum ditemukan. Silakan hubungi admin.');
        }

        // 3. Jika aman, ambil data anggotanya
        $anggota = $user->anggota;

        // 4. Ambil riwayat pinjaman
        $pinjaman = \App\Models\Pinjaman::where('anggota_id', $anggota->id)->latest()->get();
        
        return view('anggota.pinjaman.index', compact('pinjaman'));
    }

    public function store(Request $request)
{
    $request->validate([
        'jumlah_pinjaman' => 'required|numeric|min:500000',
        'tenor' => 'required|in:3,6,12,24',
    ]);

    // AMAN: Cek apakah user punya profil anggota
   $user = Auth::user(); 
if (!$user || !$user->anggota) {
    return back()->with('error', 'Profil anggota tidak ditemukan.');
}

    $anggotaId = $user->anggota->id;

    // Cek apakah punya pinjaman aktif
    $pinjamanAktif = Pinjaman::where('anggota_id', $anggotaId)
        ->whereIn('status', ['Menunggu', 'Disetujui'])
        ->first();

    if ($pinjamanAktif) {
        return back()->with('error', 'Anda masih memiliki pinjaman aktif atau dalam proses pengajuan.');
    }

    // Simpan data
    Pinjaman::create([
        'anggota_id' => $anggotaId,
        'nomor_pinjaman' => 'PJ-' . date('YmdHis'),
        'tanggal_pengajuan' => now(),
        'jumlah_pinjaman' => $request->jumlah_pinjaman,
        'tenor' => $request->tenor,
        'bunga' => 5,
        'status' => 'Menunggu',
        'total_pinjaman' => $request->jumlah_pinjaman + ($request->jumlah_pinjaman * 0.05),
    ]);

    return back()->with('success', 'Pengajuan berhasil dikirim!');
}
}
<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAnggota = Anggota::count();
        $totalSimpanan = Simpanan::sum('nominal');
        $pinjamanAktif = Pinjaman::where('status', 'Disetujui')->sum('total_pinjaman');
        $pengajuanPinjaman = Pinjaman::with('anggota.user')->where('status', 'Menunggu')->get();

        return view('admin.dashboard', compact('totalAnggota', 'totalSimpanan', 'pinjamanAktif', 'pengajuanPinjaman'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Angsuran;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = [
            'total_anggota' => Anggota::count(),
            'total_simpanan' => Simpanan::sum('nominal'),
            'pinjaman_disetujui' => Pinjaman::where('status', 'Disetujui')->sum('total_pinjaman'),
            'total_angsuran_masuk' => Angsuran::sum('nominal'),
        ];

        return view('admin.laporan.index', compact('laporan'));
    }
}
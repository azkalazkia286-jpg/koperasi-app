<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class AngsuranController extends Controller
{
    public function index()
    {
        $angsuran = Angsuran::with('pinjaman.anggota.user')->latest()->get();
        $pinjamanAktif = Pinjaman::with('anggota.user')->where('status', 'Disetujui')->get();
        
        return view('admin.angsuran.index', compact('angsuran', 'pinjamanAktif'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjaman_id' => 'required|exists:pinjamans,id',
            'nominal' => 'required|numeric|min:1000',
        ]);

        $pinjaman = Pinjaman::findOrFail($request->pinjaman_id);
        
        // Hitung total yang sudah dibayar
        $totalDibayar = Angsuran::where('pinjaman_id', $pinjaman->id)->sum('nominal');
        $sisaPinjaman = $pinjaman->total_pinjaman - ($totalDibayar + $request->nominal);
        $angsuranKe = Angsuran::where('pinjaman_id', $pinjaman->id)->count() + 1;

        Angsuran::create([
            'pinjaman_id' => $pinjaman->id,
            'angsuran_ke' => $angsuranKe,
            'tanggal_bayar' => now(),
            'nominal' => $request->nominal,
            'sisa_pinjaman' => $sisaPinjaman < 0 ? 0 : $sisaPinjaman,
        ]);

        // Jika lunas otomatis ubah status
        if ($sisaPinjaman <= 0) {
            $pinjaman->update(['status' => 'Lunas']);
        }

        return back()->with('success', 'Pembayaran angsuran berhasil diproses.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function index()
    {
        $simpanan = Simpanan::with('anggota.user')->latest()->get();
        // Ambil data anggota untuk dropdown pilihan saat menambah simpanan
        $anggota = Anggota::with('user')->get(); 
        
        return view('admin.simpanan.index', compact('simpanan', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis_simpanan' => 'required|in:Pokok,Wajib,Sukarela',
            'nominal' => 'required|numeric|min:10000',
        ]);

        Simpanan::create([
            'anggota_id' => $request->anggota_id,
            'jenis_simpanan' => $request->jenis_simpanan,
            'nominal' => $request->nominal,
            'tanggal' => now(),
            'keterangan' => $request->keterangan ?? 'Setoran ' . $request->jenis_simpanan,
        ]);

        return back()->with('success', 'Transaksi simpanan berhasil dicatat.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
   public function index()
{
    // Mengambil semua data anggota beserta relasi usernya
    $anggota = \App\Models\Anggota::with('user')->latest()->get();

    // Kirim variabel $anggota ke view
    return view('admin.anggota.index', compact('anggota'));
}
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'nik' => 'required|string|unique:anggotas|max:16',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|max:15',
        ]);

        // 1. Buat Akun Login User
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('password'), // Password default akun baru
            'role' => 'anggota',
        ]);

        // 2. Simpan Data Profil Anggota
        Anggota::create([
            'user_id' => $user->id,
            'kode_anggota' => 'A-' . str_pad(Anggota::count() + 1, 4, '0', STR_PAD_LEFT),
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir ?? now(),
            'alamat' => $request->alamat ?? '-',
            'no_hp' => $request->no_hp,
            'pekerjaan' => $request->pekerjaan ?? '-',
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan! Akun login telah dibuat.');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->user->delete(); // Otomatis menghapus data anggota karena relasi cascade
        return back()->with('success', 'Data anggota beserta akun login berhasil dihapus.');
    }
}
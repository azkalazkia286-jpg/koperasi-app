<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function dashboard()
    {
        // Mengambil data anggota berdasarkan user yang login
        $anggota = \App\Models\Anggota::where('user_id', Auth::id())->first();

        // Kirim variabel $anggota ke view
        return view('anggota.dashboard', compact('anggota'));
    }
}
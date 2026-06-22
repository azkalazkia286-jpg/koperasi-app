<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $anggota = $user->anggota()->with(['simpanan', 'pinjaman'])->first();
        
        return view('anggota.dashboard', compact('anggota'));
    }
}
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{AdminController, MemberController, PinjamanController, AnggotaController, SimpananController, AngsuranController, LaporanController, ProfileController};

Route::get('/', function () { return redirect()->route('login'); });

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    // PINTU GERBANG UTAMA
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
        return redirect()->route('anggota.dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ADMIN ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('anggota', AnggotaController::class);
        Route::resource('simpanan', SimpananController::class);
        Route::resource('pinjaman', PinjamanController::class);
        Route::post('/pinjaman/{id}/approve', [PinjamanController::class, 'approve'])->name('pinjaman.approve');
        Route::resource('angsuran', AngsuranController::class);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    });

    // --- ANGGOTA ---
    Route::middleware(['role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
        Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');
        Route::get('/pinjaman', [PinjamanController::class, 'riwayat'])->name('pinjaman.index');
        Route::post('/pinjaman/ajukan', [PinjamanController::class, 'store'])->name('pinjaman.store');
    });

    // ========================================================
    // TAMBAHKAN BAGIAN INI DI DALAM GRUP AUTH
    // ========================================================
    Route::get('/informasi/profil', function () { return view('informasi.profil'); })->name('informasi.profil');
    Route::get('/informasi/struktur', function () { return view('informasi.struktur'); })->name('informasi.struktur');
    Route::get('/informasi/tentang-kami', function () { return view('informasi.tentang'); })->name('informasi.tentang');
    Route::get('/informasi/kontak', function () { return view('informasi.kontak'); })->name('informasi.kontak');
});
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Pastikan user sudah login
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah role user sesuai dengan yang diminta di rute
        // Menggunakan !== agar perbandingan tipe data lebih aman
        if ($request->user()->role !== $role) {
            
            // 3. Jika peran tidak sesuai, kita gunakan abort(403) 
            // untuk menghentikan loop redirect yang sering terjadi.
            // Ini akan menampilkan halaman "403 Forbidden".
            abort(403, 'Anda tidak memiliki hak akses untuk halaman ini.');
        }

        // 4. Jika peran cocok, lanjutkan proses ke Controller
        return $next($request);
    }
}
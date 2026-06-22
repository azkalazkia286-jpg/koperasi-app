<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Pastikan user sudah login menggunakan Facade Auth
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil data user yang sedang login
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 3. Cek apakah role sesuai
        if ($user->role !== $role) {
            abort(403, 'Akses tidak diizinkan. Khusus ' . ucfirst($role));
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('user')->latest()->get();
        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi data input dari Form
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'nomor_anggota' => 'required|string|unique:anggotas,nomor_anggota',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        // 2. Jalankan Database Transaction untuk keamanan data ganda
        DB::beginTransaction();

        try {
            // 3. Simpan data ke tabel 'users'
            $user = User::create([
                'nama'     => $request->nama, // Menjawab error: memasukkan field nama
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'anggota', // Otomatis set sebagai peran anggota
            ]);

            // 4. Simpan data profil ke tabel 'anggotas'
            Anggota::create([
                'user_id'       => $user->id, // Menghubungkan ID user yang baru dibuat
                'nomor_anggota' => $request->nomor_anggota,
                'telepon'       => $request->telepon,
                'alamat'        => $request->alamat,
            ]);

            // Jika semua proses berhasil, simpan permanen ke database
            DB::commit();

            return redirect()->route('admin.anggota.index')->with('success', 'Anggota baru berhasil didaftarkan!');

        } catch (\Exception $e) {
            // Jika ada satu saja yang gagal, batalkan semua perubahan data
            DB::rollback();
            return back()->with('error', 'Gagal menambah anggota: ' . $e->getMessage())->withInput();
        }
    }

    public function show(string $id)
    {
        $anggota = Anggota::with('user')->findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }

    public function edit(string $id)
    {
        $anggota = Anggota::with('user')->findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = $anggota->user;

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            // Update data User
            $user->update([
                'nama'  => $request->nama,
                'email' => $request->email,
            ]);

            // Jika kolom password diisi, baru kita ganti
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // Update data Anggota
            $anggota->update([
                'telepon' => $request->telepon,
                'alamat'  => $request->alamat,
            ]);

            DB::commit();
            return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);

        DB::beginTransaction();
        try {
            // Hapus akun user terlebih dahulu, data anggota otomatis ikut terhapus jika ada relasi onDelete('cascade')
            if ($anggota->user) {
                $anggota->user()->delete();
            }
            $anggota->delete();

            DB::commit();
            return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
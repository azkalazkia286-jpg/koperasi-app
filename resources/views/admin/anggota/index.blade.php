@extends('layouts.app')
@section('title', 'Manajemen Anggota')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <span class="fw-bold text-primary"><i class="fa-solid fa-users me-1"></i> Daftar Anggota Koperasi</span>
        <button class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
            <i class="fa-solid fa-plus"></i> Tambah Anggota
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable w-100">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Anggota</th>
                        <th>NIK</th>
                        <th>No. HP</th>
                        <th>Tgl Terdaftar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggota as $a)
                    <tr>
                        <td class="align-middle fw-bold text-success">{{ $a->kode_anggota }}</td>
                        <td class="align-middle">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($a->user->nama) }}&background=random" class="rounded-circle me-2" width="30">
                                {{ $a->user->nama }}
                            </div>
                        </td>
                        <td class="align-middle">{{ $a->nik }}</td>
                        <td class="align-middle">{{ $a->no_hp }}</td>
                        <td class="align-middle">{{ $a->created_at->format('d M Y') }}</td>
                        <td class="text-center align-middle">
                            <form action="{{ route('admin.anggota.destroy', $a->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini beserta akun loginnya?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahAnggota" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-user-plus me-2"></i>Tambah Anggota Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.anggota.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email Login</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">NIK (No. KTP)</label>
                            <input type="text" name="nik" class="form-control" maxlength="16" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No. Handphone</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold"><i class="fa-solid fa-save"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
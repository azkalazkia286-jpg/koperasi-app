@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold">Dashboard Admin</h2>
            <hr>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-white-50">Total Anggota</h6>
                    <h3 class="card-text fw-bold">{{ $totalAnggota }} Orang</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-white-50">Total Simpanan</h6>
                    <h3 class="card-text fw-bold">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="card-title text-uppercase text-white-50">Pinjaman Aktif</h6>
                    <h3 class="card-text fw-bold">Rp {{ number_format($pinjamanAktif, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            Pengajuan Pinjaman Baru
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nama Anggota</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Tenor</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengajuanPinjaman as $p)
                        <tr>
                            <td class="align-middle">{{ $p->anggota->user->nama }}</td>
                            <td class="align-middle">Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                            <td class="align-middle">{{ $p->tenor }} Bulan</td>
                            <td class="text-center align-middle">
                                <form action="{{ route('admin.pinjaman.approve', $p->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada pengajuan pinjaman baru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
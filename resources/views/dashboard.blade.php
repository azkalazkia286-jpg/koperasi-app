@extends('layouts.app')
@section('title', 'Dashboard Administrator')

@section('content')
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2 border-start border-primary border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Anggota</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">{{ $totalAnggota }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-users stat-icon text-black-50"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2 border-start border-success border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Simpanan</div>
                        <div class="h4 mb-0 fw-bold text-gray-800">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-piggy-bank stat-icon text-black-50"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2 border-start border-warning border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">Pinjaman Aktif</div>
                        <div class="h4 mb-0 fw-bold text-gray-800">Rp {{ number_format($pinjamanAktif, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-money-bill-transfer stat-icon text-black-50"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100 py-2 border-start border-danger border-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-danger text-uppercase mb-1">Menunggu Persetujuan</div>
                        <div class="h3 mb-0 fw-bold text-gray-800">{{ $pengajuanPinjaman->count() }}</div>
                    </div>
                    <div class="col-auto"><i class="fa-solid fa-file-signature stat-icon text-black-50"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-primary"><i class="fa-solid fa-bell me-1"></i> Pengajuan Pinjaman Baru</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered datatable w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No. Pinjaman</th>
                                <th>Nama Anggota</th>
                                <th>Pengajuan (Rp)</th>
                                <th>Tenor</th>
                                <th>Bunga</th>
                                <th>Total Kembali</th>
                                <th>Tanggal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajuanPinjaman as $p)
                            <tr>
                                <td class="align-middle fw-medium">{{ $p->nomor_pinjaman }}</td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($p->anggota->user->nama) }}&background=random" class="rounded-circle me-2" width="30">
                                        {{ $p->anggota->user->nama }}
                                    </div>
                                </td>
                                <td class="align-middle text-primary fw-bold">Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                                <td class="align-middle">{{ $p->tenor }} Bulan</td>
                                <td class="align-middle text-danger">{{ $p->bunga }}%</td>
                                <td class="align-middle fw-bold">Rp {{ number_format($p->total_pinjaman, 0, ',', '.') }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y') }}</td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('admin.pinjaman.approve', $p->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success w-100" onclick="return confirm('Yakin ingin menyetujui pinjaman ini?')">
                                            <i class="fa-solid fa-check"></i> Setujui
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
    </div>
</div>
@endsection
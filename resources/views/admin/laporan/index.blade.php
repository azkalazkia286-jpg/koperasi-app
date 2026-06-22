@extends('layouts.app')
@section('title', 'Laporan Koperasi')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5">
                <i class="fa-solid fa-print text-muted mb-3" style="font-size: 4rem;"></i>
                <h3 class="fw-bold text-gray-800">Pusat Laporan Koperasi</h3>
                <p class="text-muted">Cetak rekapitulasi data secara instan</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card bg-success text-white shadow-sm h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-arrow-down me-2"></i>Total Uang Masuk</h5>
                <p class="mb-1">Simpanan Anggota: <strong>Rp {{ number_format($laporan['total_simpanan'], 0, ',', '.') }}</strong></p>
                <p class="mb-0">Angsuran Dibayar: <strong>Rp {{ number_format($laporan['total_angsuran_masuk'], 0, ',', '.') }}</strong></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card bg-warning text-dark shadow-sm h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-3"><i class="fa-solid fa-arrow-up me-2"></i>Total Uang Keluar</h5>
                <p class="mb-1">Pinjaman Disetujui (Modal yang berputar):</p>
                <h3 class="fw-bold">Rp {{ number_format($laporan['pinjaman_disetujui'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
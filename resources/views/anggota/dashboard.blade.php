@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold">Beranda Anggota</h2>
            <hr>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">
                    Profil Saya
                </div>
                <div class="card-body">
                    <p class="mb-1 text-muted">Nama Lengkap</p>
                    <p class="fw-bold">{{ Auth::user()->nama }}</p>
                    
                    <p class="mb-1 text-muted">Kode Anggota</p>
                    <p class="fw-bold">{{ $anggota->kode_anggota }}</p>
                    
                    <p class="mb-1 text-muted">Email</p>
                    <p class="fw-bold">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">
                    Ajukan Pinjaman
                </div>
                <div class="card-body">
                    <form action="{{ route('anggota.pinjaman.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Pinjaman (Rp)</label>
                            <input type="number" name="jumlah_pinjaman" class="form-control" placeholder="Minimal Rp 500.000" required min="500000">
                            <div class="form-text">Bunga flat 5% akan dihitung otomatis.</div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Tenor (Bulan)</label>
                            <select name="tenor" class="form-select" required>
                                <option value="" disabled selected>Pilih Tenor Angsuran</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                                <option value="24">24 Bulan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">
                            Ajukan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
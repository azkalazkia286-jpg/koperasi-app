@extends('layouts.app')
@section('title', 'Struktur Organisasi')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-info text-white fw-bold">
        <i class="fa-solid fa-sitemap me-2"></i> Struktur Organisasi
    </div>
    <div class="card-body text-center">
        <div class="p-4 border rounded bg-light mb-3">
            <h5 class="fw-bold">Rapat Anggota Tahunan (RAT)</h5>
            <i class="fa-solid fa-arrow-down my-2"></i>
            <div class="d-flex justify-content-center gap-5">
                <div class="p-3 border rounded bg-white w-25"><strong>Ketua Pengurus</strong></div>
                <div class="p-3 border rounded bg-white w-25"><strong>Dewan Pengawas</strong></div>
            </div>
            <i class="fa-solid fa-arrow-down my-2"></i>
            <div class="d-flex justify-content-center gap-3">
                <div class="p-3 border rounded bg-white w-25">Sekretaris</div>
                <div class="p-3 border rounded bg-white w-25">Bendahara</div>
                <div class="p-3 border rounded bg-white w-25">Manajer Usaha</div>
            </div>
        </div>
    </div>
</div>
@endsection
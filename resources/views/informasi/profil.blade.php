@extends('layouts.app')
@section('title', 'Profil Koperasi')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
        <i class="fa-solid fa-building me-2"></i> Profil Koperasi
    </div>
    <div class="card-body">
        <h5>Visi</h5>
        <p>Menjadi koperasi simpan pinjam yang terpercaya, mandiri, dan menyejahterakan seluruh anggotanya.</p>
        
        <h5 class="mt-4">Misi</h5>
        <ul>
            <li>Memberikan pelayanan keuangan yang prima dan mudah diakses.</li>
            <li>Mendorong budaya menabung bagi para anggota.</li>
            <li>Memberikan pinjaman dengan bunga yang kompetitif dan transparan.</li>
        </ul>
    </div>
</div>
@endsection
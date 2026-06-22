@extends('layouts.app')
@section('title', 'Kelola Pinjaman')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold text-primary">
        <i class="fa-solid fa-hand-holding-dollar me-1"></i> Data Seluruh Pinjaman
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable w-100">
                <thead class="table-light">
                    <tr>
                        <th>No. Pinjaman</th>
                        <th>Anggota</th>
                        <th>Total Pinjaman</th>
                        <th>Tenor</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pinjaman as $p)
                    <tr>
                        <td class="align-middle fw-medium">{{ $p->nomor_pinjaman }}</td>
                        <td class="align-middle">{{ $p->anggota->user->nama }}</td>
                        <td class="align-middle fw-bold">Rp {{ number_format($p->total_pinjaman, 0, ',', '.') }}</td>
                        <td class="align-middle">{{ $p->tenor }} Bulan</td>
                        <td class="align-middle">
                            @if($p->status == 'Menunggu') <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($p->status == 'Disetujui') <span class="badge bg-primary">Berjalan</span>
                            @else <span class="badge bg-success">Lunas</span> @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($p->status == 'Menunggu')
                                <form action="{{ route('admin.pinjaman.approve', $p->id) }}" method="POST">
                                    @csrf <button type="submit" class="btn btn-sm btn-success w-100"><i class="fa-solid fa-check"></i> Setujui</button>
                                </form>
                            @else
                                <span class="text-muted small"><i class="fa-solid fa-lock"></i> Terkunci</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('title', 'Riwayat Pinjaman')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold text-primary">
        <i class="fa-solid fa-list me-2"></i> Riwayat Pinjaman Saya
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No. Pinjaman</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pinjaman as $p)
                    <tr>
                        <td>{{ $p->nomor_pinjaman }}</td>
                        <td>Rp {{ number_format($p->jumlah_pinjaman, 0, ',', '.') }}</td>
                        <td>
                            @if($p->status == 'Menunggu') <span class="badge bg-warning">Menunggu</span>
                            @else <span class="badge bg-success">{{ $p->status }}</span> @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada riwayat pinjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
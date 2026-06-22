@extends('layouts.app')
@section('title', 'Transaksi Angsuran')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <span class="fw-bold text-info"><i class="fa-solid fa-file-invoice-dollar me-1"></i> Riwayat Pembayaran Angsuran</span>
        <button class="btn btn-sm btn-info text-white fw-bold" data-bs-toggle="modal" data-bs-target="#modalBayarAngsuran">
            <i class="fa-solid fa-plus"></i> Bayar Angsuran
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable w-100">
                <thead class="table-light">
                    <tr>
                        <th>Tgl Bayar</th>
                        <th>No. Pinjaman</th>
                        <th>Anggota</th>
                        <th>Angsuran Ke-</th>
                        <th>Nominal</th>
                        <th>Sisa Hutang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($angsuran as $a)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($a->tanggal_bayar)->format('d M Y') }}</td>
                        <td>{{ $a->pinjaman->nomor_pinjaman }}</td>
                        <td>{{ $a->pinjaman->anggota->user->nama }}</td>
                        <td><span class="badge bg-secondary">Ke-{{ $a->angsuran_ke }}</span></td>
                        <td class="text-success fw-bold">Rp {{ number_format($a->nominal, 0, ',', '.') }}</td>
                        <td class="text-danger">Rp {{ number_format($a->sisa_pinjaman, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBayarAngsuran" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-money-bill-wave me-2"></i>Bayar Angsuran</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.angsuran.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Pinjaman Aktif</label>
                        <select name="pinjaman_id" class="form-select" required>
                            <option value="">-- Pilih Anggota (No. Pinjaman) --</option>
                            @foreach($pinjamanAktif as $pa)
                                <option value="{{ $pa->id }}">{{ $pa->anggota->user->nama }} - {{ $pa->nomor_pinjaman }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nominal Pembayaran (Rp)</label>
                        <input type="number" name="nominal" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info text-white fw-bold"><i class="fa-solid fa-check"></i> Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
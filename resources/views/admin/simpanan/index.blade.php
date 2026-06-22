@extends('layouts.app')
@section('title', 'Transaksi Simpanan')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <span class="fw-bold text-success"><i class="fa-solid fa-wallet me-1"></i> Riwayat Simpanan Anggota</span>
        <button class="btn btn-sm btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#modalTambahSimpanan">
            <i class="fa-solid fa-plus"></i> Catat Setoran Baru
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered datatable w-100">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Anggota</th>
                        <th>Jenis Simpanan</th>
                        <th>Keterangan</th>
                        <th class="text-end">Nominal (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($simpanan as $s)
                    <tr>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</td>
                        <td class="align-middle fw-medium">{{ $s->anggota->user->nama }}</td>
                        <td class="align-middle">
                            <span class="badge bg-{{ $s->jenis_simpanan == 'Pokok' ? 'primary' : ($s->jenis_simpanan == 'Wajib' ? 'success' : 'info') }}">
                                {{ $s->jenis_simpanan }}
                            </span>
                        </td>
                        <td class="align-middle">{{ $s->keterangan }}</td>
                        <td class="align-middle text-end fw-bold text-success">{{ number_format($s->nominal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahSimpanan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-hand-holding-dollar me-2"></i>Setoran Simpanan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.simpanan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Anggota</label>
                        <select name="anggota_id" class="form-select" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggota as $a)
                                <option value="{{ $a->id }}">{{ $a->kode_anggota }} - {{ $a->user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Simpanan</label>
                        <select name="jenis_simpanan" class="form-select" required>
                            <option value="Pokok">Simpanan Pokok (Sekali seumur hidup)</option>
                            <option value="Wajib">Simpanan Wajib (Per Bulan)</option>
                            <option value="Sukarela">Simpanan Sukarela (Bebas)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nominal Setoran (Rp)</label>
                        <input type="number" name="nominal" class="form-control" placeholder="100000" min="10000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan Tambahan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold"><i class="fa-solid fa-check"></i> Proses Setoran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
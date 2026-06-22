@extends('layouts.app')
@section('title', 'Kontak Kami')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white fw-bold">
        <i class="fa-solid fa-phone me-2"></i> Hubungi Kami
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light p-3 rounded me-3 text-primary">
                        <i class="fa-solid fa-location-dot fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Alamat Kantor</h6>
                        <span class="text-muted">Jl. Jendral Sudirman No. 123, Kuningan, Jawa Barat</span>
                    </div>
                </div>
                
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-light p-3 rounded me-3 text-success">
                        <i class="fa-brands fa-whatsapp fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">WhatsApp / Telepon</h6>
                        <span class="text-muted">+62 812-3456-7890</span>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="bg-light p-3 rounded me-3 text-danger">
                        <i class="fa-solid fa-envelope fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Email</h6>
                        <span class="text-muted">info@koperasimodern.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
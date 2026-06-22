<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Koperasi Simpan Pinjam</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #2c3e50; /* Warna biru gelap elegan */
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
        }
        .login-card { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.3); 
            width: 100%; 
            max-width: 420px; 
            padding: 2.5rem; 
            background: #ffffff; 
        }
        .btn-primary { 
            background-color: #18bc9c; 
            border-color: #18bc9c; 
        }
        .btn-primary:hover { 
            background-color: #128f76; 
            border-color: #128f76; 
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-4">
            <div class="h1 text-primary mb-2"><i class="fa-solid fa-building-columns"></i></div>
            <h4 class="fw-bold text-gray-800">KSP Modern</h4>
            <p class="text-muted small">Silakan masuk ke akun Anda</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-medium small">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text text-muted"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="contoh@email.com">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-medium small">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text text-muted"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 mb-3">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Masuk Sekarang
            </button>
            
            <div class="text-center">
                <a href="#" class="text-muted small text-decoration-none">Lupa kata sandi?</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KSP Modern')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        #sidebar { min-width: 250px; max-width: 250px; background: #2c3e50; color: #fff; min-height: 100vh; position: fixed; overflow-y: auto; }
        #sidebar::-webkit-scrollbar { width: 5px; }
        #sidebar::-webkit-scrollbar-thumb { background: #1a252f; }
        #sidebar .sidebar-header { padding: 20px; background: #1a252f; text-align: center; }
        #sidebar ul.components { padding: 20px 0; }
        #sidebar ul li a { padding: 12px 20px; font-size: 15px; display: block; color: #aeb2b7; text-decoration: none; transition: 0.3s;}
        #sidebar ul li a:hover, #sidebar ul li.active > a { color: #fff; background: #18bc9c; border-left: 4px solid #fff; }
        #content { width: 100%; padding: 0; margin-left: 250px; }
        .topbar { background: #fff; padding: 15px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: relative; }
        .main-body { padding: 30px; }
        .card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.04); margin-bottom: 25px; }
        
        /* CSS Khusus Dropdown Manual */
        .custom-dropdown-menu {
            display: none;
            position: absolute;
            right: 30px;
            top: 65px;
            background: white;
            min-width: 180px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border: 1px solid #eee;
            z-index: 9999;
        }
        .custom-dropdown-menu a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            transition: 0.2s;
        }
        .custom-dropdown-menu a:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav id="sidebar">
            <div class="sidebar-header"><h4 class="mb-0 fw-bold"><i class="fa-solid fa-building-columns me-2"></i> KSP Modern</h4></div>
            <ul class="list-unstyled components">
                @if(Auth::user()->role === 'admin')
                    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-gauge fa-fw"></i> Dashboard Admin</a></li>
                    <li class="{{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}"><a href="{{ route('admin.anggota.index') }}"><i class="fa-solid fa-users fa-fw"></i> Kelola Anggota</a></li>
                    <li class="{{ request()->routeIs('admin.simpanan.*') ? 'active' : '' }}"><a href="{{ route('admin.simpanan.index') }}"><i class="fa-solid fa-wallet fa-fw"></i> Simpanan</a></li>
                    <li class="{{ request()->routeIs('admin.pinjaman.*') ? 'active' : '' }}"><a href="{{ route('admin.pinjaman.index') }}"><i class="fa-solid fa-hand-holding-dollar fa-fw"></i> Pinjaman</a></li>
                    <li class="{{ request()->routeIs('admin.angsuran.*') ? 'active' : '' }}"><a href="{{ route('admin.angsuran.index') }}"><i class="fa-solid fa-file-invoice-dollar fa-fw"></i> Angsuran</a></li>
                    <li class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}"><a href="{{ route('admin.laporan.index') }}"><i class="fa-solid fa-chart-pie fa-fw"></i> Laporan</a></li>
                @else
                    <li class="{{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}"><a href="{{ route('anggota.dashboard') }}"><i class="fa-solid fa-gauge fa-fw"></i> Beranda Saya</a></li>
                    <li class="{{ request()->routeIs('anggota.pinjaman.*') ? 'active' : '' }}"><a href="{{ route('anggota.pinjaman.index') }}"><i class="fa-solid fa-hand-holding-dollar fa-fw"></i> Riwayat Pinjaman</a></li>
                @endif
                
                <li class="px-3 mt-4 mb-2 text-uppercase" style="font-size: 0.75rem; color: #7f8c8d; font-weight: bold; letter-spacing: 1px;">Informasi Koperasi</li>
                <li class="{{ request()->routeIs('informasi.profil') ? 'active' : '' }}"><a href="{{ route('informasi.profil') }}"><i class="fa-solid fa-building fa-fw"></i> Profil Koperasi</a></li>
                <li class="{{ request()->routeIs('informasi.struktur') ? 'active' : '' }}"><a href="{{ route('informasi.struktur') }}"><i class="fa-solid fa-sitemap fa-fw"></i> Struktur Organisasi</a></li>
                <li class="{{ request()->routeIs('informasi.tentang') ? 'active' : '' }}"><a href="{{ route('informasi.tentang') }}"><i class="fa-solid fa-circle-info fa-fw"></i> Tentang Kami</a></li>
                <li class="{{ request()->routeIs('informasi.kontak') ? 'active' : '' }}"><a href="{{ route('informasi.kontak') }}"><i class="fa-solid fa-phone fa-fw"></i> Kontak Kami</a></li>

                <li class="px-3 mt-4 mb-2 text-uppercase" style="font-size: 0.75rem; color: #7f8c8d; font-weight: bold; letter-spacing: 1px;">Pengaturan</li>
                <li class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}"><a href="{{ route('profile.edit') }}"><i class="fa-solid fa-user-gear fa-fw"></i> Profil Akun</a></li>
                
                <li class="mt-2"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger"><i class="fa-solid fa-right-from-bracket fa-fw"></i> Keluar</a></li>
            </ul>
        </nav>
        
        <div id="content">
            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h5>
                
                <div>
                    <a href="#" id="btnProfilAvatar" onclick="toggleMenuManual(event)">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama ?? Auth::user()->name ?? 'User') }}&background=18bc9c&color=fff" class="rounded-circle shadow-sm border" width="45" height="45" alt="Avatar">
                    </a>

                    <div id="kotakMenuProfil" class="custom-dropdown-menu">
                        <div class="px-4 py-3 border-bottom bg-light text-center" style="border-radius: 8px 8px 0 0;">
                            <span class="fw-bold d-block text-dark">{{ Auth::user()->nama ?? Auth::user()->name ?? 'User' }}</span>
                            <small class="text-muted text-uppercase">{{ Auth::user()->role ?? 'Anggota' }}</small>
                        </div>
                        <a href="{{ route('profile.edit') }}">
                            <i class="fa-solid fa-user fa-fw me-2 text-secondary"></i> Profil Akun
                        </a>
                        <div class="border-top my-1"></div>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger fw-bold">
                            <i class="fa-solid fa-right-from-bracket fa-fw me-2"></i> Keluar
                        </a>
                    </div>
                </div>
                </div>
            <div class="main-body">@yield('content')</div>
        </div>
    </div>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        function toggleMenuManual(e) {
            e.preventDefault();
            var menu = document.getElementById("kotakMenuProfil");
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        // Script ini akan menutup menu otomatis jika Anda mengklik tempat lain di layar
        document.addEventListener('click', function(event) {
            var avatarBtn = document.getElementById('btnProfilAvatar');
            var menu = document.getElementById('kotakMenuProfil');
            
            if (!avatarBtn.contains(event.target) && !menu.contains(event.target)) {
                menu.style.display = 'none';
            }
        });

        $(document).ready(function() { 
            $('.datatable').DataTable({ "language": { "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json" } }); 
        });
        @if(session('success')) Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', timer: 3000, showConfirmButton: false }); @endif
        @if(session('error')) Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}' }); @endif
    </script>
</body>
</html>
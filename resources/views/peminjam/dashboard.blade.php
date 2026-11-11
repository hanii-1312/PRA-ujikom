<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjam</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background-color: #1a202c;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            padding-top: 20px;
        }
        .sidebar h4 {
            color: #fff;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            color: #cbd5e1;
            display: block;
            transition: 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #2d3748;
            color: #fff;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        .top-navbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Kiri (Sudah diganti jadi PANEL PEMINJAM) -->
    <div class="sidebar">
        <h4>PANEL PEMINJAM</h4>
        <a href="{{ route('peminjam.dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('peminjam.katalog') }}">Katalog Alat</a>
        <a href="{{ route('peminjam.riwayat') }}">Riwayat Pinjam</a>
        
        <div style="position: absolute; bottom: 20px; width: 100%; padding: 0 20px;">
            <small class="text-muted">Logged in as: <strong>{{ Auth::user()->name ?? 'Peminjam' }}</strong></small>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5 class="m-0">Dashboard Peminjam</h5>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>

        <!-- Kartu Selamat Datang -->
        <div class="alert alert-primary shadow-sm mb-4" role="alert">
            <h4 class="alert-heading">Selamat datang, {{ Auth::user()->name }}!</h4>
            <p class="mb-0">Anda berhasil login sebagai Peminjam. Silakan gunakan menu di bawah atau di sidebar untuk meminjam alat dan mengecek riwayat.</p>
        </div>

        <!-- Menu Cepat (Cards) -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Katalog Alat</h5>
                        <p class="card-text text-muted">Lihat daftar alat yang tersedia dan ajukan peminjaman alat yang Anda butuhkan.</p>
                        <a href="{{ route('peminjam.katalog') }}" class="btn btn-primary btn-sm">Lihat Katalog</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success">Riwayat Peminjaman</h5>
                        <p class="card-text text-muted">Cek status pengajuan alat yang sudah Anda pinjam atau kembalikan.</p>
                        <a href="{{ route('peminjam.riwayat') }}" class="btn btn-success btn-sm">Lihat Riwayat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat - Peminjam</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        /* Sidebar Styling ala Admin */
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
        /* Main Content Styling */
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

    <!-- Sidebar Kiri -->
    <div class="sidebar">
        <h4>PANEL PEMINJAM</h4>
        <a href="{{ route('peminjam.dashboard') }}">Dashboard</a>
        <a href="{{ route('peminjam.katalog') }}" class="active">Katalog Alat</a>
        <a href="{{ route('peminjam.riwayat') }}">Riwayat Pinjam</a>
        
        <div style="position: absolute; bottom: 20px; width: 100%; padding: 0 20px;">
            <small class="text-muted">Logged in as: <strong>{{ Auth::user()->name ?? 'Peminjam' }}</strong></small>
        </div>
    </div>

    <!-- Konten Utama di Kanan -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5 class="m-0">Katalog Alat Tersedia</h5>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Form & Tabel Katalog -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('peminjam.peminjaman.ajukan') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4 col-md-4">
                        <label for="tgl_kembali_plan" class="form-label fw-bold">Rencana Tanggal Kembali</label>
                        <input type="date" name="tgl_kembali_plan" class="form-control" required value="{{ old('tgl_kembali_plan') }}">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th width="80">Pilih</th>
                                    <th>Nama Alat</th>
                                    <th>Kategori</th>
                                    <th>Stok Tersedia</th>
                                    <th width="150">Jumlah Pinjam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($alats as $alat)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="alat_id[]" value="{{ $alat->id }}" id="alat_{{ $alat->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <label for="alat_{{ $alat->id }}" style="cursor: pointer;">
                                            {{ $alat->nama_alat }}
                                        </label>
                                    </td>
                                    <td>{{ $alat->kategori->nama_kategori ?? '-' }}</td>
                                    <td><span class="badge bg-secondary">{{ $alat->stok }}</span></td>
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control form-control-sm" value="1" min="1" max="{{ $alat->stok }}">
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada alat yang tersedia untuk dipinjam.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(count($alats) > 0)
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary px-4">Ajukan Peminjaman</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
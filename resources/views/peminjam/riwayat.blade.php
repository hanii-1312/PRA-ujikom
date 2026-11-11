<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - Peminjam</title>
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

    <!-- Sidebar Kiri -->
    <div class="sidebar">
        <h4>PANEL PEMINJAM</h4>
        <a href="{{ route('peminjam.dashboard') }}">Dashboard</a>
        <a href="{{ route('peminjam.katalog') }}">Katalog Alat</a>
        <a href="{{ route('peminjam.riwayat') }}" class="active">Riwayat Pinjam</a>
        
        <div style="position: absolute; bottom: 20px; width: 100%; padding: 0 20px;">
            <small class="text-muted">Logged in as: <strong>{{ Auth::user()->name ?? 'Peminjam' }}</strong></small>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5 class="m-0">Riwayat Peminjaman Alat</h5>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>

        <!-- Tabel Riwayat -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pinjam</th>
                                <th>Rencana Tanggal Kembali</th>
                                <th>Daftar Alat & Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamans as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->tgl_pinjam }}</td>
                                <td>{{ $item->tgl_kembali_plan }}</td>
                                <td>
                                    <ul class="mb-0 ps-3">
                                        @foreach($item->detailPinjams as $detail)
                                            <li>{{ $detail->alat->nama_alat ?? 'Alat tidak ditemukan' }} (<strong>{{ $detail->jumlah }} unit</strong>)</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if($item->status == 'diajukan')
                                        <span class="badge bg-warning text-dark">Diajukan</span>
                                    @elseif($item->status == 'dipinjam')
                                        <span class="badge bg-primary">Dipinjam</span>
                                    @elseif($item->status == 'dikembalikan')
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat peminjaman alat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
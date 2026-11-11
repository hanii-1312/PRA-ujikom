<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Menampilkan halaman utama / katalog alat untuk peminjam
    public function index()
    {
        $alats = Alat::all();
        
        // Menampilkan riwayat peminjaman milik user yang sedang login saja
        $riwayatPinjam = Peminjaman::with('alat')
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->get();

        return view('peminjam.dashboard', compact('alats', 'riwayatPinjam'));
    }

    // Proses siswa/peminjam mengajukan pinjaman alat
    public function ajukan(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah > $alat->stok) {
            return back()->with('error', 'Jumlah pinjaman melebihi stok alat yang tersedia!');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'diajukan', // Status awal saat diajukan peminjam
        ]);

        return redirect()->route('peminjam.dashboard')->with('success', 'Berhasil mengajukan peminjaman alat. Menunggu konfirmasi admin!');
    }
}
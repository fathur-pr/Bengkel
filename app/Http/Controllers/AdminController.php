<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;    // <-- Panggil Model User (untuk hitung member)
use App\Models\Booking; // <-- Panggil Model Booking (untuk lihat pesanan)

class AdminController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Member (yang bukan admin)
        $totalMember = User::where('role', 'member')->count();

        // 2. Hitung Booking yang statusnya masih 'pending'
        $pendingBooking = Booking::where('status', 'pending')->count();

        // 3. Hitung Total Semua Servis (contoh: yang sudah selesai)
        $totalServis = Booking::where('status', 'selesai')->count();

        // 4. Ambil 5 Booking Terbaru (untuk ditampilkan di tabel dashboard)
        // Kita pakai 'with' supaya bisa ambil nama user pemesan
        $recentBookings = Booking::with('user')->latest()->take(5)->get();

        // Kirim semua data ke tampilan (View)
        return view('admin.dashboard', compact(
            'totalMember', 
            'pendingBooking', 
            'totalServis', 
            'recentBookings'
        ));
    }
    
    // Function update status nanti kita isi belakangan
    // Function untuk mengubah status booking
    public function updateBookingStatus(Request $request, $id)
    {
        // Cari booking berdasarkan ID
        $booking = Booking::findOrFail($id);
        
        // Ubah status sesuai tombol yang diklik (dikirim dari form)
        $booking->status = $request->status;
        $booking->save();

        // Kembali ke halaman dashboard dengan pesan sukses
        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
    public function cetakLaporan()
    {
        // Ambil data yang statusnya 'selesai' saja
        $laporan = Booking::with('user')->where('status', 'selesai')->get();

        return view('admin.cetak', compact('laporan'));
    }

    // 1. Halaman Data Pelanggan
    public function dataPelanggan()
    {
        // Ambil user yang role-nya 'member' saja
        $pelanggan = User::where('role', 'member')->get();
        return view('admin.pelanggan', compact('pelanggan'));
    }

    // 2. Halaman Semua Pesanan
    // --- 1. GANTI FUNCTION INI (Supaya bisa Search) ---
    public function pesananMasuk(Request $request)
    {
        $query = Booking::with('user')->latest();

        // Logika Pencarian
        if ($request->has('search')) {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('nama_mobil', 'like', "%{$keyword}%")
                  ->orWhere('jenis_servis', 'like', "%{$keyword}%")
                  ->orWhereHas('user', function($userQuery) use ($keyword) {
                      $userQuery->where('name', 'like', "%{$keyword}%");
                  });
            });
        }

        $semuaPesanan = $query->get();
        return view('admin.pesanan', compact('semuaPesanan'));
    }

    // --- 2. TAMBAHAN FUNCTION BARU (Taruh di paling bawah) ---

    // Menampilkan Form Edit
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.edit_pesanan', compact('booking'));
    }

    // Menyimpan Perubahan Data
    public function updateData(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $booking->update([
            'nama_mobil'      => $request->nama_mobil,
            'jenis_servis'    => $request->jenis_servis,
            'tanggal_booking' => $request->tanggal_booking,
            'catatan'         => $request->catatan,
            // Status tidak diupdate disini, tapi lewat tombol aksi di tabel utama
        ]);

        return redirect('/admin/pesanan')->with('success', 'Data pesanan berhasil diubah!');
    }

    // Menghapus Data
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return back()->with('success', 'Data pesanan berhasil dihapus!');
    }

    
}
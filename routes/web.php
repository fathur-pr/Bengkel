<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// --- DAFTAR 'USE' WAJIB DI SINI (PALING ATAS) ---
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Models\Booking; 
// ------------------------------------------------

/*
|--------------------------------------------------------------------------
| Web Routes (Jalur Aplikasi)
|--------------------------------------------------------------------------
*/

// 1. Halaman Depan (Home)
Route::get('/', function () {
    return view('welcome');
});

// 2. Registrasi
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

// 3. Login & Logout
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 4. Group Khusus User Login
Route::middleware(['auth'])->group(function () {

    // --- ADMIN DASHBOARD ---
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
    Route::post('/admin/booking/{id}/update', [AdminController::class, 'updateBookingStatus']);

    // ... route admin lainnya ...
    
    // Update baris ini (tambahkan ->name('admin.pesanan'))
    Route::get('/admin/pesanan', [AdminController::class, 'pesananMasuk'])->name('admin.pesanan');
    
    // 1. Route Hapus Data
    Route::delete('/admin/booking/{id}/hapus', [AdminController::class, 'destroy'])->name('booking.destroy');

    // 2. Route Tampilkan Form Edit
    Route::get('/admin/booking/{id}/edit', [AdminController::class, 'edit'])->name('booking.edit');

    // 3. Route Simpan Perubahan Edit
    Route::put('/admin/booking/{id}/update-data', [AdminController::class, 'updateData'])->name('booking.updateData');

    // Menu Sidebar Baru
    Route::get('/admin/pelanggan', [AdminController::class, 'dataPelanggan']);
    Route::get('/admin/pesanan', [AdminController::class, 'pesananMasuk']);

    // Route Cetak Laporan
    Route::get('/admin/laporan', [AdminController::class, 'cetakLaporan']);

    // --- BOOKING (MEMBER) ---
    Route::get('/booking/buat', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/simpan', [BookingController::class, 'store'])->name('booking.store');

    // --- DASHBOARD MEMBER (MEMBER) ---
    Route::get('/dashboard', function () {
        $bookings = Booking::where('user_id', Auth::id())
                            ->latest()
                            ->get();
        
        return view('dashboard', compact('bookings'));
    });

});
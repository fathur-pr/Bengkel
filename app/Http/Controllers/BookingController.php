<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // <-- Panggil Model Booking
use Illuminate\Support\Facades\Auth; // <-- Untuk tahu siapa yang login

class BookingController extends Controller
{
    // 1. Tampilkan Formulir
    public function create()
    {
        return view('booking.create');
    }

    // 2. Simpan Data ke Database
    public function store(Request $request)
    {
        // Validasi input dulu biar aman
        $request->validate([
            'nama_mobil' => 'required',
            'jenis_servis' => 'required',
            'tanggal_booking' => 'required|date',
            'catatan' => 'nullable',
        ]);

        // Simpan ke database
        Booking::create([
            'user_id' => Auth::id(), // Ambil ID user yang sedang login
            'nama_mobil' => $request->nama_mobil,
            'jenis_servis' => $request->jenis_servis,
            'tanggal_booking' => $request->tanggal_booking,
            'catatan' => $request->catatan,
            'status' => 'pending', // Default status
        ]);

        // Kembalikan ke dashboard dengan pesan sukses
        return redirect('/dashboard')->with('success', 'Booking berhasil! Tunggu konfirmasi admin ya.');
    }
}
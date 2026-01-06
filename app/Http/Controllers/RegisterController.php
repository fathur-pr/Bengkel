<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- Panggil Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- Untuk enkripsi password
use Illuminate\Support\Facades\Auth; // <-- Untuk auto-login setelah daftar

class RegisterController extends Controller
{
    // 1. Tampilkan Form Daftar
    public function index()
    {
        return view('register'); // Kita akan buat file view ini nanti
    }

    // 2. Proses Simpan Data User
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // ❌ HAPUS atau KOMENTARI baris ini (agar tidak auto-login)
        // Auth::login($user); 

        // ✅ GANTI redirect ke '/login' dengan membawa pesan 'success'
        return redirect('/login')->with('success', 'Registrasi Berhasil! Silakan Login.');
    }
}
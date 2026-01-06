<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function index()
    {
        return view('login');
    }

    // 2. Proses Login (FINAL CLEAN VERSION)
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Update waktu login terakhir
            $user->last_login_at = now();
            $user->save();

            // Pengecekan Admin (Sudah terbukti berhasil!)
            // Kita pakai strtolower & trim untuk jaga-jaga kalau ada typo di masa depan
            if (strtolower(trim($user->role)) === 'admin') {
                return redirect('/admin/dashboard');
            }

            // Kalau member biasa, ke dashboard member
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // 3. Logout
    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Kamu berhasil logout.');
    }
}
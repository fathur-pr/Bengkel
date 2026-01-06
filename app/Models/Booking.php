<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // --- BAGIAN INI YANG KURANG ---
    // Kita harus mendaftarkan kolom mana saja yang boleh diisi
    protected $fillable = [
        'user_id',
        'nama_mobil',
        'jenis_servis',
        'tanggal_booking',
        'catatan',
        'status',
    ];
    // ------------------------------

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
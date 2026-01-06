<!DOCTYPE html>
<html lang="id">
<head>
    <title>Member Area - BengkelPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; margin: 0; }
        
        /* Navbar */
        .navbar { background: #2c3e50; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .brand { font-size: 20px; font-weight: bold; color: #ff8e53; }
        .user-info { font-size: 14px; }
        
        /* Container */
        .container { max-width: 1000px; margin: 40px auto; padding: 20px; }
        
        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #ff8e53 0%, #ff6b6b 100%);
            border-radius: 15px; padding: 40px; color: white; text-align: center;
            box-shadow: 0 10px 20px rgba(255, 107, 107, 0.3); margin-bottom: 30px;
        }
        .welcome-card h1 { margin: 0 0 10px 0; }
        .btn-booking {
            background: white; color: #ff6b6b; padding: 12px 30px; border-radius: 30px;
            text-decoration: none; font-weight: bold; display: inline-block; margin-top: 20px;
            transition: 0.3s; border: none; cursor: pointer;
        }
        .btn-booking:hover { transform: scale(1.05); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }

        /* Tabel Riwayat */
        .history-section { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; padding: 15px; background: #f8f9fa; color: #7f8c8d; }
        td { padding: 15px; border-bottom: 1px solid #eee; }
        
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; }
        .bg-pending { background: #fff3cd; color: #856404; }
        .bg-success { background: #d4edda; color: #155724; }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="brand"><i class="fas fa-wrench"></i> BengkelPro Member</div>
        <div class="user-info">
            Halo, {{ Auth::user()->name }} 
            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left: 10px;">
                @csrf
                <button type="submit" style="background:none; border:none; color:#bdc3c7; cursor:pointer;">(Logout)</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="welcome-card">
            <h1>Mobil Anda Bermasalah?</h1>
            <p>Jangan tunggu sampai mogok. Booking servis sekarang, bebas antri!</p>
            <a href="{{ route('booking.create') }}" class="btn-booking">
                <i class="fas fa-calendar-plus"></i> Booking Servis Baru
            </a>
        </div>

        <div class="history-section">
            <h3><i class="fas fa-history"></i> Riwayat Servis Saya</h3>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Mobil</th>
                        <th>Keluhan/Servis</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y, H:i') }}</td>
                        <td>{{ $booking->nama_mobil }}</td>
                        <td>
                            <strong>{{ $booking->jenis_servis }}</strong>
                            @if($booking->catatan)
                                <br><small style="color:#7f8c8d;">"{{ $booking->catatan }}"</small>
                            @endif
                        </td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-pending">Menunggu</span>
                            @elseif($booking->status == 'proses')
                                <span class="badge" style="background:#cce5ff; color:#004085;">Diproses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color: #aaa; padding: 30px;">
                            Belum ada riwayat booking. Yuk servis sekarang!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
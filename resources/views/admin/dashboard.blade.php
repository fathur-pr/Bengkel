<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Panel - BengkelPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f4f6f9; margin: 0; display: flex; }
        
        /* Sidebar */
        .sidebar {
            width: 260px; background: #2c3e50; min-height: 100vh; color: #fff; padding: 25px;
            position: fixed;
        }
        .sidebar h2 { color: #ff8e53; margin-bottom: 30px; font-size: 24px; }
        .menu-item {
            display: block; padding: 12px 15px; color: #ecf0f1; text-decoration: none;
            margin-bottom: 10px; border-radius: 8px; transition: 0.3s;
        }
        .menu-item:hover, .menu-item.active { background: #34495e; color: #ff8e53; }
        .menu-item i { margin-right: 10px; width: 20px; text-align: center; }

        /* Content */
        .content { margin-left: 260px; padding: 30px; width: 100%; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        
        /* Kartu Statistik */
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;
        }
        .card {
            background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            display: flex; justify-content: space-between; align-items: center;
        }
        .card h3 { font-size: 32px; margin: 5px 0 0 0; color: #2c3e50; }
        .card p { color: #7f8c8d; margin: 0; font-size: 14px; }
        .card-icon { 
            width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; 
        }

        /* Tabel */
        .table-container { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { text-align: left; padding: 15px; background: #f8f9fa; color: #7f8c8d; font-size: 13px; font-weight: 600; }
        td { padding: 15px; border-bottom: 1px solid #eee; font-size: 14px; color: #2c3e50; }
        
        /* Badge Status */
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .bg-pending { background: #fff3cd; color: #856404; }
        .bg-success { background: #d4edda; color: #155724; }
        
        /* Tombol Logout */
        .btn-logout {
            background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 6px; cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2><i class="fas fa-wrench"></i> Alpino Jakarta</h2>
        
        <a href="/admin/dashboard" class="menu-item active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="/admin/pelanggan" class="menu-item"><i class="fas fa-users"></i> Data Pelanggan</a>
        <a href="/admin/pesanan" class="menu-item"><i class="fas fa-clipboard-list"></i> Pesanan Masuk</a>
        
        
        <div style="margin-top: 50px;">
            <p style="font-size: 12px; color: #bdc3c7; margin-bottom: 10px;">Login sebagai: {{ Auth::user()->name }}</p>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn-logout" style="width: 100%;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <a href="/admin/laporan" target="_blank" style="background: #3498db; color: white; text-decoration: none; padding: 10px 20px; border-radius: 8px; display: inline-block;">
                <i class="fas fa-print"></i> Cetak Laporan
            </a>
        </div>

        <div class="stats-grid">
            
            <div class="card">
                <div>
                    <p>Total Member</p>
                    <h3>{{ $totalMember }}</h3>
                </div>
                <div class="card-icon" style="background: #e1f5fe; color: #03a9f4;">
                    <i class="fas fa-users"></i>
                </div>
            </div>

            <div class="card">
                <div>
                    <p>Booking Pending</p>
                    <h3>{{ $pendingBooking }}</h3>
                </div>
                <div class="card-icon" style="background: #fff3e0; color: #ff9800;">
                    <i class="fas fa-clock"></i>
                </div>
            </div>

            <div class="card">
                <div>
                    <p>Servis Selesai</p>
                    <h3>{{ $totalServis }}</h3>
                </div>
                <div class="card-icon" style="background: #e8f5e9; color: #4caf50;">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>

        </div>

        <div class="table-container">
            <div style="display:flex; justify-content:space-between; align-items:center;">
                <h3>Pesanan Masuk Terbaru</h3>
                <a href="#" style="text-decoration:none; color:#3498db; font-size:14px;">Lihat Semua</a>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Mobil & Servis</th>
                        <th>Jadwal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentBookings as $booking)
                    <tr>
                        <td>
                            <strong>{{ $booking->user->name }}</strong><br>
                            <small style="color:#bdc3c7;">{{ $booking->user->email }}</small>
                        </td>
                        <td>
                            {{ $booking->nama_mobil }}<br>
                            <span style="font-size:12px; color:#e67e22;">{{ $booking->jenis_servis }}</span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M, H:i') }}
                        </td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-pending">Menunggu</span>
                            @elseif($booking->status == 'proses')
                                <span class="badge" style="background:#cce5ff; color:#004085;">Proses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                       <td>
    <div style="display: flex; gap: 5px;">
        @if($booking->status == 'pending')
            <form action="/admin/booking/{{ $booking->id }}/update" method="POST">
                @csrf
                <input type="hidden" name="status" value="proses">
                <button type="submit" style="background:#3498db; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer; font-size:12px;" title="Proses Pesanan">
                    <i class="fas fa-tools"></i> Proses
                </button>
            </form>
        @endif

        @if($booking->status == 'proses')
            <form action="/admin/booking/{{ $booking->id }}/update" method="POST">
                @csrf
                <input type="hidden" name="status" value="selesai">
                <button type="submit" style="background:#27ae60; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer; font-size:12px;" title="Selesaikan">
                    <i class="fas fa-check"></i> Selesai
                </button>
            </form>
        @endif
        
        @if($booking->status == 'selesai')
            <span style="color:#27ae60; font-size:18px;"><i class="fas fa-check-circle"></i></span>
        @endif
    </div>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 20px;">Belum ada pesanan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

</body>
</html>
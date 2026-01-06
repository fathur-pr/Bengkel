<!DOCTYPE html>
<html lang="id">
<head>
    <title>Semua Pesanan - BengkelPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f4f6f9; margin: 0; display: flex; }
        .sidebar { width: 260px; background: #2c3e50; min-height: 100vh; color: #fff; padding: 25px; position: fixed; }
        .sidebar h2 { color: #ff8e53; margin-bottom: 30px; }
        .menu-item { display: block; padding: 12px 15px; color: #ecf0f1; text-decoration: none; margin-bottom: 10px; border-radius: 8px; transition: 0.3s; }
        .menu-item:hover, .menu-item.active { background: #34495e; color: #ff8e53; }
        .content { margin-left: 260px; padding: 30px; width: 100%; }
        
        /* Style Search Bar */
        .header-tools { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .search-box { display: flex; gap: 10px; }
        .search-box input { padding: 10px; border: 1px solid #ddd; border-radius: 5px; width: 250px; }
        .search-box button { padding: 10px 15px; background: #2c3e50; color: white; border: none; border-radius: 5px; cursor: pointer; }

        table { width: 100%; background: white; border-radius: 10px; border-collapse: collapse; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        th { background: #2c3e50; color: white; padding: 15px; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #eee; }
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .bg-pending { background: #fff3cd; color: #856404; }
        .bg-success { background: #d4edda; color: #155724; }

        /* Style Tombol Aksi */
        .btn-action { padding: 5px 10px; border-radius: 4px; border: none; cursor: pointer; color: white; font-size: 12px; text-decoration: none; display: inline-block; }
        .btn-edit { background: #f39c12; }
        .btn-delete { background: #e74c3c; }
        .btn-process { background: #3498db; }
        .btn-done { background: #27ae60; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2><i class="fas fa-wrench"></i> BengkelPro</h2>
        <a href="/admin/dashboard" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="/admin/pelanggan" class="menu-item"><i class="fas fa-users"></i> Data Pelanggan</a>
        <a href="/admin/pesanan" class="menu-item active"><i class="fas fa-clipboard-list"></i> Pesanan Masuk</a>
    </div>

    <div class="content">
        
        <div class="header-tools">
            <h1>Semua Pesanan Masuk</h1>
            <form action="/admin/pesanan" method="GET" class="search-box">
                <input type="text" name="search" placeholder="Cari nama, mobil, atau servis..." value="{{ request('search') }}">
                <button type="submit"><i class="fas fa-search"></i> Cari</button>
            </form>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Mobil & Servis</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th style="width: 250px;">Aksi</th> </tr>
            </thead>
            <tbody>
                @foreach($semuaPesanan as $booking)
                <tr>
                    <td>
                        <strong>{{ $booking->user->name }}</strong><br>
                        <small style="color:#777;">{{ $booking->user->email }}</small>
                    </td>
                    <td>
                        {{ $booking->nama_mobil }}<br>
                        <span style="color:orange; font-size:12px;">{{ $booking->jenis_servis }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M, H:i') }}</td>
                    <td>
                        @if($booking->status == 'pending') <span class="badge bg-pending">Menunggu</span>
                        @elseif($booking->status == 'proses') <span class="badge" style="background:#cce5ff; color:#004085;">Proses</span>
                        @else <span class="badge bg-success">Selesai</span> @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px; align-items: center;">
                            
                            @if($booking->status == 'pending')
                                <form action="/admin/booking/{{ $booking->id }}/update" method="POST">
                                    @csrf <input type="hidden" name="status" value="proses">
                                    <button type="submit" class="btn-action btn-process" title="Proses"><i class="fas fa-tools"></i></button>
                                </form>
                            @endif
                            @if($booking->status == 'proses')
                                <form action="/admin/booking/{{ $booking->id }}/update" method="POST">
                                    @csrf <input type="hidden" name="status" value="selesai">
                                    <button type="submit" class="btn-action btn-done" title="Selesai"><i class="fas fa-check"></i></button>
                                </form>
                            @endif

                            <a href="{{ route('booking.edit', $booking->id) }}" class="btn-action btn-edit" title="Edit Data">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                            
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
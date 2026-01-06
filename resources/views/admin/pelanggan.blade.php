<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Pelanggan - BengkelPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Gaya dasar sama seperti Dashboard */
        * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: #f4f6f9; margin: 0; display: flex; }
        .sidebar { width: 260px; background: #2c3e50; min-height: 100vh; color: #fff; padding: 25px; position: fixed; }
        .sidebar h2 { color: #ff8e53; margin-bottom: 30px; }
        .menu-item { display: block; padding: 12px 15px; color: #ecf0f1; text-decoration: none; margin-bottom: 10px; border-radius: 8px; transition: 0.3s; }
        .menu-item:hover, .menu-item.active { background: #34495e; color: #ff8e53; }
        .content { margin-left: 260px; padding: 30px; width: 100%; }
        
        /* Tabel Spesifik */
        table { width: 100%; background: white; border-radius: 10px; border-collapse: collapse; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        th { background: #2c3e50; color: white; padding: 15px; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f1f1f1; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2><i class="fas fa-wrench"></i> BengkelPro</h2>
        <a href="/admin/dashboard" class="menu-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="/admin/pelanggan" class="menu-item active"><i class="fas fa-users"></i> Data Pelanggan</a>
        <a href="/admin/pesanan" class="menu-item"><i class="fas fa-clipboard-list"></i> Pesanan Masuk</a>
    </div>

    <div class="content">
        <h1>Data Pelanggan (Member)</h1>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Bergabung Sejak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggan as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $user->name }}</strong>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
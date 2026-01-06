<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Servis - BengkelPro</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        h1 { margin: 0; color: #2c3e50; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; font-size: 14px; }
        th { background-color: #eee; }
        
        .footer { margin-top: 40px; text-align: right; font-size: 12px; }
        
        /* Saat dicetak, hilangkan tombol kembali */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <button class="no-print" onclick="window.history.back()" style="margin-bottom: 20px; padding: 10px; cursor: pointer;">
        &larr; Kembali ke Dashboard
    </button>

    <div class="header">
        <h1>ALPINO JAKARTA</h1>
        <p>Jalan Raya Lenteng Agung Timur Rt 009 Rw 02 </p>
        <h3>LAPORAN SERVIS SELESAI</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pelanggan</th>
                <th>Mobil</th>
                <th>Jenis Servis</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d/m/Y') }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->nama_mobil }}</td>
                <td>{{ $item->jenis_servis }}</td>
                <td>{{ $item->catatan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data servis selesai.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p> {{ date('d F Y') }}</p>
        <br><br>
        <p>( Alpino Jakarta )</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>
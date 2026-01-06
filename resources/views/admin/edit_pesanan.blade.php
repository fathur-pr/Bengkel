<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Pesanan - BengkelPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; padding: 40px; }
        .card { background: white; max-width: 600px; margin: 0 auto; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #555; }
        input, select, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .btn-save { background: #3498db; color: white; border: none; padding: 12px; width: 100%; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-save:hover { background: #2980b9; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #777; text-decoration: none; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Edit Data Pesanan</h2>
        
        <form action="{{ route('booking.updateData', $booking->id) }}" method="POST">
            @csrf
            @method('PUT') <label>Nama Mobil</label>
            <input type="text" name="nama_mobil" value="{{ $booking->nama_mobil }}" required>

            <label>Jenis Servis</label>
            <select name="jenis_servis" required>
                <option value="{{ $booking->jenis_servis }}">{{ $booking->jenis_servis }} (Saat Ini)</option>
                <option value="Ganti Oli">Ganti Oli</option>
                <option value="Tune Up">Tune Up</option>
                <option value="Servis Rem">Servis Rem</option>
                <option value="General Checkup">General Checkup</option>
            </select>

            <label>Tanggal Booking</label>
            <input type="datetime-local" name="tanggal_booking" value="{{ $booking->tanggal_booking }}" required>

            <label>Catatan</label>
            <textarea name="catatan" rows="3">{{ $booking->catatan }}</textarea>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
            <a href="/admin/pesanan" class="btn-back">Batal & Kembali</a>
        </form>
    </div>

</body>
</html>
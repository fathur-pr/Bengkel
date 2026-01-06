<!DOCTYPE html>
<html lang="id">
<head>
    <title>Booking Servis Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h2 { text-align: center; color: #2c3e50; margin-bottom: 30px; }
        
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; color: #7f8c8d; font-weight: 600; }
        input, select, textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-family: inherit; }
        input:focus, select:focus, textarea:focus { border-color: #3498db; outline: none; }
        
        .btn-submit { background: #3498db; color: white; width: 100%; padding: 15px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; font-size: 16px; }
        .btn-submit:hover { background: #2980b9; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #95a5a6; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>

    <div class="card">
        <h2>🔧 Form Booking Servis</h2>
        
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf <div class="form-group">
                <label>Nama/Tipe Mobil</label>
                <input type="text" name="nama_mobil" placeholder="Contoh: Honda Jazz 2018" required>
            </div>

            <div class="form-group">
                <label>Jenis Servis</label>
                <select name="jenis_servis" required>
                    <option value="">-- Pilih Servis --</option>
                    <option value="Ganti Oli">Ganti Oli</option>
                    <option value="Tune Up">Tune Up Mesin</option>
                    <option value="Servis Rem">Servis Rem</option>
                    <option value="General Checkup">Cek Keseluruhan</option>
                    <option value="Lainnya">Lainnya (Tulis di catatan)</option>
                </select>
            </div>

            <div class="form-group">
                <label>Rencana Tanggal Datang</label>
                <input type="datetime-local" name="tanggal_booking" required>
            </div>

            <div class="form-group">
                <label>Catatan Tambahan (Opsional)</label>
                <textarea name="catatan" rows="3" placeholder="Contoh: Ada bunyi cit-cit di ban depan..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Kirim Booking</button>
            <a href="/dashboard" class="btn-back">Batal & Kembali</a>
        </form>
    </div>

</body>
</html>
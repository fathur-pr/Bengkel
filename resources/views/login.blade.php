<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Member - Alpino Jakarta</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: radial-gradient(circle at top right, #2c3e50, #000000);
            overflow: hidden;
        }

        /* Background Animasi */
        .background-shape {
            position: absolute;
            width: 400px;
            height: 400px;
            background: linear-gradient(#ff6b6b, #ff8e53);
            border-radius: 50%;
            top: -100px;
            right: -100px;
            z-index: -1;
            filter: blur(80px);
            opacity: 0.6;
            animation: float 6s ease-in-out infinite;
        }
        
        .background-shape-2 {
            position: absolute;
            width: 300px;
            height: 300px;
            background: linear-gradient(#4facfe, #00f2fe);
            border-radius: 50%;
            bottom: -50px;
            left: -50px;
            z-index: -1;
            filter: blur(80px);
            opacity: 0.5;
            animation: float 8s ease-in-out infinite reverse;
        }

        /* Container Login */
        .login-container {
            position: relative;
            width: 400px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: #fff;
        }

        .login-header h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .login-header p {
            font-size: 14px;
            color: #ccc;
            margin-bottom: 20px;
        }

        /* Input Group Style */
        .input-group {
            position: relative;
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            font-size: 13px;
            color: #eee;
            margin-bottom: 5px;
            display: block;
            margin-left: 5px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 18px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: 0.3s;
        }

        .input-wrapper input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .input-wrapper input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ff8e53;
            box-shadow: 0 0 10px rgba(255, 142, 83, 0.5);
        }

        /* Tombol Login */
        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #ff6b6b, #ff8e53);
            border: none;
            border-radius: 30px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.6);
            background: linear-gradient(45deg, #ff8e53, #ff6b6b);
        }

        .footer-link {
            margin-top: 20px;
            font-size: 14px;
            color: #ccc;
        }

        .footer-link a {
            color: #ff8e53;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .footer-link a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .back-home {
            display: block;
            margin-top: 15px;
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            text-decoration: none;
        }
        
        .back-home:hover {
            color: #fff;
        }

        /* Styles Alert (Error & Success) */
        .alert-error {
            background: rgba(255, 0, 0, 0.2);
            border: 1px solid red;
            color: #ffcccc;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* INI CSS BARU UNTUK SUKSES */
        .alert-success {
            background: rgba(40, 167, 69, 0.2); /* Hijau Transparan */
            border: 1px solid #28a745;
            color: #d4edda;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="background-shape"></div>
    <div class="background-shape-2"></div>

    <div class="login-container">
        <div class="login-header">
            <div style="font-size: 40px; color: #ff8e53; margin-bottom: 10px;">
                <i class="fas fa-tools"></i>
            </div>
            <h2>Alpino Jakarta</h2>
            <p>Silakan login untuk booking service</p>
        </div>

        @if (session('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i> 
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i> 
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <div class="input-group">
                <label>Email Address</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Contoh: user@email.com" value="{{ old('email') }}" required autofocus>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                MASUK SEKARANG <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
            </button>
        </form>

        <div class="footer-link">
            Belum punya akun? <a href="/register">Daftar Member Baru</a>
        </div>
        
        <a href="/" class="back-home"><i class="fas fa-home"></i> Kembali ke Halaman Utama</a>
    </div>

</body>
</html>

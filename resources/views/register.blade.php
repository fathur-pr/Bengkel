<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member - BengkelPro</title>
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
            overflow-x: hidden; /* Mencegah scroll horizontal */
        }

        /* Background Animasi (Sama dengan Login) */
        .background-shape {
            position: absolute;
            width: 450px;
            height: 450px;
            background: linear-gradient(#ff6b6b, #ff8e53);
            border-radius: 50%;
            top: -120px;
            left: -100px; /* Posisi beda dikit biar variatif */
            z-index: -1;
            filter: blur(90px);
            opacity: 0.6;
            animation: float 7s ease-in-out infinite;
        }
        
        .background-shape-2 {
            position: absolute;
            width: 350px;
            height: 350px;
            background: linear-gradient(#4facfe, #00f2fe);
            border-radius: 50%;
            bottom: -80px;
            right: -80px;
            z-index: -1;
            filter: blur(90px);
            opacity: 0.5;
            animation: float 9s ease-in-out infinite reverse;
        }

        /* Container Register */
        .register-container {
            position: relative;
            width: 450px; /* Lebih lebar sedikit dari login */
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            text-align: center;
            color: #fff;
        }

        .register-header h2 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .register-header p {
            font-size: 13px;
            color: #ccc;
            margin-bottom: 25px;
        }

        /* Input Styles */
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            font-size: 13px;
            color: #eee;
            margin-left: 10px;
            margin-bottom: 5px;
            display: block;
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
            font-size: 16px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            color: #fff;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        .input-wrapper input:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #ff8e53;
            box-shadow: 0 0 10px rgba(255, 142, 83, 0.5);
        }

        /* Tombol Daftar */
        .btn-register {
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
            margin-top: 15px;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }

        .btn-register:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.6);
        }

        /* Footer Link */
        .footer-link {
            margin-top: 20px;
            font-size: 13px;
            color: #ccc;
        }

        .footer-link a {
            color: #ff8e53;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-link a:hover {
            text-decoration: underline;
            color: #fff;
        }

        /* Error Message */
        .error-message {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid #dc3545;
            color: #ffcccc;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 12px;
            text-align: left;
        }
        
        .error-message ul {
            padding-left: 20px;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Responsif HP */
        @media (max-width: 480px) {
            .register-container {
                width: 90%;
                padding: 30px;
                margin-top: 20px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

    <div class="background-shape"></div>
    <div class="background-shape-2"></div>

    <div class="register-container">
        <div class="register-header">
            <div style="font-size: 35px; color: #ff8e53; margin-bottom: 10px;">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2>Gabung Sekarang</h2>
            <p>Isi data diri untuk menjadi member BengkelPro</p>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            
            <div class="input-group">
                <label>Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Nama Anda" value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="input-group">
                <label>Email Address</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Buat password aman" required>
                </div>
            </div>

            <button type="submit" class="btn-register">
                DAFTAR SEKARANG
            </button>
        </form>

        <div class="footer-link">
            Sudah punya akun? <a href="/login">Login disini</a>
        </div>
    </div>

</body>
</html>
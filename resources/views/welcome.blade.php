<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alpino Jakarta - Solusi Mobil Anda</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* --- RESET & BASIC --- */
        body { margin: 0; font-family: 'Poppins', sans-serif; overflow-x: hidden; background: #fff; }
        
        /* --- WARNA TEMA --- */
        :root {
            --primary: #ff8e53;   /* Oranye BengkelPro */
            --secondary: #2c3e50; /* Biru Gelap */
            --dark: #222;
        }

        /* --- NAVBAR --- */
        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 50px; background: var(--secondary); color: white;
            position: fixed; width: 100%; top: 0; z-index: 1000; box-sizing: border-box;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .brand { font-size: 24px; font-weight: bold; color: var(--primary); display: flex; align-items: center; gap: 10px; }
        .nav-links a {
            color: white; text-decoration: none; margin-left: 20px; font-weight: 500; font-size: 14px; transition: 0.3s;
        }
        .nav-links a:hover { color: var(--primary); }
        .btn-nav {
            border: 2px solid var(--primary); padding: 8px 20px; border-radius: 20px; 
            color: var(--primary) !important;
        }
        .btn-nav:hover { background: var(--primary); color: white !important; }

        /* --- HERO SLIDER (GAMBAR BERGERAK) --- */
        .swiper {
            width: 100%;
            height: 100vh; /* Full Layar */
            margin-top: 0;
        }
        .swiper-slide {
            background-size: cover; background-position: center;
            position: relative;
        }
        /* Overlay Gelap supaya tulisan terbaca */
        .overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6); /* Gelap transparan */
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            text-align: center; color: white; padding: 20px;
        }
        .hero-title { font-size: 48px; font-weight: 700; margin-bottom: 10px; text-shadow: 2px 2px 5px rgba(0,0,0,0.5); }
        .hero-desc { font-size: 18px; max-width: 700px; margin-bottom: 30px; line-height: 1.6; }
        
        .btn-cta {
            background: var(--primary); color: white; padding: 15px 40px; text-decoration: none;
            font-size: 18px; font-weight: bold; border-radius: 50px; transition: 0.3s;
            box-shadow: 0 5px 15px rgba(255, 142, 83, 0.5); border: none; cursor: pointer;
        }
        .btn-cta:hover { transform: scale(1.1); background: #ff7b36; }

        /* --- FEATURES SECTION --- */
        .section { padding: 80px 20px; text-align: center; }
        .section-title { font-size: 32px; color: var(--secondary); margin-bottom: 10px; font-weight: 700; }
        .section-subtitle { color: #777; margin-bottom: 50px; }

        .features-grid {
            display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;
        }
        .feature-card {
            background: white; padding: 40px 30px; border-radius: 15px; width: 280px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: 0.3s; border-bottom: 5px solid transparent;
        }
        .feature-card:hover { transform: translateY(-10px); border-bottom: 5px solid var(--primary); }
        .icon-box {
            font-size: 50px; color: var(--primary); margin-bottom: 20px;
        }

        /* --- INFO / ABOUT SECTION --- */
        .about-container {
            display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 50px;
            max-width: 1100px; margin: 0 auto; text-align: left;
        }
        .about-img {
            flex: 1; min-width: 300px;
        }
        .about-img img { width: 100%; border-radius: 20px; box-shadow: 20px 20px 0px var(--secondary); }
        .about-text { flex: 1; min-width: 300px; }

        /* --- FOOTER --- */
        footer { background: var(--secondary); color: #bdc3c7; padding: 50px 20px; font-size: 14px; }
        .footer-content { display: flex; justify-content: space-between; max-width: 1000px; margin: 0 auto; flex-wrap: wrap; gap: 20px; }
        .footer-col h3 { color: white; margin-bottom: 20px; }
        .social-icons i { font-size: 20px; margin-right: 15px; cursor: pointer; transition: 0.3s; }
        .social-icons i:hover { color: var(--primary); }

        /* Responsif HP */
        @media (max-width: 768px) {
            .hero-title { font-size: 32px; }
            .nav-links { display: none; } /* Simpel dulu buat HP */
            .brand { font-size: 20px; }
            .about-container { text-align: center; }
            .about-img img { box-shadow: none; margin-bottom: 20px; }
        }
    </style>
</head>
<body>

    <nav>
        <div class="brand">
            <i class="fas fa-wrench"></i> Alpino Jakarta
        </div>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="#layanan">Layanan</a>
            <a href="#tentang">Tentang</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-nav">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Masuk</a>
                    <a href="{{ url('/register') }}" class="btn-nav">Daftar</a>
                @endauth
            @endif
        </div>
    </nav>

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            
            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1487754180451-c456f719a1fc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                <div class="overlay">
                    <h1 class="hero-title" data-aos="fade-up">Pasang Muffler Di Alpino</h1>
                    <p class="hero-desc" data-aos="fade-up" data-aos-delay="200">Booking jadwal Anda sekarang. Teknisi profesional kami siap membuat suara mobil Anda lebih bergairah.</p>
                    <a href="{{ url('/booking/buat') }}" class="btn-cta" data-aos="zoom-in" data-aos-delay="400">Booking Sekarang</a>
                </div>
            </div>

            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                <div class="overlay">
                    <h1 class="hero-title">Perawatan Mesin Terbaik</h1>
                    <p class="hero-desc">Memastikan mesin Anda bekerja optimal.</p>
                    <a href="{{ url('/booking/buat') }}" class="btn-cta">Cek Jadwal</a>
                </div>
            </div>

            <div class="swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                <div class="overlay">
                    <h1 class="hero-title">Harga Jujur & Transparan</h1>
                    <p class="hero-desc">Tidak ada biaya tersembunyi. Semua estimasi biaya disepakati di awal.</p>
                    <a href="{{ url('/register') }}" class="btn-cta">Daftar Member</a>
                </div>
            </div>

        </div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="section" id="layanan">
        <h2 class="section-title" data-aos="fade-down">Kenapa Memilih Kami?</h2>
        <p class="section-subtitle" data-aos="fade-down" data-aos-delay="100">Solusi terbaik untuk kendaraan kesayangan Anda</p>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="icon-box"><i class="fas fa-calendar-check"></i></div>
                <h3>Booking Online</h3>
                <p>Tidak perlu antri di bengkel berjam-jam. Pesan slot waktu dari rumah.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box"><i class="fas fa-user-cog"></i></div>
                <h3>Mekanik Pro</h3>
                <p>Tim kami berpengalaman menangani berbagai jenis mobil.</p>
            </div>
            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box"><i class="fas fa-shield-alt"></i></div>
                <h3>Garansi Servis</h3>
                <p>Kami memberikan garansi untuk setiap pemasangan full set maupun part.</p>
            </div>
        </div>
    </div>

    <div class="section" style="background: #f9f9f9;" id="tentang">
        <div class="about-container">
            <div class="about-img" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1530046339160-ce3e530c7d2f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Tentang Bengkel">
            </div>
            <div class="about-text" data-aos="fade-left">
                <h2 class="section-title" style="text-align: left;">Bengkel Knalpot Mobil Terpercaya</h2>
                <p>Alpino Jakarta hadir untuk mengubah suara kendaraan anda. Kami menggabungkan teknologi booking modern dengan keahlian mekanik konvensional.</p>
                <p>Dengan sistem yang transparan, Anda bisa memantau riwayat servis</p>
                <br>
                <a href="#" style="color: var(--primary); font-weight: bold; text-decoration: none;">Pelajari Selengkapnya &rarr;</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-col" style="flex: 2;">
                <h3><i class="fas fa-wrench"></i> Alpino Jakarta</h3>
                <p>Buat Suara Mobil anda lebih keren.</p>
            </div>
            <div class="footer-col">
                <h3>Layanan</h3>
                <p>Jasa Pasang Muffler</p>
                <p>Service Muffler</p>
                <p>Servis</p>
            </div>
            <div class="footer-col">
                <h3>Kontak</h3>
                <p><i class="fas fa-phone"></i> 0812-1974-0677</p>
                <p><i class="fas fa-envelope"></i> alpino@gmail.com</p>
                <div class="social-icons" style="margin-top: 10px;">
                    <a href="https://facebook.com/username_fb_kamu" target="_blank" style="color: inherit; text-decoration: none;">
                        <i class="fab fa-facebook"></i>
                    </a>

                    <a href="https://instagram.com/alpino_exhaust_jakarta" target="_blank" style="color: inherit; text-decoration: none;">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://wa.me/6281219740677?text=Halo%20Admin%20saya%20mau%20tanya..." target="_blank" style="color: inherit; text-decoration: none;">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 40px; border-top: 1px solid #444; padding-top: 20px;">
            &copy; 2026 Alpino Jakarta.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // 1. Inisialisasi Animasi Scroll (AOS)
        AOS.init({
            duration: 1000, // Durasi animasi 1 detik
            once: true,     // Animasi cuma sekali saat scroll ke bawah
        });

        // 2. Inisialisasi Slider (Swiper)
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 0,
            centeredSlides: true,
            effect: "fade", // Efek memudar saat ganti slide
            loop: true,     // Slider muter terus
            autoplay: {
                delay: 4000, // Ganti gambar tiap 4 detik
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
</body>
</html>
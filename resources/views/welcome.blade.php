<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            color: white;
        }
        
        .feature-card {
            transition: transform 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }

        .stats-section {
            background-color: #f8f9fa;
        }

        .stat-card {
            border: none;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .news-card {
            transition: transform 0.3s;
        }
        
        .news-card:hover {
            transform: scale(1.02);
        }

        .footer {
            background-color: #212529;
            color: white;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            margin: 0 5px;
            transition: background 0.3s;
        }

        .social-icon:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/images/logo.png" alt="Logo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#news">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Kontak</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary ms-2" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center" id="home">
        <div class="container text-center">
            <h1 class="display-3 fw-bold mb-4">Selamat Datang di {{ config('app.name') }}</h1>
            <p class="lead mb-4">Membentuk Generasi Unggul, Berakhlak Mulia, dan Berwawasan Global</p>
            <a href="#about" class="btn btn-primary btn-lg">Pelajari Lebih Lanjut</a>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="/images/about.jpg" alt="About Us" class="img-fluid rounded">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Tentang Kami</h2>
                    <p class="lead">Kami adalah lembaga pendidikan yang berkomitmen untuk memberikan pendidikan berkualitas dengan nilai-nilai islami.</p>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-primary fs-4 me-2"></i>
                                <div>
                                    <h5 class="mb-0">Kurikulum Terpadu</h5>
                                    <p class="mb-0">Memadukan kurikulum nasional dan internasional</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people-fill text-primary fs-4 me-2"></i>
                                <div>
                                    <h5 class="mb-0">Guru Berkualitas</h5>
                                    <p class="mb-0">Tim pengajar profesional dan berpengalaman</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-light py-5" id="features">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Fasilitas Kami</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-book text-primary fs-1 mb-3"></i>
                            <h4>Perpustakaan Digital</h4>
                            <p>Akses ribuan buku dan jurnal secara digital</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-laptop text-primary fs-1 mb-3"></i>
                            <h4>Lab Komputer</h4>
                            <p>Fasilitas komputer modern untuk pembelajaran</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-trophy text-primary fs-1 mb-3"></i>
                            <h4>Unit Produksi</h4>
                            <p>Sarana praktik kewirausahaan siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card text-center p-4">
                        <h2 class="fw-bold text-primary">500+</h2>
                        <p class="mb-0">Siswa Aktif</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card text-center p-4">
                        <h2 class="fw-bold text-primary">50+</h2>
                        <p class="mb-0">Guru & Staff</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card text-center p-4">
                        <h2 class="fw-bold text-primary">95%</h2>
                        <p class="mb-0">Tingkat Kelulusan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card stat-card text-center p-4">
                        <h2 class="fw-bold text-primary">20+</h2>
                        <p class="mb-0">Program Unggulan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-5" id="news">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Berita Terbaru</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card news-card h-100">
                        <img src="/images/news1.jpg" class="card-img-top" alt="News 1">
                        <div class="card-body">
                            <h5 class="card-title">Prestasi Olimpiade Sains</h5>
                            <p class="card-text">Siswa kami meraih medali emas dalam Olimpiade Sains Nasional</p>
                            <a href="#" class="btn btn-outline-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Add more news cards -->
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="bg-light py-5" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Hubungi Kami</h2>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nama Lengkap">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" placeholder="Pesan"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <h4>Informasi Kontak</h4>
                        <p><i class="bi bi-geo-alt-fill me-2"></i> Jl. Contoh No. 123, Kota</p>
                        <p><i class="bi bi-telephone-fill me-2"></i> (021) 1234-5678</p>
                        <p><i class="bi bi-envelope-fill me-2"></i> info@sekolah.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; 2024 {{ config('app.name') }}. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="social-icon text-white"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon text-white"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon text-white"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>

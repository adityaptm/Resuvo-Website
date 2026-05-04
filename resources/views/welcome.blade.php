@extends('layouts.app')

@section('title', 'Resuvo - Buat CV Profesional dalam Hitungan Menit')

@section('content')
    <!-- Hero Section -->
    <header class="hero">
        <div class="container hero-container">
            <div class="hero-content">
                <h1>Buat CV Profesional dalam Hitungan Menit</h1>
                <p>Resuvo membantu pengguna membuat CV profesional dengan template yang modern dan mudah digunakan. Tingkatkan peluang karirmu sekarang.</p>
                <div class="hero-buttons">
                    <a href="#templates" class="btn btn-primary btn-lg">Lihat Template</a>
                    <a href="/builder" class="btn btn-outline btn-lg">Buat CV Sekarang</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="image-wrapper">
                    <img src="{{ asset('img/hero_cv.png') }}" alt="Preview Template CV Resuvo">
                    <div class="floating-card user-card">
                        <i class="fas fa-check-circle"></i>
                        <span>ATS Friendly</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Logo Showcase -->
    <section class="logo-showcase">
        <div class="container">
            <p style="text-align: center; color: var(--text-muted); margin-bottom: 20px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; font-size: 0.75rem;">Dipercaya oleh kandidat yang bekerja di:</p>
            <div class="logo-slider">
                <div class="logo-track">
                    <img src="{{ asset('img/p1.png') }}" alt="Partner 1">
                    <img src="{{ asset('img/p2.jpg') }}" alt="Partner 2">
                    <img src="{{ asset('img/p3.jpg') }}" alt="Partner 3">
                    <img src="{{ asset('img/p4.png') }}" alt="Partner 4">
                    <img src="{{ asset('img/p5.png') }}" alt="Partner 5">
                    <img src="{{ asset('img/p7.png') }}" alt="Partner 7">
                    <!-- Duplicate for loop -->
                    <img src="{{ asset('img/p1.png') }}" alt="Partner 1">
                    <img src="{{ asset('img/p2.jpg') }}" alt="Partner 2">
                    <img src="{{ asset('img/p3.jpg') }}" alt="Partner 3">
                    <img src="{{ asset('img/p4.png') }}" alt="Partner 4">
                    <img src="{{ asset('img/p5.png') }}" alt="Partner 5">
                    <img src="{{ asset('img/p7.png') }}" alt="Partner 7">
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section id="fitur" class="features">
        <div class="container">
            <div class="section-header">
                <h2>Kenapa Memilih Resuvo?</h2>
                <p>Fitur unggulan untuk membantumu selangkah lebih dekat dengan pekerjaan impian.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>ATS Friendly</h3>
                    <p>Template kami dirancang khusus agar mudah dibaca oleh sistem rekrutmen (ATS) perusahaan besar.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Instan & Mudah</h3>
                    <p>Lupakan desain yang rumit. Cukup isi data diri Anda, dan biarkan sistem kami yang melakukan sisanya.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h3>Aman & Privat</h3>
                    <p>Data Anda aman bersama kami. Kami menggunakan enkripsi standar industri untuk melindungi informasi Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Preview Template CV -->
    <section id="templates" class="templates">
        <div class="container">
            <div class="section-header">
                <h2>Pilihan Template CV Terbaik</h2>
                <p>Template ATS-pro kami adalah pilihan nomor satu bagi para profesional sukses.</p>
            </div>
            <div style="max-width: 500px; margin: 0 auto;">
                <div class="template-card" style="box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 2px solid var(--accent-color);">
                    <div class="template-img">
                        <img src="{{ asset('images/template1.png') }}" alt="ATS Professional Template">
                        <div class="template-overlay">
                            <a href="/builder" class="btn btn-primary">Gunakan Template Ini</a>
                        </div>
                    </div>
                    <div class="template-info">
                        <h3>ATS Professional Black</h3>
                        <span class="badge premium-badge" style="background: #0f172a; color: #fff;"><i class="fas fa-crown"></i> BEST SELLER</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="pricing">
        <div class="container">
            <div class="section-header">
                <h2>Paket Harga Sederhana</h2>
                <p>Pilih paket yang paling pas untuk kebutuhanmu. Bayar sekali, manfaat berkali-kali.</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3>Free Preview</h3>
                    <div class="price">
                        <span class="currency">Rp</span>0
                    </div>
                    <p class="desc">Cocok untuk mencoba fitur builder kami.</p>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check text-green"></i> Builder interaktif</li>
                        <li><i class="fas fa-check text-green"></i> Live preview</li>
                        <li><i class="fas fa-check text-green"></i> Simpan draf CV</li>
                        <li class="unavailable"><i class="fas fa-times"></i> Download PDF</li>
                        <li class="unavailable"><i class="fas fa-times"></i> Tanpa Watermark</li>
                    </ul>
                    <a href="/builder" class="btn btn-outline btn-block">Mulai Gratis</a>
                </div>
                <div class="pricing-card premium">
                    <div class="popular-badge">Populer</div>
                    <h3>Full Access</h3>
                    <div class="price">
                        <span class="currency">Rp</span>25K <span class="period">/CV</span>
                    </div>
                    <p class="desc">Akses penuh untuk download PDF profesional.</p>
                    <ul class="pricing-features">
                        <li><i class="fas fa-check text-yellow"></i> Semua template premium</li>
                        <li><i class="fas fa-check text-yellow"></i> Download PDF HD</li>
                        <li><i class="fas fa-check text-yellow"></i> Tanpa watermark</li>
                        <li><i class="fas fa-check text-yellow"></i> Edit sepuasnya</li>
                        <li><i class="fas fa-check text-yellow"></i> Prioritas support</li>
                    </ul>
                    <a href="/builder" class="btn btn-primary btn-block">Buat Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section id="cta" class="cta">
        <div class="container">
            <div class="cta-box">
                <h2>Mulai Buat CV Profesional Sekarang</h2>
                <p>Bergabung dengan ribuan orang sukses yang telah mendapatkan pekerjaan impian dengan Resuvo.</p>
                <a href="/builder" class="btn btn-primary btn-lg cta-btn">Buat CV Sekarang <i class="fas fa-rocket"></i></a>
            </div>
        </div>
    </section>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'RESUVO - Build Your Professional CV')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/resuvo.css') }}">
    
    @yield('styles')
</head>
<body>
    <nav class="navbar no-print">
        <div class="container nav-container">
            <a href="/" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="RESUVO">
            </a>
            <div class="nav-links">
                <a href="/">Home</a>
                <a href="/#templates">Templates</a>
                <a href="/#pricing">Pricing</a>
                <a href="/#fitur">Fitur</a>
            </div>
            <div class="nav-buttons">
                <a href="/builder" class="btn btn-primary">Buat CV Sekarang</a>
            </div>
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="no-print">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="footer-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="RESUVO">
                    </a>
                    <p>Membangun CV profesional dalam hitungan menit dengan builder premium kami.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Produk</h4>
                    <ul>
                        <li><a href="/builder">CV Builder</a></li>
                        <li><a href="/#templates">Templates</a></li>
                        <li><a href="/#pricing">Harga</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Perusahaan</h4>
                    <ul>
                        <li><a href="/about">Tentang Kami</a></li>
                        <li><a href="/contact">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="/#">Privacy Policy</a></li>
                        <li><a href="/#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom" style="text-align: center; padding-top: 40px; border-top: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.5);">
                <p>&copy; {{ date('Y') }} RESUVO. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileBtn = document.querySelector('.mobile-menu-btn');
            const navLinks = document.querySelector('.nav-links');
            
            if(mobileBtn && navLinks) {
                mobileBtn.addEventListener('click', function() {
                    navLinks.classList.toggle('active');
                    
                    // Toggle icon between bars and times
                    const icon = mobileBtn.querySelector('i');
                    if (icon) {
                        if (navLinks.classList.contains('active')) {
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-times');
                        } else {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    }
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>

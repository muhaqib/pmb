@extends('layouts.app')

@section('body')
{{-- Top Navigation Bar --}}
<header id="main-header" class="fixed top-0 w-full z-50 glass border-b border-outline-variant/30 transition-all duration-300" style="height: 64px;">
    <div class="max-w-[1280px] mx-auto h-full flex items-center justify-between px-4 md:px-10">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group" id="logo-link">
            <div class="w-10 h-10 rounded-lg gradient-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl icon-filled">school</span>
            </div>
            <span class="text-h3 text-primary hidden sm:block" style="font-size: 18px;">STIT Mambaul Hikmah</span>
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-8" id="desktop-nav">
            <a href="{{ route('home') }}" class="text-label-md {{ request()->routeIs('home') ? 'text-primary' : 'text-on-surface-variant hover:text-primary' }} transition-colors">Beranda</a>
            <a href="{{ route('home') }}#prodi" class="text-label-md text-on-surface-variant hover:text-primary transition-colors">Program Studi</a>
            <a href="{{ route('home') }}#jadwal" class="text-label-md text-on-surface-variant hover:text-primary transition-colors">Jadwal</a>
            <a href="{{ route('home') }}#faq" class="text-label-md text-on-surface-variant hover:text-primary transition-colors">FAQ</a>
        </nav>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-secondary btn-sm" id="btn-login-header">
                Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm" id="btn-register-header">
                Daftar
                <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
            {{-- Mobile menu toggle --}}
            <button class="md:hidden p-2 rounded-lg hover:bg-surface-low transition-colors" id="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined text-on-surface">menu</span>
            </button>
        </div>
    </div>
</header>

{{-- Mobile Menu Drawer --}}
<div id="mobile-menu" class="fixed inset-0 z-[60] hidden">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm" onclick="toggleMobileMenu()"></div>
    <div class="absolute right-0 top-0 h-full w-72 bg-surface-lowest shadow-2xl p-6 flex flex-col gap-6 animate-slide-in">
        <div class="flex justify-between items-center">
            <span class="text-h3" style="font-size:18px;">Menu</span>
            <button onclick="toggleMobileMenu()" class="p-2 rounded-lg hover:bg-surface-low">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex flex-col gap-1">
            <a href="{{ route('home') }}" class="sidebar-nav-item {{ request()->routeIs('home') ? 'sidebar-nav-item-active' : '' }}">
                <span class="material-symbols-outlined">home</span> Beranda
            </a>
            <a href="{{ route('home') }}#prodi" class="sidebar-nav-item" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">school</span> Program Studi
            </a>
            <a href="{{ route('home') }}#jadwal" class="sidebar-nav-item" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">calendar_month</span> Jadwal
            </a>
            <a href="{{ route('home') }}#faq" class="sidebar-nav-item" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined">help</span> FAQ
            </a>
        </nav>
        <div class="mt-auto flex flex-col gap-3">
            <a href="{{ route('login') }}" class="btn btn-secondary w-full">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary w-full">Daftar Sekarang</a>
        </div>
    </div>
</div>

{{-- Main Content --}}
<main class="pt-16">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-navy text-white py-16 px-4 md:px-10">
    <div class="max-w-[1280px] mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-white icon-filled">school</span>
                    </div>
                    <span class="text-h3" style="font-size:18px;">STIT Mambaul Hikmah</span>
                </div>
                <p class="text-body-sm text-white/60 max-w-md leading-relaxed">Sekolah Tinggi Ilmu Tarbiyah yang berkomitmen mencetak generasi unggul, berilmu, dan berakhlak mulia. Mengintegrasikan keilmuan akademik dan nilai-nilai keislaman.</p>
            </div>
            <div>
                <h4 class="text-label-md mb-4">Tautan</h4>
                <nav class="flex flex-col gap-3">
                    <a href="#" class="text-body-sm text-white/60 hover:text-white transition-colors">Tentang Kami</a>
                    <a href="#" class="text-body-sm text-white/60 hover:text-white transition-colors">Program Studi</a>
                    <a href="#" class="text-body-sm text-white/60 hover:text-white transition-colors">Kalender Akademik</a>
                    <a href="#" class="text-body-sm text-white/60 hover:text-white transition-colors">Kontak</a>
                </nav>
            </div>
            <div>
                <h4 class="text-label-md mb-4">Hubungi Kami</h4>
                <div class="flex flex-col gap-3 text-body-sm text-white/60">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">location_on</span>
                        Kec. Karanggeneng, Lamongan
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">phone</span>
                        (0322) 123-456
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">mail</span>
                        info@stitmambaulhikmah.ac.id
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 pt-8 text-center">
            <p class="text-label-sm text-white/40">&copy; {{ date('Y') }} STIT Mambaul Hikmah. Seluruh hak cipta dilindungi.</p>
        </div>
    </div>
</footer>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
    document.body.style.overflow = menu.classList.contains('hidden') ? '' : 'hidden';
}

// Sticky header shadow on scroll
window.addEventListener('scroll', () => {
    const header = document.getElementById('main-header');
    if (window.scrollY > 20) {
        header.style.boxShadow = '0 4px 24px rgba(0,0,0,0.08)';
    } else {
        header.style.boxShadow = 'none';
    }
});
</script>
@endsection

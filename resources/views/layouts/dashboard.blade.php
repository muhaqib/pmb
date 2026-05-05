@extends('layouts.app')

@section('body')
{{-- Top Navigation --}}
<header class="fixed top-0 w-full z-50 bg-surface-lowest border-b border-outline-variant/30 elevation-1" style="height: 64px;">
    <div class="h-full flex items-center justify-between px-4 md:px-6">
        <div class="flex items-center gap-3">
            {{-- Mobile sidebar toggle --}}
            <button class="md:hidden p-2 rounded-lg hover:bg-surface-low transition-colors" id="sidebar-toggle" onclick="toggleSidebar()">
                <span class="material-symbols-outlined text-on-surface">menu</span>
            </button>
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-2xl icon-filled">account_balance</span>
                <h1 class="text-h3 text-primary hidden sm:block" style="font-size: 18px; font-weight: 700;">SIAKAD Mobile</h1>
            </a>
        </div>
        <div class="flex items-center gap-4">
            <button class="relative p-2 rounded-full hover:bg-surface-low transition-all active:scale-95" id="btn-notifications">
                <span class="material-symbols-outlined text-on-surface-variant">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full"></span>
            </button>
            <div class="w-9 h-9 rounded-full overflow-hidden border-2 border-outline-variant bg-primary-fixed flex items-center justify-center cursor-pointer hover:ring-2 hover:ring-primary/30 transition-all">
                <span class="material-symbols-outlined text-primary text-lg">person</span>
            </div>
        </div>
    </div>
</header>

{{-- Sidebar Overlay (Mobile) --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

{{-- Sidebar --}}
<aside id="sidebar" class="sidebar -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
    {{-- User Info --}}
    <div class="px-6 mb-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center">
                <span class="material-symbols-outlined text-primary icon-filled">person_search</span>
            </div>
            <div>
                <p class="text-label-md text-primary">Rian Andrianto</p>
                <p class="text-label-sm text-on-surface-variant">2024101088</p>
            </div>
        </div>
        <div class="mt-3">
            <p class="text-label-sm text-on-surface-variant uppercase tracking-wider" style="font-size: 10px;">Program Studi</p>
            <p class="text-label-md text-primary" style="font-size: 13px;">S1 Pendidikan Agama Islam</p>
        </div>
    </div>

    <hr class="border-outline-variant/50 mx-6 mb-2">

    {{-- Navigation --}}
    <nav class="flex-1 flex flex-col gap-0.5 px-3 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard') ? 'sidebar-nav-item-active' : '' }}" id="nav-dashboard">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'icon-filled' : '' }}">dashboard</span>
            Dashboard
        </a>
        <a href="{{ route('dashboard.formulir') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard.formulir') ? 'sidebar-nav-item-active' : '' }}" id="nav-formulir">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard.formulir') ? 'icon-filled' : '' }}">edit_document</span>
            Formulir Pendaftaran
        </a>
        <a href="{{ route('dashboard.dokumen') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard.dokumen') ? 'sidebar-nav-item-active' : '' }}" id="nav-dokumen">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard.dokumen') ? 'icon-filled' : '' }}">upload_file</span>
            Upload Dokumen
        </a>
        <a href="{{ route('dashboard.pembayaran') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard.pembayaran') ? 'sidebar-nav-item-active' : '' }}" id="nav-pembayaran">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard.pembayaran') ? 'icon-filled' : '' }}">account_balance_wallet</span>
            Pembayaran
        </a>
        <a href="{{ route('dashboard.pengumuman') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard.pengumuman') ? 'sidebar-nav-item-active' : '' }}" id="nav-pengumuman">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard.pengumuman') ? 'icon-filled' : '' }}">campaign</span>
            Pengumuman
        </a>
        <a href="{{ route('dashboard.jadwal') }}" class="sidebar-nav-item {{ request()->routeIs('dashboard.jadwal') ? 'sidebar-nav-item-active' : '' }}" id="nav-jadwal">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard.jadwal') ? 'icon-filled' : '' }}">calendar_month</span>
            Kalender Akademik
        </a>
        <a href="#" class="sidebar-nav-item" id="nav-panduan">
            <span class="material-symbols-outlined">menu_book</span>
            Panduan Pengguna
        </a>
    </nav>

    {{-- Logout --}}
    <div class="px-3 mt-auto pt-4">
        <hr class="border-outline-variant/50 mb-4 mx-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-nav-item text-error hover:bg-danger-light w-full text-left" id="btn-logout">
                <span class="material-symbols-outlined">logout</span>
                Keluar
            </button>
        </form>
    </div>
</aside>

{{-- Main Content --}}
<main class="pt-20 pb-28 md:pb-10 md:pl-[300px] md:pr-8 px-4 min-h-screen">
    @yield('content')
</main>

{{-- Bottom Navigation (Mobile) --}}
<nav class="md:hidden fixed bottom-0 w-full z-50 glass border-t border-outline-variant/30 elevation-2" style="height: 72px; padding-bottom: env(safe-area-inset-bottom);">
    <div class="h-full flex justify-around items-center px-2">
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl transition-all active:scale-90 {{ request()->routeIs('dashboard') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant' }}" id="mob-nav-home">
            <span class="material-symbols-outlined text-xl {{ request()->routeIs('dashboard') ? 'icon-filled' : '' }}">home</span>
            <span class="text-label-sm" style="font-size:10px;">Beranda</span>
        </a>
        <a href="{{ route('dashboard.formulir') }}" class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl transition-all active:scale-90 {{ request()->routeIs('dashboard.formulir') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant' }}" id="mob-nav-akademik">
            <span class="material-symbols-outlined text-xl {{ request()->routeIs('dashboard.formulir') ? 'icon-filled' : '' }}">school</span>
            <span class="text-label-sm" style="font-size:10px;">Akademik</span>
        </a>
        <a href="{{ route('dashboard.pembayaran') }}" class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl transition-all active:scale-90 {{ request()->routeIs('dashboard.pembayaran') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant' }}" id="mob-nav-keuangan">
            <span class="material-symbols-outlined text-xl {{ request()->routeIs('dashboard.pembayaran') ? 'icon-filled' : '' }}">account_balance_wallet</span>
            <span class="text-label-sm" style="font-size:10px;">Keuangan</span>
        </a>
        <a href="#" class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl transition-all active:scale-90 text-on-surface-variant" id="mob-nav-profil">
            <span class="material-symbols-outlined text-xl">person</span>
            <span class="text-label-sm" style="font-size:10px;">Profil</span>
        </a>
    </div>
</nav>

{{-- FAB Help --}}
<button class="fab right-6 bottom-24 md:bottom-8 gradient-primary text-white" id="fab-help">
    <span class="material-symbols-outlined">support_agent</span>
</button>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const isOpen = !sidebar.classList.contains('-translate-x-full');

    if (isOpen) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = '';
    } else {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}
</script>
@endsection

@extends('layouts.app')

@section('body')
{{-- Top Navigation --}}
<header class="fixed top-0 w-full z-50 bg-navy text-white border-b border-navy/20 elevation-2" style="height: 64px;">
    <div class="h-full flex items-center justify-between px-4 md:px-6">
        <div class="flex items-center gap-3">
            {{-- Mobile sidebar toggle --}}
            <button class="md:hidden p-2 rounded-lg hover:bg-white/10 transition-colors" id="sidebar-toggle" onclick="toggleSidebar()">
                <span class="material-symbols-outlined text-white">menu</span>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <span class="material-symbols-outlined text-white text-2xl icon-filled">admin_panel_settings</span>
                <h1 class="text-h3 text-white hidden sm:block" style="font-size: 18px; font-weight: 700;">PMB Admin</h1>
            </a>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-3">
                <span class="text-label-sm text-white/80 hidden sm:block">{{ Auth::user()->name }}</span>
                <div class="w-9 h-9 rounded-full overflow-hidden border border-white/20 bg-white/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-lg">person</span>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Sidebar Overlay (Mobile) --}}
<div id="sidebar-overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 hidden md:hidden" onclick="toggleSidebar()"></div>

{{-- Sidebar --}}
<aside id="sidebar" class="sidebar -translate-x-full md:translate-x-0 transition-transform duration-300 z-40 bg-navy/5">
    {{-- Navigation --}}
    <nav class="flex-1 flex flex-col gap-0.5 px-3 overflow-y-auto mt-4">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-nav-item {{ request()->routeIs('admin.dashboard') ? 'sidebar-nav-item-active' : '' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'icon-filled' : '' }}">dashboard</span>
            Dashboard
        </a>
        <a href="{{ route('admin.pendaftar.index') }}" class="sidebar-nav-item {{ request()->routeIs('admin.pendaftar.*') ? 'sidebar-nav-item-active' : '' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.pendaftar.*') ? 'icon-filled' : '' }}">group</span>
            Data Pendaftar
        </a>
        <a href="#" class="sidebar-nav-item">
            <span class="material-symbols-outlined">folder_open</span>
            Verifikasi Dokumen
        </a>
        <a href="#" class="sidebar-nav-item">
            <span class="material-symbols-outlined">account_balance_wallet</span>
            Verifikasi Pembayaran
        </a>
        <a href="#" class="sidebar-nav-item">
            <span class="material-symbols-outlined">analytics</span>
            Laporan
        </a>
        <a href="#" class="sidebar-nav-item">
            <span class="material-symbols-outlined">settings</span>
            Pengaturan
        </a>
    </nav>

    {{-- Logout --}}
    <div class="px-3 mt-auto pt-4">
        <hr class="border-outline-variant/50 mb-4 mx-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-nav-item text-error hover:bg-danger-light w-full text-left">
                <span class="material-symbols-outlined">logout</span>
                Keluar Admin
            </button>
        </form>
    </div>
</aside>

{{-- Main Content --}}
<main class="pt-20 pb-10 md:pl-[300px] md:pr-8 px-4 min-h-screen bg-surface-lowest">
    @if(session('success'))
        <div class="alert alert-success mb-6 animate-fade-in">
            <span class="material-symbols-outlined text-success mt-0.5 icon-filled">check_circle</span>
            <div>
                <h4 class="text-label-md text-on-surface">Sukses</h4>
                <p class="text-body-sm text-on-surface-variant mt-1">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    @yield('content')
</main>

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

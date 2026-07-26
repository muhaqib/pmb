@extends('layouts.app')

@section('title', 'Login Administrator')
@section('meta_description', 'Portal Login Administrator PMB STIT Mambaul Hikmah')

@section('body')
<div class="min-h-screen flex" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #311b92 100%);">
    {{-- Left Panel - Admin Branding --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden items-center justify-center p-12">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 right-20 w-[450px] h-[450px] bg-indigo-500 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-20 left-20 w-[350px] h-[350px] bg-purple-600 rounded-full blur-[100px]"></div>
        </div>
        
        <div class="relative z-10 text-center text-white max-w-lg">
            <div class="w-24 h-24 rounded-3xl bg-white/10 backdrop-blur-md flex items-center justify-center mx-auto mb-8 border border-white/20 shadow-2xl">
                <span class="material-symbols-outlined text-indigo-300 icon-filled" style="font-size: 52px;">admin_panel_settings</span>
            </div>
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-500/20 border border-indigo-400/30 text-indigo-200 text-xs font-semibold uppercase tracking-wider mb-6">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Administrator Portal
            </div>
            
            <h1 class="text-h1 mb-4" style="color:white; font-weight: 700;">PMB Admin System</h1>
            <p class="text-body-lg text-slate-300 mb-8">Panel Manajemen dan Otentikasi Terpusat PMB STIT Mambaul Hikmah</p>
            
            <div class="p-6 rounded-2xl bg-white/5 backdrop-blur-sm border border-white/10 text-left space-y-3 text-slate-300 text-sm">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-indigo-400 text-lg">verified_user</span>
                    <span>Akses Terbatas Khusus Pengelola & Panitia PMB</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-indigo-400 text-lg">security</span>
                    <span>Monitoring Pendaftaran & Verifikasi Dokumen Real-time</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-indigo-400 text-lg">encrypted</span>
                    <span>Koneksi Aman & Terenkripsi</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel - Admin Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 bg-slate-950/40 backdrop-blur-md">
        <div class="w-full max-w-md">
            {{-- Mobile Header --}}
            <div class="lg:hidden text-center mb-8">
                <div class="w-16 h-16 rounded-2xl bg-indigo-600/30 border border-indigo-500/30 flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-indigo-400 icon-filled" style="font-size: 36px;">admin_panel_settings</span>
                </div>
                <h1 class="text-h3 text-white font-bold">Admin Portal</h1>
                <p class="text-xs text-slate-400 mt-1">STIT Mambaul Hikmah</p>
            </div>

            <div class="card rounded-2xl p-8 shadow-2xl bg-slate-900/90 border border-slate-800 text-slate-100 animate-scale-in" id="admin-login-card">
                <div class="text-center mb-8">
                    <div class="inline-block p-2 rounded-xl bg-indigo-500/10 text-indigo-400 mb-3">
                        <span class="material-symbols-outlined text-2xl">lock</span>
                    </div>
                    <h2 class="text-h2 text-white mb-2" style="font-size: 24px;">Login Administrator</h2>
                    <p class="text-body-sm text-slate-400">Masukkan akun admin Anda untuk mengelola sistem PMB</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-error mb-6 bg-red-500/10 border-red-500/30 text-red-400 p-4 rounded-xl">
                        <div class="flex items-center gap-2 text-sm">
                            <span class="material-symbols-outlined icon-filled text-base">error</span>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error mb-6 bg-red-500/10 border-red-500/30 text-red-400 p-4 rounded-xl">
                        <div class="flex items-start gap-2 text-sm">
                            <span class="material-symbols-outlined mt-0.5 icon-filled text-base">error</span>
                            <div>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.admin') }}" method="POST" class="space-y-5" id="admin-login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label text-slate-300">Email Administrator</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input pl-11 bg-slate-800/80 border-slate-700 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500/20" placeholder="admin@stit.ac.id" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="flex justify-between items-center">
                            <label for="password" class="form-label text-slate-300">Kata Sandi</label>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">key</span>
                            <input type="password" id="password" name="password" class="form-input pl-11 pr-11 bg-slate-800/80 border-slate-700 text-white placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500/20" placeholder="••••••••" required>
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200 transition-colors" onclick="togglePassword(this)">
                                <span class="material-symbols-outlined text-xl">visibility_off</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-slate-700 bg-slate-800 text-indigo-600 focus:ring-indigo-500/30 accent-indigo-600">
                        <label for="remember" class="text-body-sm text-slate-400 cursor-pointer">Ingat sesi ini</label>
                    </div>

                    <button type="submit" class="btn w-full btn-lg bg-indigo-600 hover:bg-indigo-500 text-white border-none shadow-lg shadow-indigo-600/30 transition-all duration-200 font-semibold" id="btn-admin-login-submit">
                        <span class="material-symbols-outlined text-xl">shield_lock</span>
                        Masuk Dashboard Admin
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-label-sm text-slate-400 hover:text-indigo-300 transition-colors inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Kembali ke Beranda Utama
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(button) {
    const input = button.previousElementSibling;
    const icon = button.querySelector('.material-symbols-outlined');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
    }
}
</script>
@endsection

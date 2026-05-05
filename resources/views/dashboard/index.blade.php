@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
{{-- Welcome Section --}}
<div class="mb-8 animate-fade-in">
    <h2 class="text-h2 text-on-surface" style="font-size: 28px;">Selamat Datang, {{ explode(' ', $user->name)[0] }}!</h2>
    <p class="text-body-md text-secondary mt-1">Satu langkah lagi untuk menjadi bagian dari keluarga besar universitas.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    {{-- Main Progress Section --}}
    <section class="lg:col-span-8 space-y-6">
        {{-- Registration Progress Card --}}
        <div class="card rounded-2xl animate-fade-in" id="progress-card">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-h3 text-primary" style="font-size: 18px;">Progress Pendaftaran</h3>
                <span class="chip chip-info">{{ $progress }}% Selesai</span>
            </div>

            {{-- Stepper --}}
            <div class="stepper px-2">
                <div class="stepper-line">
                    <div class="stepper-line-fill" style="width: {{ $progress > 0 ? $progress - 15 : 0 }}%;"></div>
                </div>

                <div class="stepper-step">
                    <div class="stepper-dot {{ $pendaftaran && $pendaftaran->is_profile_complete ? 'stepper-dot-completed' : 'stepper-dot-active animate-pulse-glow' }}">
                        <span class="material-symbols-outlined text-sm {{ $pendaftaran && $pendaftaran->is_profile_complete ? 'icon-filled' : '' }}">{{ $pendaftaran && $pendaftaran->is_profile_complete ? 'check' : 'person' }}</span>
                    </div>
                    <span class="stepper-label {{ !$pendaftaran || !$pendaftaran->is_profile_complete ? 'stepper-label-active' : '' }}">Lengkapi Profil</span>
                </div>

                <div class="stepper-step">
                    <div class="stepper-dot {{ $pendaftaran && $pendaftaran->is_document_uploaded ? 'stepper-dot-completed' : ($pendaftaran && $pendaftaran->is_profile_complete ? 'stepper-dot-active animate-pulse-glow' : '') }}">
                        <span class="material-symbols-outlined text-sm {{ $pendaftaran && $pendaftaran->is_document_uploaded ? 'icon-filled' : '' }}">{{ $pendaftaran && $pendaftaran->is_document_uploaded ? 'check' : 'folder' }}</span>
                    </div>
                    <span class="stepper-label {{ $pendaftaran && !$pendaftaran->is_document_uploaded && $pendaftaran->is_profile_complete ? 'stepper-label-active' : '' }}">Upload Dokumen</span>
                </div>

                <div class="stepper-step">
                    <div class="stepper-dot {{ $pendaftaran && $pendaftaran->is_payment_uploaded ? 'stepper-dot-completed' : ($pendaftaran && $pendaftaran->is_document_uploaded ? 'stepper-dot-active animate-pulse-glow' : '') }}">
                        <span class="material-symbols-outlined text-sm {{ $pendaftaran && $pendaftaran->is_payment_uploaded ? 'icon-filled' : '' }}">{{ $pendaftaran && $pendaftaran->is_payment_uploaded ? 'check' : 'payments' }}</span>
                    </div>
                    <span class="stepper-label {{ $pendaftaran && !$pendaftaran->is_payment_uploaded && $pendaftaran->is_document_uploaded ? 'stepper-label-active' : '' }}">Pembayaran</span>
                </div>

                <div class="stepper-step">
                    <div class="stepper-dot {{ $pendaftaran && $pendaftaran->status_kelulusan !== 'pending' ? 'stepper-dot-completed' : ($pendaftaran && $pendaftaran->is_payment_uploaded ? 'stepper-dot-active animate-pulse-glow' : '') }}">
                        <span class="material-symbols-outlined text-sm">{{ $pendaftaran && $pendaftaran->status_kelulusan !== 'pending' ? 'check' : 'edit_note' }}</span>
                    </div>
                    <span class="stepper-label {{ $pendaftaran && $pendaftaran->status_kelulusan === 'pending' && $pendaftaran->is_payment_uploaded ? 'stepper-label-active' : '' }}">Tes Seleksi</span>
                </div>
            </div>
        </div>

        @if($pendaftaran && $pendaftaran->is_document_uploaded && !$pendaftaran->is_payment_uploaded)
        {{-- Verification Status Alert --}}
        <div class="alert alert-info animate-fade-in animate-delay-1" id="alert-verification">
            <span class="material-symbols-outlined text-primary mt-0.5 icon-filled">verified_user</span>
            <div>
                <h4 class="text-label-md text-primary">Status Verifikasi Berkas</h4>
                <p class="text-body-sm text-on-surface-variant mt-1">
                    Berkas pendaftaran Anda sedang dalam tahap tinjauan oleh tim admisi. Hasil verifikasi akan diumumkan dalam 2x24 jam.
                </p>
            </div>
        </div>
        @endif


        {{-- Quick Actions - Bento Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Action Card 1: Update KTP --}}
            <a href="{{ route('dashboard.dokumen') }}" class="group card card-hover rounded-2xl animate-fade-in animate-delay-2" id="action-ktp">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-primary-fixed text-primary rounded-xl group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined">id_card</span>
                    </div>
                    <span class="material-symbols-outlined text-outline-variant group-hover:text-primary group-hover:translate-x-1 transition-all">arrow_forward</span>
                </div>
                <h4 class="text-h3 text-on-surface" style="font-size: 16px;">Update KTP</h4>
                <p class="text-body-sm text-secondary mt-1">Pastikan foto KTP terlihat jelas dan tidak terpotong.</p>
            </a>

            {{-- Action Card 2: Upload Ijazah --}}
            <a href="{{ route('dashboard.dokumen') }}" class="group card card-hover rounded-2xl animate-fade-in animate-delay-3" id="action-ijazah">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-primary-fixed text-primary rounded-xl group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined">history_edu</span>
                    </div>
                    <span class="material-symbols-outlined text-outline-variant group-hover:text-primary group-hover:translate-x-1 transition-all">arrow_forward</span>
                </div>
                <h4 class="text-h3 text-on-surface" style="font-size: 16px;">Upload Ijazah</h4>
                <p class="text-body-sm text-secondary mt-1">Gunakan scan asli ijazah atau SKL yang sudah dilegalisir.</p>
            </a>

            {{-- Action Card 3: Lihat Tagihan --}}
            <a href="{{ route('dashboard.pembayaran') }}" class="group card card-hover rounded-2xl animate-fade-in animate-delay-4" id="action-tagihan">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-success-light text-success rounded-xl group-hover:bg-success group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="material-symbols-outlined text-outline-variant group-hover:text-success group-hover:translate-x-1 transition-all">arrow_forward</span>
                </div>
                <h4 class="text-h3 text-on-surface" style="font-size: 16px;">Cek Pembayaran</h4>
                <p class="text-body-sm text-secondary mt-1">Lihat riwayat dan status pembayaran pendaftaran Anda.</p>
            </a>

            {{-- Action Card 4: Formulir --}}
            <a href="{{ route('dashboard.formulir') }}" class="group card card-hover rounded-2xl animate-fade-in animate-delay-5" id="action-formulir">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-warning-light text-warning rounded-xl group-hover:bg-warning group-hover:text-white transition-colors duration-300">
                        <span class="material-symbols-outlined">edit_document</span>
                    </div>
                    <span class="material-symbols-outlined text-outline-variant group-hover:text-warning group-hover:translate-x-1 transition-all">arrow_forward</span>
                </div>
                <h4 class="text-h3 text-on-surface" style="font-size: 16px;">Edit Formulir</h4>
                <p class="text-body-sm text-secondary mt-1">Perbarui data biodata dan informasi pendaftaran Anda.</p>
            </a>
        </div>
    </section>

    {{-- Sidebar Info --}}
    <aside class="lg:col-span-4 space-y-6">
        {{-- Selection Result Card --}}
        <div class="gradient-primary text-white p-6 rounded-2xl elevation-3 overflow-hidden relative animate-fade-in animate-delay-2" id="selection-card">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -left-4 -bottom-4 w-20 h-20 bg-white/5 rounded-full blur-xl"></div>
            <div class="relative z-10">
                <h3 class="text-h3 mb-2" style="font-size: 18px; color: white;">Hasil Seleksi</h3>
                <p class="text-body-sm text-white/80 mb-5">Pengumuman seleksi tahap administrasi akan tersedia pada:</p>

                <div class="flex items-center gap-3 bg-white/15 backdrop-blur-sm p-4 rounded-xl border border-white/10 mb-5">
                    <span class="material-symbols-outlined icon-filled">event</span>
                    <div>
                        <p class="text-label-md" style="color: white;">Senin, 15 Juli {{ date('Y') }}</p>
                        <p class="text-label-sm text-white/70">Pukul 10.00 WIB</p>
                    </div>
                </div>

                <a href="{{ route('dashboard.jadwal') }}" class="btn w-full bg-white text-primary hover:bg-blue-50 transition-colors">
                    Lihat Detail Jadwal
                </a>
            </div>
        </div>

        {{-- Notification Panel --}}
        <div class="card rounded-2xl overflow-hidden !p-0 animate-fade-in animate-delay-3" id="notifications-panel">
            <div class="p-4 border-b border-outline-variant/30 flex justify-between items-center">
                <h3 class="text-label-md text-on-surface">Notifikasi Terbaru</h3>
                <button class="text-label-sm text-primary hover:underline">Semua</button>
            </div>
            <div class="divide-y divide-outline-variant/30">
                <div class="p-4 flex gap-3 hover:bg-surface-low transition-colors cursor-pointer">
                    <div class="w-2 h-2 mt-2 rounded-full bg-primary shrink-0"></div>
                    <div>
                        <p class="text-body-sm text-on-surface">Pembayaran pendaftaran berhasil diverifikasi.</p>
                        <p class="text-label-sm text-outline mt-1" style="font-size: 10px;">2 jam yang lalu</p>
                    </div>
                </div>
                <div class="p-4 flex gap-3 hover:bg-surface-low transition-colors cursor-pointer">
                    <div class="w-2 h-2 mt-2 rounded-full bg-outline-variant shrink-0"></div>
                    <div>
                        <p class="text-body-sm text-on-surface">Silahkan lengkapi dokumen prestasi (opsional).</p>
                        <p class="text-label-sm text-outline mt-1" style="font-size: 10px;">Kemarin</p>
                    </div>
                </div>
                <div class="p-4 flex gap-3 hover:bg-surface-low transition-colors cursor-pointer">
                    <div class="w-2 h-2 mt-2 rounded-full bg-outline-variant shrink-0"></div>
                    <div>
                        <p class="text-body-sm text-on-surface">Selamat! Akun Anda telah berhasil dibuat.</p>
                        <p class="text-label-sm text-outline mt-1" style="font-size: 10px;">2 hari yang lalu</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Info --}}
        <div class="card rounded-2xl bg-surface-low border-primary/10 animate-fade-in animate-delay-4" id="quick-info">
            <div class="flex items-center gap-3 mb-3">
                <span class="material-symbols-outlined text-primary icon-filled">info</span>
                <h3 class="text-label-md text-on-surface">Informasi Penting</h3>
            </div>
            <ul class="space-y-2">
                <li class="flex items-start gap-2 text-body-sm text-on-surface-variant">
                    <span class="material-symbols-outlined text-base text-warning mt-0.5">schedule</span>
                    Batas upload berkas: <strong class="text-on-surface">20 Juli {{ date('Y') }}</strong>
                </li>
                <li class="flex items-start gap-2 text-body-sm text-on-surface-variant">
                    <span class="material-symbols-outlined text-base text-primary mt-0.5">call</span>
                    Helpdesk: <strong class="text-on-surface">(0322) 123-456</strong>
                </li>
            </ul>
        </div>
    </aside>
</div>
@endsection

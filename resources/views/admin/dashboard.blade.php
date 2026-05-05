@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-8 animate-fade-in">
    <h2 class="text-h2 text-on-surface" style="font-size: 28px;">Dashboard Admin PMB</h2>
    <p class="text-body-md text-secondary mt-1">Ringkasan statistik penerimaan mahasiswa baru.</p>
</div>

{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card rounded-2xl animate-fade-in">
        <div class="flex justify-between items-start mb-2">
            <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-xl">group</span>
            </div>
        </div>
        <h3 class="text-h1 text-on-surface" style="font-size: 32px;">{{ $stats['total_pendaftar'] }}</h3>
        <p class="text-label-sm text-on-surface-variant">Total Pendaftar</p>
    </div>
    
    <div class="card rounded-2xl animate-fade-in animate-delay-1">
        <div class="flex justify-between items-start mb-2">
            <div class="w-12 h-12 rounded-xl bg-warning-light flex items-center justify-center">
                <span class="material-symbols-outlined text-warning text-xl">edit_document</span>
            </div>
        </div>
        <h3 class="text-h1 text-on-surface" style="font-size: 32px;">{{ $stats['profil_lengkap'] }}</h3>
        <p class="text-label-sm text-on-surface-variant">Profil Lengkap</p>
    </div>

    <div class="card rounded-2xl animate-fade-in animate-delay-2">
        <div class="flex justify-between items-start mb-2">
            <div class="w-12 h-12 rounded-xl bg-success-light flex items-center justify-center">
                <span class="material-symbols-outlined text-success text-xl">folder_open</span>
            </div>
        </div>
        <h3 class="text-h1 text-on-surface" style="font-size: 32px;">{{ $stats['dokumen_lengkap'] }}</h3>
        <p class="text-label-sm text-on-surface-variant">Dokumen Lengkap</p>
    </div>

    <div class="card rounded-2xl animate-fade-in animate-delay-3">
        <div class="flex justify-between items-start mb-2">
            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-xl">payments</span>
            </div>
        </div>
        <h3 class="text-h1 text-on-surface" style="font-size: 32px;">{{ $stats['sudah_bayar'] }}</h3>
        <p class="text-label-sm text-on-surface-variant">Sudah Bayar</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="card rounded-2xl animate-fade-in animate-delay-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-h3 text-on-surface" style="font-size: 18px;">Pendaftar Terbaru</h3>
                <a href="{{ route('admin.pendaftar.index') }}" class="text-label-sm text-primary hover:underline">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No Pendaftaran</th>
                            <th>Nama Lengkap</th>
                            <th>Prodi</th>
                            <th>Status Kelulusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentPendaftar as $p)
                        <tr>
                            <td>{{ $p->no_pendaftaran }}</td>
                            <td>{{ $p->user->name }}</td>
                            <td><span class="chip chip-info">{{ strtoupper($p->prodi) }}</span></td>
                            <td>
                                @if($p->status_kelulusan == 'lulus')
                                    <span class="chip chip-success">Lulus</span>
                                @elseif($p->status_kelulusan == 'tidak_lulus')
                                    <span class="chip chip-error">Tidak Lulus</span>
                                @else
                                    <span class="chip chip-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="space-y-6">
        <div class="card rounded-2xl animate-fade-in animate-delay-5 bg-surface-low border-primary/20">
            <h3 class="text-h3 text-on-surface mb-2" style="font-size: 18px;">Total Pendapatan</h3>
            <p class="text-body-sm text-on-surface-variant mb-4">Total pembayaran yang valid</p>
            <h2 class="text-h1 text-primary" style="font-size: 36px;">Rp {{ number_format($stats['pendapatan'], 0, ',', '.') }}</h2>
        </div>
        
        <div class="card rounded-2xl animate-fade-in animate-delay-5">
            <h3 class="text-h3 text-on-surface mb-4" style="font-size: 18px;">Lulus Seleksi</h3>
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full border-4 border-success flex items-center justify-center">
                    <span class="text-h3 text-success">{{ $stats['lulus'] }}</span>
                </div>
                <div>
                    <p class="text-label-md text-on-surface">Calon Mahasiswa</p>
                    <p class="text-body-sm text-on-surface-variant">Telah dinyatakan lulus PMB</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

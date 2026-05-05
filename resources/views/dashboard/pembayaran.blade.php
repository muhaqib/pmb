@extends('layouts.dashboard')
@section('title', 'Pembayaran')
@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-body-sm text-on-surface-variant mb-2">
        <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-base">chevron_right</span>
        <span class="text-on-surface">Pembayaran</span>
    </div>
    <h2 class="text-h2 text-on-surface" style="font-size:26px;">Pembayaran</h2>
    <p class="text-body-sm text-on-surface-variant mt-1">Informasi tagihan dan riwayat pembayaran pendaftaran.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Payment Summary --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Active Invoice --}}
        <div class="card rounded-2xl" id="active-invoice">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-h3 text-on-surface" style="font-size:18px;">Tagihan Aktif</h3>
                <span class="chip chip-success">
                    <span class="material-symbols-outlined text-xs icon-filled">check_circle</span> Lunas
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Deskripsi</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <p class="text-label-md text-on-surface">Biaya Pendaftaran</p>
                                    <p class="text-label-sm text-on-surface-variant">Gelombang 1 - {{ date('Y') }}</p>
                                </div>
                            </td>
                            <td class="text-label-md">Rp 250.000</td>
                            <td><span class="chip chip-success">Lunas</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <p class="text-label-md text-on-surface">Biaya Seragam & Atribut</p>
                                    <p class="text-label-sm text-on-surface-variant">Paket Lengkap</p>
                                </div>
                            </td>
                            <td class="text-label-md">Rp 500.000</td>
                            <td><span class="chip chip-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <p class="text-label-md text-on-surface">SPP Semester 1</p>
                                    <p class="text-label-sm text-on-surface-variant">Tahun Akademik {{ date('Y') }}/{{ date('Y')+1 }}</p>
                                </div>
                            </td>
                            <td class="text-label-md">Rp 2.500.000</td>
                            <td><span class="chip chip-info">Belum Bayar</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 pt-4 border-t border-outline-variant/30 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <p class="text-body-sm text-on-surface-variant">Total Tagihan</p>
                    <p class="text-h3 text-primary">Rp 3.250.000</p>
                </div>
                <button class="btn btn-primary" id="btn-bayar">
                    <span class="material-symbols-outlined text-lg">payments</span>
                    Bayar Sekarang
                </button>
            </div>
        </div>

        {{-- Payment History --}}
        <div class="card rounded-2xl" id="payment-history">
            <h3 class="text-h3 text-on-surface mb-6" style="font-size:18px;">Riwayat Pembayaran</h3>
            <div class="space-y-4">
                <div class="flex items-center gap-4 p-4 bg-surface-low rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-success-light flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-success">check_circle</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-label-md text-on-surface">Biaya Pendaftaran</p>
                        <p class="text-label-sm text-on-surface-variant">12 Mei {{ date('Y') }} • Transfer BRI</p>
                    </div>
                    <div class="text-right">
                        <p class="text-label-md text-success">Rp 250.000</p>
                        <p class="text-label-sm text-on-surface-variant">Berhasil</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Payment Info Sidebar --}}
    <div class="space-y-6">
        <div class="gradient-primary text-white p-6 rounded-2xl elevation-2 relative overflow-hidden" id="payment-info">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <h3 class="text-h3 mb-2" style="font-size:18px;color:white;">Metode Pembayaran</h3>
                <p class="text-body-sm text-white/80 mb-5">Pilih salah satu metode berikut:</p>
                <div class="space-y-3">
                    <div class="bg-white/15 backdrop-blur-sm p-3 rounded-xl border border-white/10">
                        <p class="text-label-md" style="color:white;">Transfer Bank</p>
                        <p class="text-label-sm text-white/70">BRI: 0123-4567-8901-234</p>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm p-3 rounded-xl border border-white/10">
                        <p class="text-label-md" style="color:white;">Virtual Account</p>
                        <p class="text-label-sm text-white/70">Tersedia di halaman bayar</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card rounded-2xl" id="payment-guide">
            <div class="flex items-center gap-3 mb-3">
                <span class="material-symbols-outlined text-primary icon-filled">info</span>
                <h3 class="text-label-md text-on-surface">Panduan Pembayaran</h3>
            </div>
            <ol class="space-y-2 text-body-sm text-on-surface-variant list-decimal list-inside">
                <li>Pilih tagihan yang ingin dibayar</li>
                <li>Klik tombol "Bayar Sekarang"</li>
                <li>Pilih metode pembayaran</li>
                <li>Selesaikan pembayaran sebelum batas waktu</li>
                <li>Upload bukti transfer jika manual</li>
            </ol>
        </div>
    </div>
</div>
@endsection

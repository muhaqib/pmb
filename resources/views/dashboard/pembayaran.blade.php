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

@if(session('success'))
    <div class="alert alert-success mb-6 animate-fade-in">
        <span class="material-symbols-outlined text-success mt-0.5 icon-filled">check_circle</span>
        <div>
            <h4 class="text-label-md text-on-surface">Sukses</h4>
            <p class="text-body-sm text-on-surface-variant mt-1">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error mb-6 animate-fade-in bg-error/10 border-error/30 text-error">
        <span class="material-symbols-outlined mt-0.5 icon-filled">error</span>
        <div>
            <h4 class="text-label-md">Terdapat Kesalahan</h4>
            <ul class="list-disc list-inside text-body-sm mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Payment Summary --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Active Invoice --}}
        <div class="card rounded-2xl" id="active-invoice">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-h3 text-on-surface" style="font-size:18px;">Tagihan Aktif</h3>
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
                                    <p class="text-label-sm text-on-surface-variant">Gelombang {{ Auth::user()->pendaftaran->gelombang ?? '1' }} - {{ date('Y') }}</p>
                                </div>
                            </td>
                            <td class="text-label-md">Rp 250.000</td>
                            <td>
                                @php
                                    $pendaftaranBayar = $pembayarans->where('jenis_pembayaran', 'pendaftaran')->first();
                                @endphp
                                @if($pendaftaranBayar)
                                    @if($pendaftaranBayar->status === 'valid')
                                        <span class="chip chip-success">Lunas</span>
                                    @elseif($pendaftaranBayar->status === 'ditolak')
                                        <span class="chip chip-error">Ditolak</span>
                                    @else
                                        <span class="chip chip-warning">Pending</span>
                                    @endif
                                @else
                                    <span class="chip chip-info">Belum Bayar</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 pt-4 border-t border-outline-variant/30">
                @if(!$pendaftaranBayar || $pendaftaranBayar->status === 'ditolak')
                <form action="{{ route('dashboard.pembayaran.upload') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    @csrf
                    <div>
                        <p class="text-body-sm text-on-surface-variant mb-2">Upload Bukti Transfer (PDF/JPG, Maks 2MB)</p>
                        <input type="file" name="file" class="form-input text-sm p-1" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-bayar">
                        <span class="material-symbols-outlined text-lg">upload</span>
                        Upload Bukti
                    </button>
                </form>
                @else
                <div class="flex items-center gap-2 text-success">
                    <span class="material-symbols-outlined icon-filled">check_circle</span>
                    <span class="text-label-md">Bukti pembayaran telah diunggah.</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Payment History --}}
        <div class="card rounded-2xl" id="payment-history">
            <h3 class="text-h3 text-on-surface mb-6" style="font-size:18px;">Riwayat Pembayaran</h3>
            <div class="space-y-4">
                @forelse($pembayarans as $bayar)
                <div class="flex items-center gap-4 p-4 bg-surface-low rounded-xl">
                    <div class="w-10 h-10 rounded-full {{ $bayar->status === 'valid' ? 'bg-success-light' : ($bayar->status === 'ditolak' ? 'bg-error-light' : 'bg-warning-light') }} flex items-center justify-center shrink-0">
                        @if($bayar->status === 'valid')
                            <span class="material-symbols-outlined text-success">check_circle</span>
                        @elseif($bayar->status === 'ditolak')
                            <span class="material-symbols-outlined text-error">cancel</span>
                        @else
                            <span class="material-symbols-outlined text-warning">schedule</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-label-md text-on-surface uppercase">{{ str_replace('_', ' ', $bayar->jenis_pembayaran) }}</p>
                        <p class="text-label-sm text-on-surface-variant">{{ $bayar->updated_at->format('d M Y') }} • Upload Bukti</p>
                    </div>
                    <div class="text-right">
                        <p class="text-label-md {{ $bayar->status === 'valid' ? 'text-success' : 'text-on-surface' }}">Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}</p>
                        <p class="text-label-sm text-on-surface-variant capitalize">{{ $bayar->status }}</p>
                    </div>
                </div>
                @empty
                <p class="text-body-sm text-on-surface-variant">Belum ada riwayat pembayaran.</p>
                @endforelse
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
                        <p class="text-label-sm text-white/70">A.N. STIT Mambaul Hikmah</p>
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
                <li>Lakukan transfer sesuai nominal tagihan</li>
                <li>Simpan bukti transfer dalam bentuk foto/PDF</li>
                <li>Upload bukti transfer pada form di samping</li>
                <li>Tunggu verifikasi admin maksimal 2x24 jam</li>
            </ol>
        </div>
    </div>
</div>
@endsection

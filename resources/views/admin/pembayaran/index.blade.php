@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="mb-8 animate-fade-in flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-h2 text-on-surface" style="font-size: 28px;">Verifikasi Pembayaran</h2>
        <p class="text-body-md text-secondary mt-1">Kelola dan verifikasi bukti transfer pembayaran dari pendaftar.</p>
    </div>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="card rounded-2xl p-5 border border-outline-variant/30 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
        </div>
        <div>
            <p class="text-label-sm text-on-surface-variant">Total Pembayaran</p>
            <p class="text-h2 text-on-surface font-bold">{{ $stats['total'] }}</p>
        </div>
    </div>
    
    <div class="card rounded-2xl p-5 border border-warning/30 bg-warning/5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-warning/20 text-warning flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-2xl">hourglass_top</span>
        </div>
        <div>
            <p class="text-label-sm text-on-surface-variant">Perlu Verifikasi (Pending)</p>
            <p class="text-h2 text-warning font-bold">{{ $stats['pending'] }}</p>
        </div>
    </div>
    
    <div class="card rounded-2xl p-5 border border-success/30 bg-success/5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-success/20 text-success flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-2xl">verified</span>
        </div>
        <div>
            <p class="text-label-sm text-on-surface-variant">Valid (Disetujui)</p>
            <p class="text-h2 text-success font-bold">{{ $stats['valid'] }}</p>
        </div>
    </div>
    
    <div class="card rounded-2xl p-5 border border-error/30 bg-error/5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-error/20 text-error flex items-center justify-center shrink-0">
            <span class="material-symbols-outlined text-2xl">cancel</span>
        </div>
        <div>
            <p class="text-label-sm text-on-surface-variant">Ditolak</p>
            <p class="text-h2 text-error font-bold">{{ $stats['ditolak'] }}</p>
        </div>
    </div>
</div>

<div class="card rounded-2xl animate-fade-in">
    {{-- Filters --}}
    <form action="{{ route('admin.pembayaran.index') }}" method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 bg-surface-low p-4 rounded-xl">
        <div>
            <label class="text-label-sm text-on-surface-variant block mb-1">Cari Nama/NIK/No.Daftar</label>
            <input type="text" name="search" class="form-input text-sm" placeholder="Ketik kata kunci..." value="{{ request('search') }}">
        </div>
        <div>
            <label class="text-label-sm text-on-surface-variant block mb-1">Status Verifikasi</label>
            <select name="status" class="form-input form-select text-sm">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending (Perlu Verifikasi)</option>
                <option value="valid" {{ request('status') == 'valid' ? 'selected' : '' }}>Valid</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="belum_bayar" {{ request('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
            </select>
        </div>
        <div>
            <label class="text-label-sm text-on-surface-variant block mb-1">Jenis Pembayaran</label>
            <select name="jenis" class="form-input form-select text-sm">
                <option value="">Semua Jenis</option>
                <option value="pendaftaran" {{ request('jenis') == 'pendaftaran' ? 'selected' : '' }}>Biaya Pendaftaran</option>
                <option value="spp" {{ request('jenis') == 'spp' ? 'selected' : '' }}>SPP / Perkuliahan</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn btn-primary w-full h-[42px]">
                <span class="material-symbols-outlined">search</span> Cari
            </button>
        </div>
    </form>

    {{-- Payments Table --}}
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Pendaftar & No.Reg</th>
                    <th>Jenis Pembayaran</th>
                    <th>Jumlah</th>
                    <th>Bukti Transfer</th>
                    <th>Status Saat Ini</th>
                    <th class="text-center">Aksi Cepat Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembayarans as $bayar)
                <tr>
                    <td>
                        <p class="text-label-md text-on-surface font-bold">{{ $bayar->user->name ?? 'User Terhapus' }}</p>
                        <p class="text-label-sm text-primary">{{ $bayar->user->pendaftaran->no_pendaftaran ?? '-' }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $bayar->user->no_hp ?? '-' }}</p>
                    </td>
                    <td>
                        <span class="chip chip-secondary text-xs uppercase">
                            {{ str_replace('_', ' ', $bayar->jenis_pembayaran) }}
                        </span>
                    </td>
                    <td>
                        <span class="font-bold text-on-surface text-sm">
                            Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}
                        </span>
                    </td>
                    <td>
                        @if($bayar->bukti_path)
                            <a href="{{ asset($bayar->bukti_path) }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-primary font-medium hover:underline bg-primary/10 px-2.5 py-1.5 rounded-lg border border-primary/20">
                                <span class="material-symbols-outlined text-base">visibility</span> Lihat Bukti
                            </a>
                        @else
                            <span class="text-xs text-on-surface-variant italic">Belum Upload</span>
                        @endif
                    </td>
                    <td>
                        @if($bayar->status == 'valid')
                            <span class="chip chip-success">Valid</span>
                        @elseif($bayar->status == 'ditolak')
                            <span class="chip chip-error">Ditolak</span>
                        @elseif($bayar->status == 'pending')
                            <span class="chip chip-warning">Pending</span>
                        @else
                            <span class="chip chip-info">Belum Bayar</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Quick 1-Click Valid Button --}}
                            @if($bayar->status !== 'valid')
                                <form action="{{ route('admin.pembayaran.update-status', $bayar->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <input type="hidden" name="status" value="valid">
                                    <button type="submit" class="btn btn-sm btn-primary bg-emerald-600 hover:bg-emerald-500 text-white border-none shadow-sm flex items-center gap-1" title="Setujui dan ubah status menjadi Valid">
                                        <span class="material-symbols-outlined text-sm">check_circle</span>
                                        Set Valid
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs text-emerald-700 bg-emerald-100 px-2.5 py-1 rounded-full font-semibold">
                                    <span class="material-symbols-outlined text-sm">done_all</span> Terverifikasi
                                </span>
                            @endif

                            {{-- Status Change Dropdown / Action Form --}}
                            <form action="{{ route('admin.pembayaran.update-status', $bayar->id) }}" method="POST" class="inline-block">
                                @csrf
                                <select name="status" class="form-input form-select text-xs py-1.5 px-2 bg-surface-lowest border-outline-variant rounded-lg" onchange="this.form.submit()">
                                    <option value="" disabled selected>Ubah...</option>
                                    <option value="valid" {{ $bayar->status == 'valid' ? 'selected' : '' }}>Valid</option>
                                    <option value="pending" {{ $bayar->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ditolak" {{ $bayar->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </form>

                            @if($bayar->user && $bayar->user->pendaftaran)
                                <a href="{{ route('admin.pendaftar.show', $bayar->user->pendaftaran->id) }}" class="btn btn-sm btn-secondary text-xs" title="Lihat Detail Pendaftar">
                                    <span class="material-symbols-outlined text-sm">person</span>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-on-surface-variant">Tidak ada data pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $pembayarans->links() }}
    </div>
</div>
@endsection

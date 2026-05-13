@extends('layouts.admin')

@section('title', 'Data Pendaftar')

@section('content')
<div class="mb-8 animate-fade-in flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-h2 text-on-surface" style="font-size: 28px;">Data Pendaftar</h2>
        <p class="text-body-md text-secondary mt-1">Kelola data calon mahasiswa baru.</p>
    </div>
    <div>
        <a href="{{ route('admin.pendaftar.export', request()->all()) }}" class="btn btn-primary bg-success hover:bg-success-light border-none">
            <span class="material-symbols-outlined">download</span> Unduh Data
        </a>
    </div>
</div>

<div class="card rounded-2xl animate-fade-in">
    {{-- Filters --}}
    <form action="{{ route('admin.pendaftar.index') }}" method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 bg-surface-low p-4 rounded-xl">
        <div>
            <label class="text-label-sm text-on-surface-variant block mb-1">Cari Nama/NIK/No.Daftar</label>
            <input type="text" name="search" class="form-input text-sm" placeholder="Ketik kata kunci..." value="{{ request('search') }}">
        </div>
        <div>
            <label class="text-label-sm text-on-surface-variant block mb-1">Program Studi</label>
            <select name="prodi" class="form-input form-select text-sm">
                <option value="">Semua Prodi</option>
                <option value="pai" {{ request('prodi') == 'pai' ? 'selected' : '' }}>PAI</option>
                <option value="pba" {{ request('prodi') == 'pba' ? 'selected' : '' }}>PBA</option>
            </select>
        </div>
        <div>
            <label class="text-label-sm text-on-surface-variant block mb-1">Status Kelulusan</label>
            <select name="status_kelulusan" class="form-input form-select text-sm">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status_kelulusan') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="lulus" {{ request('status_kelulusan') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                <option value="tidak_lulus" {{ request('status_kelulusan') == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
            </select>
        </div>
        <div>
            <label class="text-label-sm text-on-surface-variant block mb-1">Kategori</label>
            <select name="kategori" class="form-input form-select text-sm">
                <option value="">Semua Kategori</option>
                <option value="umum" {{ request('kategori') == 'umum' ? 'selected' : '' }}>Umum</option>
                <option value="santri" {{ request('kategori') == 'santri' ? 'selected' : '' }}>Santri</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn btn-primary w-full h-[42px]">
                <span class="material-symbols-outlined">search</span> Cari
            </button>
        </div>
    </form>

    {{-- Data Table --}}
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No Pendaftaran</th>
                    <th>Nama & NIK</th>
                    <th>Prodi</th>
                    <th>Status Berkas</th>
                    <th>Status Kelulusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftar as $p)
                <tr>
                    <td class="font-bold text-primary">{{ $p->no_pendaftaran }}</td>
                    <td>
                        <p class="text-label-md text-on-surface">{{ $p->user->name }}</p>
                        <p class="text-label-sm text-on-surface-variant">{{ $p->user->nik ?? '-' }}</p>
                    </td>
                    <td><span class="chip chip-info">{{ strtoupper($p->prodi) }}</span></td>
                    <td>
                        <div class="flex gap-1">
                            <span class="material-symbols-outlined text-sm {{ $p->is_profile_complete ? 'text-success icon-filled' : 'text-outline-variant' }}" title="Profil">person</span>
                            <span class="material-symbols-outlined text-sm {{ $p->is_document_uploaded ? 'text-success icon-filled' : 'text-outline-variant' }}" title="Dokumen">folder</span>
                            <span class="material-symbols-outlined text-sm {{ $p->is_payment_uploaded ? 'text-success icon-filled' : 'text-outline-variant' }}" title="Pembayaran">payments</span>
                        </div>
                    </td>
                    <td>
                        @if($p->status_kelulusan == 'lulus')
                            <span class="chip chip-success">Lulus</span>
                        @elseif($p->status_kelulusan == 'tidak_lulus')
                            <span class="chip chip-error">Tidak Lulus</span>
                        @else
                            <span class="chip chip-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.pendaftar.show', $p->id) }}" class="btn btn-sm btn-secondary text-xs">
                            <span class="material-symbols-outlined text-sm">visibility</span> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-on-surface-variant">Tidak ada data pendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $pendaftar->links() }}
    </div>
</div>
@endsection

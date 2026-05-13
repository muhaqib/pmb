@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="mb-8 animate-fade-in flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <div class="flex items-center gap-2 text-body-sm text-on-surface-variant mb-2">
            <a href="{{ route('admin.pendaftar.index') }}" class="hover:text-primary transition-colors">Data Pendaftar</a>
            <span class="material-symbols-outlined text-base">chevron_right</span>
            <span class="text-on-surface">{{ $pendaftaran->no_pendaftaran }}</span>
        </div>
        <h2 class="text-h2 text-on-surface" style="font-size: 28px;">Detail Pendaftar</h2>
    </div>
    
    <div class="flex gap-2">
        <a href="{{ route('admin.pendaftar.edit', $pendaftaran->id) }}" class="btn btn-secondary">
            <span class="material-symbols-outlined text-base">edit</span> Edit Data
        </a>
        <form action="{{ route('admin.pendaftar.kelulusan', $pendaftaran->id) }}" method="POST" class="inline-block">
            @csrf
            <input type="hidden" name="status_kelulusan" value="lulus">
            <button type="submit" class="btn btn-primary bg-success hover:bg-success-light hover:text-success border-none" onclick="return confirm('Nyatakan LULUS untuk pendaftar ini?')">
                <span class="material-symbols-outlined text-base">verified</span> Nyatakan Lulus
            </button>
        </form>
        <form action="{{ route('admin.pendaftar.kelulusan', $pendaftaran->id) }}" method="POST" class="inline-block">
            @csrf
            <input type="hidden" name="status_kelulusan" value="tidak_lulus">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Nyatakan TIDAK LULUS untuk pendaftar ini?')">
                <span class="material-symbols-outlined text-base">cancel</span> Tidak Lulus
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left Col: Profil & Biodata --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="card rounded-2xl animate-fade-in">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-primary text-3xl">person</span>
                </div>
                <div>
                    <h3 class="text-h3 text-on-surface" style="font-size: 20px;">{{ $pendaftaran->user->name }}</h3>
                    <p class="text-body-sm text-on-surface-variant">
                        {{ $pendaftaran->user->email }} | {{ $pendaftaran->user->no_hp }} | 
                        <span class="chip chip-secondary text-[10px] uppercase">{{ $pendaftaran->user->kategori ?? 'umum' }}</span>
                    </p>
                </div>
                <div class="ml-auto text-right">
                    <p class="text-label-sm text-on-surface-variant">No. Pendaftaran</p>
                    <p class="text-label-md text-primary">{{ $pendaftaran->no_pendaftaran }}</p>
                </div>
            </div>
            
            <hr class="border-outline-variant/30 my-4">
            
            <h4 class="text-label-md text-primary mb-3">Biodata Pribadi</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                <div>
                    <p class="text-label-sm text-on-surface-variant">NIK</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->nik ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Tempat, Tanggal Lahir</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->tempat_lahir ?? '-' }}, {{ $pendaftaran->user->biodata->tanggal_lahir ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Jenis Kelamin</p>
                    <p class="text-body-sm text-on-surface">{{ ($pendaftaran->user->biodata->jenis_kelamin ?? '') == 'L' ? 'Laki-laki' : (($pendaftaran->user->biodata->jenis_kelamin ?? '') == 'P' ? 'Perempuan' : '-') }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Agama</p>
                    <p class="text-body-sm text-on-surface capitalize">{{ $pendaftaran->user->biodata->agama ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-label-sm text-on-surface-variant">Alamat Lengkap</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->alamat ?? '-' }}</p>
                </div>
            </div>
            
            <hr class="border-outline-variant/30 my-4">
            
            <h4 class="text-label-md text-primary mb-3">Data Orang Tua / Wali</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                <div>
                    <p class="text-label-sm text-on-surface-variant">Nama Ayah</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->nama_ayah ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Pekerjaan Ayah</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->pekerjaan_ayah ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Nama Ibu</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->nama_ibu ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Pekerjaan Ibu</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->pekerjaan_ibu ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Nama Wali</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->nama_wali ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Pekerjaan Wali</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->pekerjaan_wali ?? '-' }}</p>
                </div>
            </div>
            
            <hr class="border-outline-variant/30 my-4">
            
            <h4 class="text-label-md text-primary mb-3">Pendidikan Terakhir</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                <div>
                    <p class="text-label-sm text-on-surface-variant">Jenjang</p>
                    <p class="text-body-sm text-on-surface uppercase">{{ $pendaftaran->user->biodata->jenjang_pendidikan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Nama Sekolah</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->nama_sekolah ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">Tahun Lulus</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->tahun_lulus ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-label-sm text-on-surface-variant">NISN</p>
                    <p class="text-body-sm text-on-surface">{{ $pendaftaran->user->biodata->nisn ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Dokumen --}}
        <div class="card rounded-2xl animate-fade-in animate-delay-1">
            <h3 class="text-h3 text-on-surface mb-4" style="font-size: 18px;">Dokumen Pendaftaran</h3>
            
            <div class="space-y-4">
                @forelse($pendaftaran->user->dokumens as $dokumen)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 border border-outline-variant/30 rounded-xl bg-surface-lowest">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-outline text-3xl">description</span>
                        <div>
                            <p class="text-label-md text-on-surface uppercase">{{ $dokumen->jenis_dokumen }}</p>
                            <p class="text-label-sm text-on-surface-variant">{{ $dokumen->file_name }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="{{ asset($dokumen->file_path) }}" target="_blank" class="btn btn-sm btn-secondary" title="Lihat Dokumen">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                        </a>
                        
                        <form action="{{ route('admin.dokumen.verifikasi', $dokumen->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            <select name="status" class="form-input form-select text-xs py-1" onchange="this.form.submit()">
                                <option value="pending" {{ $dokumen->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="valid" {{ $dokumen->status == 'valid' ? 'selected' : '' }}>Valid</option>
                                <option value="ditolak" {{ $dokumen->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </div>
                </div>
                @empty
                <p class="text-body-sm text-on-surface-variant">Belum ada dokumen yang diunggah.</p>
                @endforelse
            </div>
        </div>
    </div>
    
    {{-- Right Col: Status & Pembayaran --}}
    <div class="space-y-6">
        <div class="card rounded-2xl animate-fade-in animate-delay-2 bg-surface-low border-primary/20">
            <h3 class="text-label-md text-on-surface mb-4">Status Pendaftaran</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center pb-2 border-b border-outline-variant/30">
                    <span class="text-body-sm text-on-surface-variant">Profil</span>
                    @if($pendaftaran->is_profile_complete)
                        <span class="material-symbols-outlined text-success icon-filled text-lg">check_circle</span>
                    @else
                        <span class="material-symbols-outlined text-error icon-filled text-lg">cancel</span>
                    @endif
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-outline-variant/30">
                    <span class="text-body-sm text-on-surface-variant">Upload Dokumen</span>
                    @if($pendaftaran->is_document_uploaded)
                        <span class="material-symbols-outlined text-success icon-filled text-lg">check_circle</span>
                    @else
                        <span class="material-symbols-outlined text-error icon-filled text-lg">cancel</span>
                    @endif
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-outline-variant/30">
                    <span class="text-body-sm text-on-surface-variant">Pembayaran</span>
                    @if($pendaftaran->is_payment_uploaded)
                        <span class="material-symbols-outlined text-success icon-filled text-lg">check_circle</span>
                    @else
                        <span class="material-symbols-outlined text-error icon-filled text-lg">cancel</span>
                    @endif
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="text-label-md text-on-surface">Status Kelulusan</span>
                    @if($pendaftaran->status_kelulusan == 'lulus')
                        <span class="chip chip-success">Lulus</span>
                    @elseif($pendaftaran->status_kelulusan == 'tidak_lulus')
                        <span class="chip chip-error">Tidak Lulus</span>
                    @else
                        <span class="chip chip-warning">Pending</span>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card rounded-2xl animate-fade-in animate-delay-3">
            <h3 class="text-h3 text-on-surface mb-4" style="font-size: 18px;">Verifikasi Pembayaran</h3>
            
            <div class="space-y-4">
                @forelse($pendaftaran->user->pembayarans as $bayar)
                <div class="border border-outline-variant/30 rounded-xl p-4 bg-surface-lowest">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-label-md text-on-surface uppercase">{{ str_replace('_', ' ', $bayar->jenis_pembayaran) }}</p>
                            <p class="text-body-sm text-primary font-bold mt-1">Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}</p>
                        </div>
                        <span class="chip {{ $bayar->status == 'valid' ? 'chip-success' : ($bayar->status == 'ditolak' ? 'chip-error' : 'chip-warning') }} text-[10px]">
                            {{ strtoupper($bayar->status) }}
                        </span>
                    </div>
                    
                    @if($bayar->bukti_path)
                    <div class="mt-3 flex items-center justify-between gap-2 border-t border-outline-variant/30 pt-3">
                        <a href="{{ asset($bayar->bukti_path) }}" target="_blank" class="text-label-sm text-primary hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">visibility</span> Bukti Transfer
                        </a>
                        
                        <form action="{{ route('admin.pembayaran.verifikasi', $bayar->id) }}" method="POST">
                            @csrf
                            <select name="status" class="form-input form-select text-xs py-1" onchange="this.form.submit()">
                                <option value="pending" {{ $bayar->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="valid" {{ $bayar->status == 'valid' ? 'selected' : '' }}>Valid</option>
                                <option value="ditolak" {{ $bayar->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </div>
                    @else
                    <p class="text-label-sm text-error mt-2">Belum upload bukti transfer.</p>
                    @endif
                </div>
                @empty
                <p class="text-body-sm text-on-surface-variant">Belum ada riwayat pembayaran.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

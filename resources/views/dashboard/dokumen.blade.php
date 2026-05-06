@extends('layouts.dashboard')
@section('title', 'Upload Dokumen')
@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-body-sm text-on-surface-variant mb-2">
        <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-base">chevron_right</span>
        <span class="text-on-surface">Upload Dokumen</span>
    </div>
    <h2 class="text-h2 text-on-surface" style="font-size:26px;">Upload Dokumen</h2>
    <p class="text-body-sm text-on-surface-variant mt-1">Upload berkas persyaratan dalam format PDF/JPG (maks. 2MB).</p>
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

<div class="alert alert-warning mb-6">
    <span class="material-symbols-outlined text-warning mt-0.5">warning</span>
    <div>
        <h4 class="text-label-md text-on-surface">Perhatian</h4>
        <p class="text-body-sm text-on-surface-variant mt-1">Pastikan dokumen terlihat jelas dan tidak terpotong.</p>
    </div>
</div>

@php
$docTypes = [
    'ktp' => ['icon'=>'id_card','title'=>'KTP','sub'=>'Wajib'],
    'ijazah' => ['icon'=>'history_edu','title'=>'Ijazah / SKL','sub'=>'Wajib'],
    'foto' => ['icon'=>'photo_camera','title'=>'Pas Foto 3x4','sub'=>'Wajib'],
    'kk' => ['icon'=>'family_restroom','title'=>'Kartu Keluarga','sub'=>'Wajib'],
    'sehat' => ['icon'=>'medical_information','title'=>'Surat Ket. Sehat','sub'=>'Opsional'],
    'prestasi' => ['icon'=>'emoji_events','title'=>'Sertifikat Prestasi','sub'=>'Opsional'],
];
$wajibCount = 4;
$uploadedWajib = 0;
foreach(['ktp', 'ijazah', 'foto', 'kk'] as $w) {
    if(isset($dokumens[$w])) $uploadedWajib++;
}
$progress = ($uploadedWajib / $wajibCount) * 100;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    @foreach($docTypes as $key => $meta)
    @php
        $doc = $dokumens[$key] ?? null;
    @endphp
    <div class="card rounded-2xl">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-xl">{{ $meta['icon'] }}</span>
                </div>
                <div>
                    <h4 class="text-label-md text-on-surface">{{ $meta['title'] }}</h4>
                    <p class="text-label-sm text-on-surface-variant">{{ $meta['sub'] }}</p>
                </div>
            </div>
            @if($doc)
                @if($doc->status === 'valid')
                    <span class="chip chip-success"><span class="material-symbols-outlined text-xs icon-filled">check_circle</span> Terverifikasi</span>
                @elseif($doc->status === 'ditolak')
                    <span class="chip chip-error"><span class="material-symbols-outlined text-xs">cancel</span> Ditolak</span>
                @else
                    <span class="chip chip-warning"><span class="material-symbols-outlined text-xs">schedule</span> Menunggu</span>
                @endif
            @else
                <span class="chip chip-info"><span class="material-symbols-outlined text-xs">upload</span> Belum Upload</span>
            @endif
        </div>

        @if($doc && $doc->status !== 'ditolak')
        <div class="border-2 border-dashed {{ $doc->status==='valid' ? 'border-success/30 bg-success-light/30' : 'border-outline-variant' }} rounded-xl p-4 flex items-center gap-4">
            <span class="material-symbols-outlined {{ $doc->status==='valid' ? 'text-success' : 'text-outline' }} text-3xl">description</span>
            <div class="flex-1 min-w-0">
                <p class="text-body-sm text-on-surface truncate">{{ $doc->file_name }}</p>
                <p class="text-label-sm text-on-surface-variant">Diunggah pada {{ $doc->updated_at->format('d M Y') }}</p>
            </div>
            @if($doc->status !== 'valid')
            <form action="{{ route('dashboard.dokumen.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="jenis_dokumen" value="{{ $key }}">
                <label class="btn btn-ghost btn-sm text-primary cursor-pointer">
                    <span class="material-symbols-outlined text-lg">refresh</span> Ganti
                    <input type="file" name="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" onchange="this.form.submit()">
                </label>
            </form>
            @endif
        </div>
        @else
        <form action="{{ route('dashboard.dokumen.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jenis_dokumen" value="{{ $key }}">
            <label class="border-2 border-dashed border-primary/30 rounded-xl p-8 flex flex-col items-center gap-3 text-center cursor-pointer hover:bg-primary-fixed/20 hover:border-primary/50 transition-all">
                <div class="w-14 h-14 rounded-full bg-primary-fixed flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-2xl">cloud_upload</span>
                </div>
                <p class="text-label-md text-primary">{{ $doc && $doc->status === 'ditolak' ? 'Upload Ulang Dokumen' : 'Klik untuk upload' }}</p>
                <p class="text-label-sm text-on-surface-variant">PDF atau JPG, maks. 2MB</p>
                <input type="file" name="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png" onchange="this.form.submit()">
            </label>
        </form>
        @endif
    </div>
    @endforeach
</div>

<div class="mt-8 card rounded-2xl bg-surface-low border-primary/10">
    <div class="flex items-center justify-between">
        <div>
            <h4 class="text-label-md text-on-surface">Status Kelengkapan Berkas</h4>
            <p class="text-body-sm text-on-surface-variant mt-1">{{ $uploadedWajib }} dari {{ $wajibCount }} dokumen wajib telah diunggah</p>
        </div>
        <p class="text-h3 text-primary" style="font-size:24px;">{{ $progress }}%</p>
    </div>
    <div class="mt-4 w-full h-2 bg-surface-high rounded-full overflow-hidden">
        <div class="h-full gradient-primary rounded-full" style="width:{{ $progress }}%;"></div>
    </div>
</div>
@endsection

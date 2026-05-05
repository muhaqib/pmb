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

<div class="alert alert-warning mb-6">
    <span class="material-symbols-outlined text-warning mt-0.5">warning</span>
    <div>
        <h4 class="text-label-md text-on-surface">Perhatian</h4>
        <p class="text-body-sm text-on-surface-variant mt-1">Pastikan dokumen terlihat jelas dan tidak terpotong.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    @foreach([
        ['icon'=>'id_card','title'=>'KTP','sub'=>'Wajib','status'=>'verified','file'=>'KTP_Rian.pdf','size'=>'1.2 MB'],
        ['icon'=>'history_edu','title'=>'Ijazah / SKL','sub'=>'Wajib','status'=>'waiting','file'=>'Ijazah_2024.pdf','size'=>'800 KB'],
        ['icon'=>'photo_camera','title'=>'Pas Foto 3x4','sub'=>'Wajib','status'=>'verified','file'=>'Foto_3x4.jpg','size'=>'500 KB'],
        ['icon'=>'family_restroom','title'=>'Kartu Keluarga','sub'=>'Wajib','status'=>'upload','file'=>'','size'=>''],
        ['icon'=>'medical_information','title'=>'Surat Ket. Sehat','sub'=>'Opsional','status'=>'upload','file'=>'','size'=>''],
        ['icon'=>'emoji_events','title'=>'Sertifikat Prestasi','sub'=>'Opsional','status'=>'upload','file'=>'','size'=>'']
    ] as $doc)
    <div class="card rounded-2xl">
        <div class="flex items-start justify-between mb-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-xl">{{ $doc['icon'] }}</span>
                </div>
                <div>
                    <h4 class="text-label-md text-on-surface">{{ $doc['title'] }}</h4>
                    <p class="text-label-sm text-on-surface-variant">{{ $doc['sub'] }}</p>
                </div>
            </div>
            @if($doc['status']==='verified')
                <span class="chip chip-success"><span class="material-symbols-outlined text-xs icon-filled">check_circle</span> Terverifikasi</span>
            @elseif($doc['status']==='waiting')
                <span class="chip chip-warning"><span class="material-symbols-outlined text-xs">schedule</span> Menunggu</span>
            @else
                <span class="chip chip-info"><span class="material-symbols-outlined text-xs">upload</span> Belum Upload</span>
            @endif
        </div>

        @if($doc['file'])
        <div class="border-2 border-dashed {{ $doc['status']==='verified' ? 'border-success/30 bg-success-light/30' : 'border-outline-variant' }} rounded-xl p-4 flex items-center gap-4">
            <span class="material-symbols-outlined {{ $doc['status']==='verified' ? 'text-success' : 'text-outline' }} text-3xl">description</span>
            <div class="flex-1 min-w-0">
                <p class="text-body-sm text-on-surface truncate">{{ $doc['file'] }}</p>
                <p class="text-label-sm text-on-surface-variant">{{ $doc['size'] }}</p>
            </div>
            <button class="btn btn-ghost btn-sm text-primary"><span class="material-symbols-outlined text-lg">refresh</span> Ganti</button>
        </div>
        @else
        <label class="border-2 border-dashed border-primary/30 rounded-xl p-8 flex flex-col items-center gap-3 text-center cursor-pointer hover:bg-primary-fixed/20 hover:border-primary/50 transition-all">
            <div class="w-14 h-14 rounded-full bg-primary-fixed flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-2xl">cloud_upload</span>
            </div>
            <p class="text-label-md text-primary">Klik untuk upload</p>
            <p class="text-label-sm text-on-surface-variant">PDF atau JPG, maks. 2MB</p>
            <input type="file" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
        </label>
        @endif
    </div>
    @endforeach
</div>

<div class="mt-8 card rounded-2xl bg-surface-low border-primary/10">
    <div class="flex items-center justify-between">
        <div>
            <h4 class="text-label-md text-on-surface">Status Kelengkapan Berkas</h4>
            <p class="text-body-sm text-on-surface-variant mt-1">3 dari 4 dokumen wajib telah diunggah</p>
        </div>
        <p class="text-h3 text-primary" style="font-size:24px;">75%</p>
    </div>
    <div class="mt-4 w-full h-2 bg-surface-high rounded-full overflow-hidden">
        <div class="h-full gradient-primary rounded-full" style="width:75%;"></div>
    </div>
</div>
@endsection

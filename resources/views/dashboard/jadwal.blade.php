@extends('layouts.dashboard')
@section('title', 'Kalender Akademik')
@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-body-sm text-on-surface-variant mb-2">
        <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-base">chevron_right</span>
        <span class="text-on-surface">Kalender Akademik</span>
    </div>
    <h2 class="text-h2 text-on-surface" style="font-size:26px;">Kalender Akademik</h2>
    <p class="text-body-sm text-on-surface-variant mt-1">Jadwal penting terkait penerimaan mahasiswa baru dan kegiatan akademik.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-4">
        <h3 class="text-h3 text-on-surface" style="font-size:18px;">Timeline PMB {{ date('Y') }}/{{ date('Y')+1 }}</h3>

        @foreach([
            ['month'=>'Januari','items'=>[['title'=>'Pembukaan Pendaftaran Gelombang 1','date'=>'2 Januari','status'=>'done'],['title'=>'Sosialisasi PMB ke Sekolah','date'=>'10-20 Januari','status'=>'done']]],
            ['month'=>'Maret','items'=>[['title'=>'Batas Akhir Pendaftaran Gel. 1','date'=>'31 Maret','status'=>'done']]],
            ['month'=>'April','items'=>[['title'=>'Pembukaan Pendaftaran Gelombang 2','date'=>'1 April','status'=>'active']]],
            ['month'=>'Juni','items'=>[['title'=>'Batas Akhir Pendaftaran Gel. 2','date'=>'30 Juni','status'=>'upcoming']]],
            ['month'=>'Juli','items'=>[['title'=>'Tes Seleksi','date'=>'15-20 Juli','status'=>'upcoming'],['title'=>'Pengumuman Hasil','date'=>'25 Juli','status'=>'upcoming'],['title'=>'Daftar Ulang','date'=>'26-31 Juli','status'=>'upcoming']]],
            ['month'=>'Agustus','items'=>[['title'=>'Orientasi Mahasiswa Baru','date'=>'5-7 Agustus','status'=>'upcoming'],['title'=>'Perkuliahan Dimulai','date'=>'12 Agustus','status'=>'upcoming']]]
        ] as $group)
        <div class="card rounded-2xl">
            <h4 class="text-label-md text-primary mb-4">{{ $group['month'] }} {{ date('Y') }}</h4>
            <div class="space-y-3">
                @foreach($group['items'] as $event)
                <div class="flex items-start gap-3">
                    @if($event['status']==='done')
                        <span class="material-symbols-outlined text-success icon-filled mt-0.5">check_circle</span>
                    @elseif($event['status']==='active')
                        <span class="material-symbols-outlined text-primary icon-filled mt-0.5 animate-pulse-glow" style="border-radius:50%;">radio_button_checked</span>
                    @else
                        <span class="material-symbols-outlined text-outline-variant mt-0.5">circle</span>
                    @endif
                    <div>
                        <p class="text-label-md text-on-surface">{{ $event['title'] }}</p>
                        <p class="text-label-sm text-on-surface-variant">{{ $event['date'] }} {{ date('Y') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">
        <div class="gradient-primary text-white p-6 rounded-2xl elevation-2 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <h3 class="text-h3 mb-2" style="font-size:18px;color:white;">Countdown</h3>
                <p class="text-body-sm text-white/80 mb-4">Tes Seleksi Gelombang 1</p>
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white/15 backdrop-blur-sm p-3 rounded-xl text-center border border-white/10">
                        <p class="text-h2" style="color:white;font-size:28px;" id="countdown-days">70</p>
                        <p class="text-label-sm text-white/70">Hari</p>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm p-3 rounded-xl text-center border border-white/10">
                        <p class="text-h2" style="color:white;font-size:28px;" id="countdown-hours">12</p>
                        <p class="text-label-sm text-white/70">Jam</p>
                    </div>
                    <div class="bg-white/15 backdrop-blur-sm p-3 rounded-xl text-center border border-white/10">
                        <p class="text-h2" style="color:white;font-size:28px;" id="countdown-mins">45</p>
                        <p class="text-label-sm text-white/70">Menit</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card rounded-2xl">
            <div class="flex items-center gap-3 mb-3">
                <span class="material-symbols-outlined text-primary icon-filled">info</span>
                <h3 class="text-label-md text-on-surface">Catatan Penting</h3>
            </div>
            <ul class="space-y-2 text-body-sm text-on-surface-variant">
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-base text-warning mt-0.5">priority_high</span>Hadir 30 menit sebelum tes</li>
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-base text-primary mt-0.5">badge</span>Bawa KTP asli dan kartu peserta</li>
                <li class="flex items-start gap-2"><span class="material-symbols-outlined text-base text-success mt-0.5">checkroom</span>Pakaian rapi dan sopan</li>
            </ul>
        </div>
    </div>
</div>
@endsection

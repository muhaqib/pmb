@extends('layouts.dashboard')
@section('title', 'Pengumuman')
@section('content')
<div class="mb-8">
    <div class="flex items-center gap-2 text-body-sm text-on-surface-variant mb-2">
        <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-base">chevron_right</span>
        <span class="text-on-surface">Pengumuman</span>
    </div>
    <h2 class="text-h2 text-on-surface" style="font-size:26px;">Pengumuman</h2>
    <p class="text-body-sm text-on-surface-variant mt-1">Informasi terbaru seputar penerimaan mahasiswa baru.</p>
</div>

<div class="space-y-4">
    {{-- Pinned Announcement --}}
    <div class="card rounded-2xl border-l-4 border-l-primary bg-primary-fixed/10" id="announcement-pinned">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center shrink-0 mt-1">
                <span class="material-symbols-outlined text-white">push_pin</span>
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="chip chip-info" style="font-size:10px;">PENTING</span>
                    <span class="text-label-sm text-on-surface-variant">5 Mei {{ date('Y') }}</span>
                </div>
                <h3 class="text-label-md text-on-surface mb-2">Jadwal Tes Seleksi Gelombang 1 Telah Ditentukan</h3>
                <p class="text-body-sm text-on-surface-variant">Tes seleksi gelombang 1 akan dilaksanakan pada hari Sabtu, 20 Juli {{ date('Y') }} pukul 08.00 WIB. Peserta wajib hadir 30 menit sebelum tes dimulai dengan membawa KTP dan kartu peserta.</p>
                <a href="#" class="inline-flex items-center gap-1 text-label-sm text-primary mt-3 hover:underline">
                    Baca selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>

    @foreach([
        ['title'=>'Pembayaran Pendaftaran Diperpanjang','date'=>'3 Mei '.date('Y'),'desc'=>'Batas waktu pembayaran pendaftaran gelombang 1 diperpanjang hingga 30 Juni '.date('Y').'. Manfaatkan kesempatan ini segera.','icon'=>'payments','color'=>'warning'],
        ['title'=>'Beasiswa Hafidz Al-Quran Dibuka','date'=>'1 Mei '.date('Y'),'desc'=>'Beasiswa penuh bagi hafidz/hafidzah minimal 15 juz. Daftarkan diri Anda melalui bagian kemahasiswaan.','icon'=>'auto_stories','color'=>'success'],
        ['title'=>'Panduan Pengisian Formulir Online','date'=>'28 Apr '.date('Y'),'desc'=>'Tutorial lengkap cara mengisi formulir pendaftaran online telah tersedia di halaman panduan.','icon'=>'menu_book','color'=>'primary']
    ] as $item)
    <div class="card card-hover rounded-2xl">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-{{ $item['color'] }}-light flex items-center justify-center shrink-0 mt-1">
                <span class="material-symbols-outlined text-{{ $item['color'] }}">{{ $item['icon'] }}</span>
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-label-sm text-on-surface-variant">{{ $item['date'] }}</span>
                </div>
                <h3 class="text-label-md text-on-surface mb-2">{{ $item['title'] }}</h3>
                <p class="text-body-sm text-on-surface-variant">{{ $item['desc'] }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

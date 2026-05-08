@extends('layouts.public')

@section('title', 'Penerimaan Mahasiswa Baru')
@section('meta_description', 'Daftar sebagai mahasiswa baru di STIT Mambaul Hikmah. Wujudkan masa depan gemilang di kampus yang mengintegrasikan keilmuan akademik dan nilai-nilai keislaman.')

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-surface-lowest" id="hero">
    {{-- Background Decorations --}}
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-primary/8 rounded-full blur-[120px] -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-tertiary/8 rounded-full blur-[100px] -ml-24 -mb-24"></div>
        <div class="absolute top-1/2 left-1/2 w-[300px] h-[300px] bg-primary-fixed/30 rounded-full blur-[80px] -translate-x-1/2 -translate-y-1/2"></div>
    </div>

    <div class="max-w-[1280px] mx-auto px-4 md:px-10 relative z-10 flex flex-col md:flex-row items-center gap-12 py-16">
        {{-- Text Content --}}
        <div class="flex-1 text-center md:text-left animate-fade-in">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary/8 text-primary text-label-sm mb-6 border border-primary/15">
                <span class="material-symbols-outlined text-base icon-filled">stars</span>
                Penerimaan Mahasiswa Baru {{ date('Y') }}/{{ date('Y')+1 }}
            </span>

            <h1 class="text-h1 text-on-surface mb-6" id="hero-heading">
                Wujudkan Masa Depan
                <span class="text-primary">Gemilang</span>
                di Kampus Inovasi
            </h1>

            <p class="text-body-lg text-on-surface-variant mb-10 max-w-xl mx-auto md:mx-0">
                Bergabunglah dengan komunitas akademik terbaik. Kami menyediakan lingkungan belajar modern dengan kurikulum berbasis kompetensi untuk mencetak lulusan yang siap bersaing secara global.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg" id="btn-hero-register">
                    Daftar Sekarang
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="#prodi" class="btn btn-secondary btn-lg" id="btn-hero-brochure">
                    Lihat Program Studi
                    <span class="material-symbols-outlined">school</span>
                </a>
            </div>

            {{-- Social Proof --}}
            <div class="mt-10 flex items-center gap-4 justify-center md:justify-start">
                <div class="flex -space-x-3">
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-primary-fixed flex items-center justify-center text-label-sm text-primary font-bold">A</div>
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-tertiary-fixed flex items-center justify-center text-label-sm text-tertiary font-bold">R</div>
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-primary-fixed flex items-center justify-center text-label-sm text-primary font-bold">M</div>
                </div>
                <p class="text-label-sm text-on-surface-variant">
                    <span class="font-bold text-primary">500+</span> Calon Mahasiswa telah mendaftar
                </p>
            </div>
        </div>

        {{-- Hero Visual --}}
        <div class="flex-1 relative w-full max-w-lg md:max-w-none animate-fade-in animate-delay-2">
            <div class="relative rounded-3xl overflow-hidden elevation-3 border-8 border-white aspect-[4/5] md:aspect-square bg-gradient-to-br from-primary/10 to-tertiary/10">
                {{-- Placeholder Image with gradient --}}
                <div class="absolute inset-0 gradient-primary opacity-20"></div>
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-8">
                    <span class="material-symbols-outlined text-primary icon-filled" style="font-size: 80px;">school</span>
                    <p class="text-h2 text-primary mt-4">STIT</p>
                    <p class="text-h3 text-primary-container">Mambaul Hikmah</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>

                {{-- Accreditation Badge --}}
                <div class="absolute bottom-6 left-6 right-6 glass p-5 rounded-2xl border border-white/50 elevation-2">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary p-2 bg-primary/10 rounded-lg icon-filled">verified</span>
                        <div>
                            <p class="text-label-md text-on-surface">Terakreditasi</p>
                            <p class="text-label-sm text-on-surface-variant">BAN-PT Sertifikasi</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Decorative Elements --}}
            <div class="absolute -top-6 -right-6 w-24 h-24 bg-tertiary-fixed rounded-2xl -z-10 animate-float"></div>
            <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary-fixed rounded-full -z-10 animate-float animate-delay-2"></div>
        </div>
    </div>
</section>

{{-- Statistics Section --}}
<section class="py-12 bg-primary text-white relative overflow-hidden" id="stats">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-white rounded-full blur-[80px]"></div>
    </div>
    <div class="max-w-[1280px] mx-auto px-4 md:px-10 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center animate-fade-in">
                <p class="text-h1 font-bold" style="font-size: 36px;">2</p>
                <p class="text-body-sm text-white/70 mt-1">Program Studi</p>
            </div>
            <div class="text-center animate-fade-in animate-delay-1">
                <p class="text-h1 font-bold" style="font-size: 36px;">500+</p>
                <p class="text-body-sm text-white/70 mt-1">Mahasiswa Aktif</p>
            </div>
            <div class="text-center animate-fade-in animate-delay-2">
                <p class="text-h1 font-bold" style="font-size: 36px;">50+</p>
                <p class="text-body-sm text-white/70 mt-1">Dosen Berkualitas</p>
            </div>
            <div class="text-center animate-fade-in animate-delay-3">
                <p class="text-h1 font-bold" style="font-size: 36px;">95%</p>
                <p class="text-body-sm text-white/70 mt-1">Tingkat Kelulusan</p>
            </div>
        </div>
    </div>
</section>

{{-- Program Studi Section --}}
<section class="py-20 px-4 md:px-10 bg-surface-lowest" id="prodi">
    <div class="max-w-[1280px] mx-auto">
        <div class="text-center mb-16 animate-fade-in">
            <span class="chip chip-info mb-4">Program Studi</span>
            <h2 class="text-h2 text-on-surface mb-4">Program Studi Unggulan</h2>
            <p class="text-body-md text-on-surface-variant max-w-2xl mx-auto">
                Pilih jalur pendidikan yang sesuai dengan minat dan passion Anda untuk karir masa depan yang sukses.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Main Highlight Card --}}
            <div class="md:col-span-2 md:row-span-2 group relative overflow-hidden rounded-2xl bg-surface-high border border-outline-variant p-8 flex flex-col justify-between transition-all hover:shadow-xl animate-fade-in">
                <div class="z-10">
                    <div class="w-14 h-14 gradient-primary text-white rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl">mosque</span>
                    </div>
                    <h3 class="text-h2 text-on-surface mb-4">Sekolah Tinggi Ilmu Tarbiyah Mambaul Hikmah</h3>
                    <p class="text-body-md text-on-surface-variant max-w-md mb-8">
                        Merupakan perguruan tinggi Islam yang berkomitmen dalam mencetak generasi unggul, berilmu, dan berakhlak mulia. Berada dalam lingkungan Pondok Pesantren Mambaul Hikmah.
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2 text-label-md text-on-surface">
                            <span class="material-symbols-outlined text-primary text-lg icon-filled">check_circle</span>
                            Kurikulum Berbasis Kompetensi Nasional
                        </li>
                        <li class="flex items-center gap-2 text-label-md text-on-surface">
                            <span class="material-symbols-outlined text-primary text-lg icon-filled">check_circle</span>
                            Integrasi Pendidikan Unggul Pesantren
                        </li>
                        <li class="flex items-center gap-2 text-label-md text-on-surface">
                            <span class="material-symbols-outlined text-primary text-lg icon-filled">check_circle</span>
                            Dosen Berpengalaman & Bersertifikasi
                        </li>
                    </ul>
                </div>
                <a href="#" class="inline-flex items-center gap-2 text-primary text-label-md group-hover:translate-x-2 transition-transform">
                    Lihat Detail Program <span class="material-symbols-outlined">chevron_right</span>
                </a>
                <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-colors"></div>
            </div>

            {{-- Prodi Card 1: PAI --}}
            <div class="group card card-hover relative overflow-hidden rounded-2xl animate-fade-in animate-delay-1" id="card-pai">
                <div class="w-12 h-12 bg-tertiary/10 text-tertiary rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xl">auto_stories</span>
                </div>
                <h4 class="text-h3 text-on-surface mb-2" style="font-size: 20px;">S1 Pendidikan Agama Islam (PAI)</h4>
                <p class="text-body-sm text-on-surface-variant">
                    Mencetak pendidik agama Islam yang profesional, kompeten, dan mampu mengintegrasikan nilai-nilai keislaman dalam pendidikan modern.
                </p>
                <div class="mt-4 flex items-center gap-2">
                    <span class="chip chip-success">Terakreditasi</span>
                </div>
            </div>

            {{-- Prodi Card 2: PBA --}}
            <div class="group card card-hover relative overflow-hidden rounded-2xl animate-fade-in animate-delay-2" id="card-pba">
                <div class="w-12 h-12 bg-error-container/30 text-error rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-xl">translate</span>
                </div>
                <h4 class="text-h3 text-on-surface mb-2" style="font-size: 20px;">S1 Pendidikan Bahasa Arab (PBA)</h4>
                <p class="text-body-sm text-on-surface-variant">
                    Menguasai bahasa Arab secara komprehensif untuk dunia pendidikan dan penerjemahan dengan standar internasional.
                </p>
                <div class="mt-4 flex items-center gap-2">
                    <span class="chip chip-success">Terakreditasi</span>
                </div>
            </div>

            {{-- CTA Band --}}
            <div class="md:col-span-3 gradient-primary text-white p-8 rounded-2xl flex flex-col md:flex-row items-center justify-between gap-8 animate-fade-in animate-delay-3">
                <div>
                    <h3 class="text-h3 mb-2">Belum menentukan pilihan?</h3>
                    <p class="text-body-md text-white/80">Konsultasikan langsung dengan tim admisi kami untuk menemukan program studi yang paling cocok untuk Anda.</p>
                </div>
                <a href="#" class="btn bg-white text-primary hover:bg-blue-50 transition-colors shrink-0 elevation-1" id="btn-konsultasi">
                    Konsultasi Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Jadwal Pendaftaran --}}
<section class="py-20 px-4 md:px-10 bg-surface-low" id="jadwal">
    <div class="max-w-[1280px] mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
            <div class="animate-fade-in">
                <span class="chip chip-info mb-4">Timeline</span>
                <h2 class="text-h2 text-on-surface mb-4">Jadwal Pendaftaran Penting</h2>
                <p class="text-body-md text-on-surface-variant">Pastikan Anda tidak melewatkan setiap tahapan seleksi masuk.</p>
            </div>
            <a href="#" class="text-label-md text-primary flex items-center gap-1 border-b-2 border-primary/20 hover:border-primary transition-all pb-1">
                Lihat Jadwal Lengkap <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            {{-- Step 1 --}}
            <div class="card card-hover rounded-2xl flex flex-col gap-4 relative animate-fade-in" id="schedule-1">
                <div class="flex justify-between items-start">
                    <span class="text-h1 text-surface-high" style="font-size: 48px; line-height: 1;">01</span>
                    <span class="chip chip-success uppercase tracking-wider" style="font-size: 10px;">Berlangsung</span>
                </div>
                <div>
                    <h4 class="text-label-md text-on-surface mb-1">Gelombang 1</h4>
                    <p class="text-label-sm text-on-surface-variant">5 Mei  - 30 Juni {{ date('Y') }}</p>
                </div>
                <div class="h-1 bg-primary w-full rounded-full"></div>
            </div>

            {{-- Step 2 --}}
            <div class="card card-hover rounded-2xl flex flex-col gap-4 animate-fade-in animate-delay-1" id="schedule-2">
                <div class="flex justify-between items-start">
                    <span class="text-h1 text-surface-high" style="font-size: 48px; line-height: 1;">02</span>
                    <span class="chip chip-warning uppercase tracking-wider" style="font-size: 10px;">Segera</span>
                </div>
                <div>
                    <h4 class="text-label-md text-on-surface mb-1">Gelombang 2</h4>
                    <p class="text-label-sm text-on-surface-variant">1 Juli - 30 Agustus {{ date('Y') }}</p>
                </div>
                <div class="h-1 bg-outline-variant w-full rounded-full"></div>
            </div>

            {{-- Step 3 --}}
            <div class="card card-hover rounded-2xl flex flex-col gap-4 animate-fade-in animate-delay-2" id="schedule-3">
                <div class="flex justify-between items-start">
                    <span class="text-h1 text-surface-high" style="font-size: 48px; line-height: 1;">03</span>
                </div>
                <div>
                    <h4 class="text-label-md text-on-surface mb-1">Tes Seleksi </h4>
                    <p class="text-label-sm text-on-surface-variant"> - </p>
                </div>
                <div class="h-1 bg-outline-variant w-full rounded-full"></div>
            </div>

            {{-- Step 4 --}}
            <div class="card card-hover rounded-2xl flex flex-col gap-4 animate-fade-in animate-delay-3" id="schedule-4">
                <div class="flex justify-between items-start">
                    <span class="text-h1 text-surface-high" style="font-size: 48px; line-height: 1;">04</span>
                </div>
                <div>
                    <h4 class="text-label-md text-on-surface mb-1">Pengumuman & Registrasi</h4>
                    <p class="text-label-sm text-on-surface-variant">-</p>
                </div>
                <div class="h-1 bg-outline-variant w-full rounded-full"></div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ Section --}}
<section class="py-20 px-4 md:px-10 bg-surface-lowest" id="faq">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-16 animate-fade-in">
            <span class="chip chip-info mb-4">FAQ</span>
            <h2 class="text-h2 text-on-surface mb-4">Pertanyaan Umum</h2>
            <p class="text-body-md text-on-surface-variant">Informasi cepat mengenai pendaftaran dan perkuliahan.</p>
        </div>

        <div class="space-y-4" id="faq-list">
            {{-- FAQ Item 1 --}}
            <div class="card rounded-2xl overflow-hidden !p-0 animate-fade-in" id="faq-1">
                <button class="w-full flex justify-between items-center p-5 text-left hover:bg-surface-low transition-colors" onclick="toggleFaq(this)">
                    <span class="text-label-md text-on-surface pr-4">Apa saja syarat pendaftaran mahasiswa baru?</span>
                    <span class="material-symbols-outlined text-on-surface-variant transition-transform duration-300">expand_more</span>
                </button>
                <div class="faq-content hidden px-5 pb-5 border-t border-outline-variant/50">
                    <p class="text-body-sm text-on-surface-variant pt-4">
                        Syarat utama meliputi scan ijazah SMA/SMK sederajat (atau surat keterangan lulus), scan KTP/KK, foto resmi terbaru (3x4 & 4x6), dan mengikuti rangkaian tes seleksi sesuai program studi pilihan. Untuk lulusan pesantren, bisa melampirkan syahadah/sertifikat pondok.
                    </p>
                </div>
            </div>

            {{-- FAQ Item 2 --}}
            <div class="card rounded-2xl overflow-hidden !p-0 animate-fade-in animate-delay-1" id="faq-2">
                <button class="w-full flex justify-between items-center p-5 text-left hover:bg-surface-low transition-colors" onclick="toggleFaq(this)">
                    <span class="text-label-md text-on-surface pr-4">Apa saja program studi yang tersedia di STIT Mambaul Hikmah?</span>
                    <span class="material-symbols-outlined text-on-surface-variant transition-transform duration-300">expand_more</span>
                </button>
                <div class="faq-content hidden px-5 pb-5 border-t border-outline-variant/50">
                    <p class="text-body-sm text-on-surface-variant pt-4">
                        Stit Mambaul Hikmah menawarkan dua program studi unggulan yaitu S1 Pendidikan Agama Islam (PAI) dan S1 Pendidikan Bahasa Arab (PBA). Kedua program studi ini dirancang untuk mencetak lulusan yang kompeten di bidangnya dengan kurikulum berbasis kompetensi nasional dan integrasi nilai-nilai keislaman.
                    </p>
                </div>
            </div>

            {{-- FAQ Item 3 --}}
            <div class="card rounded-2xl overflow-hidden !p-0 animate-fade-in animate-delay-2" id="faq-3">
                <button class="w-full flex justify-between items-center p-5 text-left hover:bg-surface-low transition-colors" onclick="toggleFaq(this)">
                    <span class="text-label-md text-on-surface pr-4">Bagaimana sistem perkuliahan di tahun akademik ini?</span>
                    <span class="material-symbols-outlined text-on-surface-variant transition-transform duration-300">expand_more</span>
                </button>
                <div class="faq-content hidden px-5 pb-5 border-t border-outline-variant/50">
                    <p class="text-body-sm text-on-surface-variant pt-4">
                        Perkuliahan dilaksanakan secara tatap muka (luring) dengan dukungan Learning Management System (LMS) untuk materi dan tugas online. Jadwal kuliah disesuaikan dengan jadwal pesantren bagi mahasiswa santri.
                    </p>
                </div>
            </div>

            {{-- FAQ Item 4 --}}
            <div class="card rounded-2xl overflow-hidden !p-0 animate-fade-in animate-delay-3" id="faq-4">
                <button class="w-full flex justify-between items-center p-5 text-left hover:bg-surface-low transition-colors" onclick="toggleFaq(this)">
                    <span class="text-label-md text-on-surface pr-4">Berapa biaya pendaftaran dan SPP per semester?</span>
                    <span class="material-symbols-outlined text-on-surface-variant transition-transform duration-300">expand_more</span>
                </button>
                <div class="faq-content hidden px-5 pb-5 border-t border-outline-variant/50">
                    <p class="text-body-sm text-on-surface-variant pt-4">
                        Biaya pendaftaran sangat terjangkau. Untuk informasi rinci mengenai biaya pendaftaran dan SPP per semester, silahkan hubungi panitia PMB atau kunjungi halaman informasi biaya di website kami.
                    </p>
                </div>
            </div>
        </div>

        {{-- Help CTA --}}
        <div class="mt-12 card rounded-2xl flex flex-col sm:flex-row items-center gap-6 bg-primary-fixed/30 border-primary/20 animate-fade-in animate-delay-4" id="help-cta">
            <div class="w-14 h-14 gradient-primary rounded-full flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-white text-2xl">support_agent</span>
            </div>
            <div class="text-center sm:text-left">
                <h4 class="text-label-md text-on-surface mb-1">Masih butuh bantuan?</h4>
                <p class="text-body-sm text-on-surface-variant mb-3">Tim admisi kami siap membantu menjawab pertanyaan Anda melalui WhatsApp atau telepon.</p>
                <a href="#" class="text-primary text-label-md hover:underline inline-flex items-center gap-1">
                    Hubungi Helpdesk PMB <span class="material-symbols-outlined text-base">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- CTA Registration --}}
<section class="py-20 px-4 md:px-10 gradient-primary text-white relative overflow-hidden" id="cta-register">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 right-10 w-[200px] h-[200px] bg-white rounded-full blur-[60px]"></div>
        <div class="absolute bottom-10 left-10 w-[300px] h-[300px] bg-white rounded-full blur-[80px]"></div>
    </div>
    <div class="max-w-[800px] mx-auto text-center relative z-10">
        <h2 class="text-h2 mb-4" style="color: white;">Siap Memulai Perjalanan Akademik Anda?</h2>
        <p class="text-body-lg text-white/80 mb-8 max-w-xl mx-auto">Daftarkan diri Anda sekarang dan jadilah bagian dari generasi unggul STIT Mambaul Hikmah.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="btn btn-lg bg-white text-primary hover:bg-blue-50 transition-colors elevation-2" id="btn-cta-register">
                Mulai Pendaftaran
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
            <a href="{{ route('login') }}" class="btn btn-lg border-2 border-white/30 text-white hover:bg-white/10 transition-colors" id="btn-cta-login">
                Sudah Punya Akun? Login
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
// FAQ Toggle
function toggleFaq(button) {
    const content = button.nextElementSibling;
    const icon = button.querySelector('.material-symbols-outlined');
    const isOpen = !content.classList.contains('hidden');

    // Close all
    document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
    document.querySelectorAll('#faq-list .material-symbols-outlined').forEach(i => i.style.transform = '');

    if (!isOpen) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    }
}

// Intersection Observer for scroll animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.animate-fade-in').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>
@endpush
@endsection

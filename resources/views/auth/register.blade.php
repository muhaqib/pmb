@extends('layouts.app')

@section('title', 'Daftar Akun Baru')
@section('meta_description', 'Daftar sebagai calon mahasiswa baru STIT Mambaul Hikmah. Mulai perjalanan akademik Anda sekarang.')

@section('body')
<div class="min-h-screen flex" style="background: linear-gradient(135deg, #faf8ff 0%, #ededf8 50%, #dbe1ff 100%);">
    {{-- Left Panel - Branding --}}
    <div class="hidden lg:flex lg:w-[45%] gradient-primary relative overflow-hidden items-center justify-center p-12">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 right-20 w-[400px] h-[400px] bg-white rounded-full blur-[100px]"></div>
            <div class="absolute bottom-20 left-20 w-[300px] h-[300px] bg-white rounded-full blur-[80px]"></div>
        </div>
        <div class="relative z-10 text-white max-w-md">
            <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center mb-8 border border-white/20">
                <span class="material-symbols-outlined text-white icon-filled" style="font-size: 32px;">school</span>
            </div>
            <h1 class="text-h2 mb-4" style="color:white;">Mulai Perjalanan Akademik Anda</h1>
            <p class="text-body-md text-white/80 mb-10">Registrasi akun untuk mengakses sistem pendaftaran mahasiswa baru STIT Mambaul Hikmah.</p>

            {{-- Steps preview --}}
            <div class="space-y-5">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0 text-label-md">1</div>
                    <div>
                        <p class="text-label-md" style="color: white;">Buat Akun</p>
                        <p class="text-body-sm text-white/60">Daftarkan email dan data diri Anda</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0 text-label-md">2</div>
                    <div>
                        <p class="text-label-md" style="color: white;">Isi Formulir</p>
                        <p class="text-body-sm text-white/60">Lengkapi biodata dan pilih program studi</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0 text-label-md">3</div>
                    <div>
                        <p class="text-label-md" style="color: white;">Upload & Bayar</p>
                        <p class="text-body-sm text-white/60">Upload berkas dan selesaikan pembayaran</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0 text-label-md">4</div>
                    <div>
                        <p class="text-label-md" style="color: white;">Ikuti Seleksi</p>
                        <p class="text-body-sm text-white/60">Tunggu jadwal tes & lihat pengumuman</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel - Registration Form --}}
    <div class="w-full lg:w-[55%] flex items-center justify-center p-6 overflow-y-auto">
        <div class="w-full max-w-lg">
            {{-- Mobile Logo --}}
            <div class="lg:hidden text-center mb-6">
                <div class="w-14 h-14 rounded-2xl gradient-primary flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-white icon-filled" style="font-size: 28px;">school</span>
                </div>
                <h1 class="text-h3 text-primary" style="font-size: 18px;">STIT Mambaul Hikmah</h1>
            </div>

            <div class="card rounded-2xl p-8 animate-scale-in" id="register-card">
                <div class="mb-8">
                    <h2 class="text-h2 text-on-surface mb-2" style="font-size: 26px;">Buat Akun Baru</h2>
                    <p class="text-body-sm text-on-surface-variant">Lengkapi data di bawah untuk memulai pendaftaran</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-4" id="register-form">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="form-label">NIK (KTP)</label>
                            <input type="text" id="nik" name="nik" class="form-input" placeholder="16 digit NIK" maxlength="16" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="reg_email" class="form-label">Email</label>
                        <div class="relative">
                            <input type="email" id="reg_email" name="email" class="form-input pl-11" placeholder="nama@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
    <label for="no_hp" class="form-label">Nomor HP / WhatsApp</label>
    
    <input 
        type="tel" 
        id="no_hp" 
        name="no_hp" 
        class="form-input w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="08xxxxxxxxxx"
        value="{{ old('no_hp') }}" 
        required
    >
</div>

                    <div class="form-group">
                        <label for="kategori" class="form-label">Kategori Pendaftar</label>
                        <select id="kategori" name="kategori" class="form-input form-select" required>
                            <option value="">— Pilih Kategori —</option>
                            <option value="umum">Umum</option>
                            <option value="santri">Santri</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prodi" class="form-label">Program Studi Pilihan</label>
                        <select id="prodi" name="prodi" class="form-input form-select" required>
                            <option value="">— Pilih Program Studi —</option>
                            <option value="pai">S1 Pendidikan Agama Islam (PAI)</option>
                            <option value="pba">S1 Pendidikan Bahasa Arab (PBA)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="reg_password" class="form-label">Kata Sandi</label>
                            <div class="relative">
                                <input type="password" id="reg_password" name="password" class="form-input pr-11" placeholder="Min. 8 karakter" required minlength="8">
                                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors" onclick="togglePassword(this)">
                                    <span class="material-symbols-outlined text-xl">visibility_off</span>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_password_confirmation" class="form-label">Konfirmasi Sandi</label>
                            <div class="relative">
                                <input type="password" id="reg_password_confirmation" name="password_confirmation" class="form-input pr-11" placeholder="Ulangi kata sandi" required>
                                <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors" onclick="togglePassword(this)">
                                    <span class="material-symbols-outlined text-xl">visibility_off</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-2 mt-2">
                        <input type="checkbox" id="terms" name="terms" class="w-4 h-4 mt-0.5 rounded border-outline-variant text-primary focus:ring-primary/30 accent-primary" required>
                        <label for="terms" class="text-body-sm text-on-surface-variant cursor-pointer">
                            Saya menyetujui <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-full btn-lg mt-2" id="btn-register-submit">
                        <span class="material-symbols-outlined text-xl">person_add</span>
                        Daftar Sekarang
                    </button>
                </form>

                <div class="relative my-6 text-center">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline-variant/40"></div></div>
                    <span class="relative bg-surface px-3 text-body-xs text-on-surface-variant uppercase tracking-wider">atau</span>
                </div>

                <a href="{{ route('auth.google') }}" class="btn w-full btn-lg border border-outline-variant hover:bg-surface-variant/20 text-on-surface flex items-center justify-center gap-3 transition-colors rounded-xl font-medium">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Daftar dengan Google</span>
                </a>

                <div class="mt-6 text-center">
                    <p class="text-body-sm text-on-surface-variant">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-primary text-label-md hover:underline">Masuk di sini</a>
                    </p>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="text-label-sm text-on-surface-variant hover:text-primary transition-colors inline-flex items-center gap-1">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(button) {
    const input = button.closest('.relative').querySelector('input');
    const icon = button.querySelector('.material-symbols-outlined');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
    }
}
</script>
@endsection

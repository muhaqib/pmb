@extends('layouts.app')

@section('title', 'Login')
@section('meta_description', 'Login ke akun PMB STIT Mambaul Hikmah untuk memantau progress pendaftaran Anda.')

@section('body')
<div class="min-h-screen flex" style="background: linear-gradient(135deg, #faf8ff 0%, #ededf8 50%, #dbe1ff 100%);">
    {{-- Left Panel - Branding --}}
    <div class="hidden lg:flex lg:w-1/2 gradient-primary relative overflow-hidden items-center justify-center p-12">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 right-20 w-[400px] h-[400px] bg-white rounded-full blur-[100px]"></div>
            <div class="absolute bottom-20 left-20 w-[300px] h-[300px] bg-white rounded-full blur-[80px]"></div>
        </div>
        <div class="relative z-10 text-center text-white max-w-lg">
            <div class="w-20 h-20 rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center mx-auto mb-8 border border-white/20">
                <span class="material-symbols-outlined text-white icon-filled" style="font-size: 40px;">school</span>
            </div>
            <h1 class="text-h1 mb-4" style="color:white;">STIT Mambaul Hikmah</h1>
            <p class="text-body-lg text-white/80 mb-8">Sistem Informasi Akademik & Penerimaan Mahasiswa Baru</p>
            <div class="flex justify-center gap-6">
                <div class="text-center">
                    <p class="text-h3" style="color:white;">500+</p>
                    <p class="text-label-sm text-white/60">Mahasiswa</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div class="text-center">
                    <p class="text-h3" style="color:white;">2</p>
                    <p class="text-label-sm text-white/60">Prodi</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div class="text-center">
                    <p class="text-h3" style="color:white;">50+</p>
                    <p class="text-label-sm text-white/60">Dosen</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Right Panel - Login Form --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md">
            {{-- Mobile Logo --}}
            <div class="lg:hidden text-center mb-8">
                <div class="w-16 h-16 rounded-2xl gradient-primary flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-white icon-filled" style="font-size: 32px;">school</span>
                </div>
                <h1 class="text-h3 text-primary">STIT Mambaul Hikmah</h1>
            </div>

            <div class="card rounded-2xl p-8 animate-scale-in" id="login-card">
                <div class="text-center mb-8">
                    <h2 class="text-h2 text-on-surface mb-2" style="font-size: 26px;">Selamat Datang</h2>
                    <p class="text-body-sm text-on-surface-variant">Masuk ke akun Anda untuk melanjutkan pendaftaran</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-error mb-6 bg-error/10 border-error/30 text-error p-4 rounded-xl">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined mt-0.5 icon-filled">error</span>
                            <div>
                                <ul class="list-disc list-inside text-body-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                              

                <a href="{{ route('auth.google') }}" class="btn btn-google w-full btn-lg rounded-xl font-medium flex items-center justify-center gap-3">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span>Masuk dengan Google</span>
                </a>

                  <div class="relative my-6 text-center">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-outline-variant/40"></div></div>
                    <span class="relative bg-surface px-3 text-body-xs text-on-surface-variant uppercase tracking-wider">atau</span>
                </div>
                <form action="{{ route('login') }}" method="POST" class="space-y-5" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">Email atau NIK</label>
                        <div class="relative">
                            <input type="email" id="email" name="email" class="form-input pl-11" placeholder="nama@email.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="flex justify-between items-center">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <a href="#" class="text-label-sm text-primary hover:underline">Lupa sandi?</a>
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="form-input pl-11 pr-11" placeholder="Masukkan kata sandi" required>
                            <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface transition-colors" onclick="togglePassword(this)">
                                <span class="material-symbols-outlined text-xl">visibility_off</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary/30 accent-primary">
                        <label for="remember" class="text-body-sm text-on-surface-variant cursor-pointer">Ingat saya</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-full btn-lg" id="btn-login-submit">
                        <span class="material-symbols-outlined text-xl">login</span>
                        Masuk
                    </button>
                </form>



                <div class="mt-6 text-center">
                    <p class="text-body-sm text-on-surface-variant">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-primary text-label-md hover:underline">Daftar Sekarang</a>
                    </p>
                </div>
            </div>

            <div class="mt-6 text-center">
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
    const input = button.previousElementSibling;
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

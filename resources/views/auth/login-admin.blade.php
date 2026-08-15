@extends('layouts.app')

@section('title', 'Login Administrator')
@section('meta_description', 'Portal Login Administrator PMB STIT Mambaul Hikmah')

@section('body')
<div class="min-h-screen flex items-center justify-center bg-[#f0f0f1] px-4 py-8">

    <div class="w-full max-w-[420px]">

        {{-- Logo / Branding --}}
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 mb-4 rounded bg-white border border-[#dcdcde] shadow-sm">
                <span class="material-symbols-outlined text-[#2271b1]" style="font-size: 40px;">
                    admin_panel_settings
                </span>
            </div>

            <h1 class="text-2xl font-semibold text-[#1d2327]">
                PMB STIT Mambaul Hikmah
            </h1>

            <p class="mt-1 text-sm text-[#646970]">
                Administrator Portal
            </p>
        </div>


        {{-- Login Card --}}
        <div
            id="admin-login-card"
            class="bg-white border border-[#dcdcde] rounded shadow-[0_1px_3px_rgba(0,0,0,0.08)] p-8"
        >

            <div class="mb-6">
                <h2 class="text-xl font-semibold text-[#1d2327]">
                    Login Administrator
                </h2>

                <p class="mt-1 text-sm text-[#646970]">
                    Masukkan akun administrator untuk mengelola sistem PMB.
                </p>
            </div>


            {{-- Session Error --}}
            @if(session('error'))
                <div class="mb-5 rounded border border-[#d63638] bg-[#fcf0f1] px-4 py-3 text-sm text-[#8a2424]">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-base mt-0.5">
                            error
                        </span>

                        <span>
                            {{ session('error') }}
                        </span>
                    </div>
                </div>
            @endif


            {{-- Validation Error --}}
            @if($errors->any())
                <div class="mb-5 rounded border border-[#d63638] bg-[#fcf0f1] px-4 py-3 text-sm text-[#8a2424]">
                    <div class="flex items-start gap-2">

                        <span class="material-symbols-outlined text-base mt-0.5">
                            error
                        </span>

                        <div>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            @endif


            {{-- Login Form --}}
            <form
                action="{{ route('login.admin') }}"
                method="POST"
                class="space-y-5"
                id="admin-login-form"
            >
                @csrf


                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="block mb-2 text-sm font-semibold text-[#1d2327]"
                    >
                        Email Administrator
                    </label>

                    <div class="relative">

                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#646970]"
                            style="font-size: 20px;"
                        >
                            mail
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="w-full h-10 rounded border border-[#8c8f94] bg-white text-[#2c3338] pl-10 pr-3 text-sm outline-none transition focus:border-[#2271b1] focus:ring-1 focus:ring-[#2271b1]"
                            placeholder="masukan email anda"
                            required
                            autofocus
                        >

                    </div>
                </div>


                {{-- Password --}}
                <div>

                    <div class="flex items-center justify-between mb-2">
                        <label
                            for="password"
                            class="block text-sm font-semibold text-[#1d2327]"
                        >
                            Kata Sandi
                        </label>
                    </div>

                    <div class="relative">

                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#646970]"
                            style="font-size: 20px;"
                        >
                            key
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full h-10 rounded border border-[#8c8f94] bg-white text-[#2c3338] pl-10 pr-11 text-sm outline-none transition focus:border-[#2271b1] focus:ring-1 focus:ring-[#2271b1]"
                            placeholder="••••••••"
                            required
                        >

                        <button
                            type="button"
                            onclick="togglePassword(this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#646970] hover:text-[#2271b1] transition"
                        >
                            <span
                                class="material-symbols-outlined"
                                style="font-size: 20px;"
                            >
                                visibility_off
                            </span>
                        </button>

                    </div>
                </div>


                {{-- Remember --}}
                <div class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="w-4 h-4 rounded border-[#8c8f94] text-[#2271b1] focus:ring-[#2271b1]"
                    >

                    <label
                        for="remember"
                        class="text-sm text-[#50575e] cursor-pointer"
                    >
                        Ingat sesi ini
                    </label>

                </div>


                {{-- Submit --}}
                <button
                    type="submit"
                    id="btn-admin-login-submit"
                    class="w-full h-10 inline-flex items-center justify-center gap-2 rounded bg-[#2271b1] hover:bg-[#135e96] border border-[#2271b1] hover:border-[#135e96] text-white text-sm font-medium shadow-none transition"
                >

                    <span
                        class="material-symbols-outlined"
                        style="font-size: 20px;"
                    >
                        shield_lock
                    </span>

                    Masuk Dashboard Admin

                </button>

            </form>

        </div>


        {{-- Footer --}}
        <div class="mt-5 text-center">

            <a
                href="{{ route('home') }}"
                class="inline-flex items-center gap-1 text-sm text-[#50575e] hover:text-[#2271b1] transition"
            >

                <span
                    class="material-symbols-outlined"
                    style="font-size: 18px;"
                >
                    arrow_back
                </span>

                Kembali ke Beranda Utama

            </a>

        </div>

    </div>

</div>


<script>
function togglePassword(button) {
    const input = button.parentElement.querySelector('input');
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
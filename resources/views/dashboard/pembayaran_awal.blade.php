@extends('layouts.app')

@section('title', 'Pembayaran Registrasi')

@section('body')
<div class="min-h-screen bg-surface-lowest flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-primary" style="font-size: 48px;">account_balance_wallet</span>
        </div>
        <h2 class="mt-2 text-center text-h2 text-on-surface">
            Pembayaran Registrasi
        </h2>
        <p class="mt-2 text-center text-body-md text-on-surface-variant">
            Selesaikan pembayaran pendaftaran Anda untuk melanjutkan ke dashboard PMB.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="card rounded-2xl bg-surface-high border border-outline-variant p-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-primary-fixed/20 border border-primary/30">
                    <p class="text-label-md text-primary">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-error-container/20 border border-error/30">
                    <ul class="list-disc pl-5 text-label-sm text-error">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-6 p-5 rounded-xl bg-secondary-fixed/20 border border-secondary/20">
                <h3 class="text-label-lg font-bold text-on-surface mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">info</span>
                    Informasi Pembayaran
                </h3>
                <div class="space-y-3 text-body-sm text-on-surface-variant">
                    <div class="flex justify-between border-b border-outline-variant/30 pb-2">
                        <span>Biaya Pendaftaran:</span>
                        <span class="font-bold text-on-surface">Rp 250.000</span>
                    </div>
                    <div class="flex justify-between border-b border-outline-variant/30 pb-2">
                        <span>Bank Tujuan:</span>
                        <span class="font-bold text-on-surface">BSI (Bank Syariah Indonesia)</span>
                    </div>
                    <div class="flex justify-between border-b border-outline-variant/30 pb-2">
                        <span>Nomor Rekening:</span>
                        <span class="font-bold text-on-surface">7123456789</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Atas Nama:</span>
                        <span class="font-bold text-on-surface">PMB STIT Mambaul Hikmah</span>
                    </div>
                </div>
            </div>

            @if($pembayaran)
                <div class="mb-6 p-5 rounded-xl border {{ $pembayaran->status === 'pending' ? 'bg-yellow-50 border-yellow-200' : 'bg-red-50 border-red-200' }}">
                    <h4 class="text-label-md flex items-center gap-2 {{ $pembayaran->status === 'pending' ? 'text-yellow-800' : 'text-red-800' }}">
                        <span class="material-symbols-outlined">
                            {{ $pembayaran->status === 'pending' ? 'hourglass_empty' : 'error' }}
                        </span>
                        Status: {{ ucfirst($pembayaran->status) }}
                    </h4>
                    <p class="text-body-sm mt-2 {{ $pembayaran->status === 'pending' ? 'text-yellow-700' : 'text-red-700' }}">
                        @if($pembayaran->status === 'pending')
                            Menunggu verifikasi admin. Silakan cek kembali secara berkala.
                        @elseif($pembayaran->status === 'ditolak')
                            Pembayaran Anda ditolak. Keterangan: {{ $pembayaran->keterangan ?? 'Bukti tidak valid.' }}. Silakan unggah ulang bukti yang benar.
                        @endif
                    </p>
                </div>
            @endif

            @if(!$pembayaran || $pembayaran->status === 'ditolak')
            <form action="{{ route('pembayaran.awal.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label for="file" class="block text-label-md text-on-surface mb-2">
                        Upload Bukti Pembayaran (Screenshot/Resi)
                    </label>
                    <input id="file" name="file" type="file" required accept=".jpg,.jpeg,.png,.pdf"
                        class="w-full px-4 py-3 border border-outline-variant rounded-xl text-body-md focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                    <p class="mt-2 text-body-sm text-on-surface-variant">Format: JPG, PNG, PDF. Maksimal 2MB.</p>
                </div>

                <div class="mt-6">
                    <button type="submit" class="btn btn-primary w-full py-3 justify-center text-label-lg">
                        Kirim Bukti Pembayaran
                        <span class="material-symbols-outlined">upload</span>
                    </button>
                </div>
            </form>
            @endif

            <div class="mt-8 border-t border-outline-variant pt-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary w-full py-2 justify-center text-label-md bg-transparent border border-outline hover:bg-surface-low transition-colors">
                        <span class="material-symbols-outlined text-base">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

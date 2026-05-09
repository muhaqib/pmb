@extends('layouts.app')

@section('title', 'Pembayaran Registrasi')

@section('body')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    * { box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f0f4f8;
        min-height: 100vh;
    }

    .pay-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
        background: linear-gradient(135deg, #f0f9f4 0%, #e8f4f8 50%, #f0f0fb 100%);
        position: relative;
        overflow: hidden;
    }

    .pay-wrapper::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(16,124,78,0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .pay-wrapper::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(99,92,220,0.07) 0%, transparent 70%);
        pointer-events: none;
    }

    .pay-container {
        width: 100%;
        max-width: 520px;
        position: relative;
        z-index: 1;
    }

    /* Header */
    .pay-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .pay-icon-wrap {
        width: 72px;
        height: 72px;
        border-radius: 22px;
        background: linear-gradient(135deg, #107c4e, #1aab6a);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        box-shadow: 0 8px 24px rgba(16,124,78,0.25);
    }

    .pay-icon-wrap .material-symbols-outlined {
        font-size: 36px;
        color: white;
    }

    .pay-title {
        font-size: 1.625rem;
        font-weight: 700;
        color: #1a2533;
        margin: 0 0 0.5rem;
        letter-spacing: -0.3px;
    }

    .pay-subtitle {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.6;
        margin: 0;
        max-width: 380px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Card */
    .pay-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04), 0 20px 40px -8px rgba(0,0,0,0.08);
        border: 1px solid rgba(255,255,255,0.8);
    }

    /* Alert banners */
    .alert {
        border-radius: 12px;
        padding: 0.875rem 1rem;
        margin-bottom: 1.25rem;
        font-size: 0.875rem;
        display: flex;
        align-items: flex-start;
        gap: 0.625rem;
    }

    .alert .material-symbols-outlined {
        font-size: 18px;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .alert-success {
        background: #f0fdf7;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert-error {
        background: #fff5f5;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    /* Bank info section */
    .bank-info {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .bank-info-header {
        background: linear-gradient(135deg, #107c4e, #1aab6a);
        padding: 0.875rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .bank-info-header .material-symbols-outlined {
        font-size: 18px;
        color: rgba(255,255,255,0.9);
    }

    .bank-info-header span:last-child {
        font-size: 0.875rem;
        font-weight: 600;
        color: white;
        letter-spacing: 0.1px;
    }

    .bank-info-body {
        padding: 1rem 1.25rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.6rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-row:first-child {
        padding-top: 0;
    }

    .info-label {
        font-size: 0.8375rem;
        color: #64748b;
    }

    .info-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1a2533;
        text-align: right;
    }

    .info-value.amount {
        font-size: 1.0625rem;
        color: #107c4e;
    }

    .copy-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: none;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 0.75rem;
        color: #64748b;
        cursor: pointer;
        transition: all 0.15s ease;
        font-family: inherit;
        margin-left: 8px;
    }

    .copy-btn:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #334155;
    }

    .copy-btn .material-symbols-outlined {
        font-size: 13px;
    }

    /* Status badge */
    .status-badge {
        border-radius: 12px;
        padding: 0.875rem 1.125rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .status-badge .material-symbols-outlined {
        font-size: 22px;
        flex-shrink: 0;
    }

    .status-badge.pending {
        background: #fffbeb;
        border: 1px solid #fde68a;
    }

    .status-badge.pending .material-symbols-outlined { color: #b45309; }
    .status-badge.pending .status-title { color: #92400e; }
    .status-badge.pending .status-desc { color: #a16207; }

    .status-badge.ditolak {
        background: #fff5f5;
        border: 1px solid #fecaca;
    }

    .status-badge.ditolak .material-symbols-outlined { color: #b91c1c; }
    .status-badge.ditolak .status-title { color: #991b1b; }
    .status-badge.ditolak .status-desc { color: #b91c1c; }

    .status-title {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .status-desc {
        font-size: 0.8125rem;
        line-height: 1.55;
    }

    /* Upload area */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.625rem;
    }

    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
        padding: 1.75rem 1.25rem;
        text-align: center;
        transition: all 0.2s ease;
        cursor: pointer;
        position: relative;
        background: #fafcff;
    }

    .upload-area:hover {
        border-color: #107c4e;
        background: #f0fdf7;
    }

    .upload-area.has-file {
        border-style: solid;
        border-color: #107c4e;
        background: #f0fdf7;
    }

    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #dcfce7;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.875rem;
    }

    .upload-icon .material-symbols-outlined {
        font-size: 24px;
        color: #107c4e;
    }

    .upload-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .upload-hint {
        font-size: 0.8rem;
        color: #94a3b8;
    }

    .file-preview {
        display: none;
        align-items: center;
        gap: 0.625rem;
        background: #f0fdf7;
        border: 1px solid #bbf7d0;
        border-radius: 10px;
        padding: 0.625rem 0.875rem;
        margin-top: 0.875rem;
        font-size: 0.8375rem;
        color: #166534;
    }

    .file-preview .material-symbols-outlined {
        font-size: 18px;
    }

    /* Divider */
    .divider {
        height: 1px;
        background: #f1f5f9;
        margin: 1.5rem 0;
    }

    /* Buttons */
    .btn-submit {
        width: 100%;
        padding: 0.875rem 1.5rem;
        background: linear-gradient(135deg, #107c4e, #1aab6a);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 0.9375rem;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16,124,78,0.25);
        letter-spacing: 0.1px;
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16,124,78,0.35);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-submit .material-symbols-outlined {
        font-size: 20px;
    }

    .btn-logout {
        width: 100%;
        padding: 0.75rem 1.5rem;
        background: transparent;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 500;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: all 0.15s ease;
    }

    .btn-logout:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #475569;
    }

    .btn-logout .material-symbols-outlined {
        font-size: 18px;
    }

    /* Responsive */
    @media (max-width: 540px) {
        .pay-wrapper { padding: 1.5rem 1rem; }
        .pay-card { padding: 1.5rem; border-radius: 20px; }
        .pay-title { font-size: 1.375rem; }
        .info-row { flex-direction: column; align-items: flex-start; gap: 2px; }
        .info-value { text-align: left; }
        .copy-btn { margin-left: 0; margin-top: 4px; }
    }

    @media (max-width: 360px) {
        .pay-card { padding: 1.25rem; }
    }
</style>

<div class="pay-wrapper">
    <div class="pay-container">

        {{-- Header --}}
        <div class="pay-header">
            <div class="pay-icon-wrap">
                <span class="material-symbols-outlined">account_balance_wallet</span>
            </div>
            <h1 class="pay-title">Pembayaran Registrasi</h1>
            <p class="pay-subtitle">Selesaikan pembayaran pendaftaran untuk melanjutkan ke dashboard PMB.</p>
        </div>

        <div class="pay-card">

            {{-- Success alert --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error alert --}}
            @if($errors->any())
                <div class="alert alert-error">
                    <span class="material-symbols-outlined">error</span>
                    <div>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Bank Info --}}
            <div class="bank-info">
                <div class="bank-info-header">
                    <span class="material-symbols-outlined">info</span>
                    <span>Informasi Pembayaran</span>
                </div>
                <div class="bank-info-body">
                    <div class="info-row">
                        <span class="info-label">Biaya Pendaftaran</span>
                        <span class="info-value amount">Rp 150.000</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Bank Tujuan</span>
                        <span class="info-value">BSI (Bank Syariah Indonesia)</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nomor Rekening</span>
                        <span class="info-value">
                            7339306308
                            <button class="copy-btn" onclick="copyText('7339306308', this)" type="button">
                                <span class="material-symbols-outlined">content_copy</span>Salin
                            </button>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Atas Nama</span>
                        <span class="info-value">PMB STIT Mambaul Hikmah</span>
                    </div>
                </div>
            </div>

            {{-- Status badge --}}
            @if($pembayaran)
                <div class="status-badge {{ $pembayaran->status }}">
                    <span class="material-symbols-outlined">
                        {{ $pembayaran->status === 'pending' ? 'hourglass_empty' : 'cancel' }}
                    </span>
                    <div>
                        <div class="status-title">
                            Status: {{ $pembayaran->status === 'pending' ? 'Menunggu Verifikasi' : 'Pembayaran Ditolak' }}
                        </div>
                        <div class="status-desc">
                            @if($pembayaran->status === 'pending')
                                Bukti pembayaran Anda sedang diperiksa oleh admin. Silakan cek kembali secara berkala.
                            @elseif($pembayaran->status === 'ditolak')
                                {{ $pembayaran->keterangan ?? 'Bukti tidak valid.' }} Silakan unggah ulang bukti yang benar.
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Upload form --}}
            @if(!$pembayaran || $pembayaran->status === 'ditolak')
                <form action="{{ route('pembayaran.awal.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Upload Bukti Pembayaran</label>
                        <div class="upload-area" id="uploadArea">
                            <input id="file" name="file" type="file" required accept=".jpg,.jpeg,.png,.pdf"
                                onchange="handleFileChange(this)">
                            <div class="upload-icon">
                                <span class="material-symbols-outlined">upload_file</span>
                            </div>
                            <div class="upload-title">Klik atau seret file ke sini</div>
                            <div class="upload-hint">JPG, PNG, atau PDF — Maks. 2MB</div>
                        </div>
                        <div class="file-preview" id="filePreview">
                            <span class="material-symbols-outlined">description</span>
                            <span id="fileName">—</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-outlined">send</span>
                        Kirim Bukti Pembayaran
                    </button>
                </form>
            @endif

            <div class="divider"></div>

            {{-- Logout --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <span class="material-symbols-outlined">logout</span>
                    Keluar dari Akun
                </button>
            </form>

        </div>
    </div>
</div>

<script>
    function copyText(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            btn.innerHTML = '<span class="material-symbols-outlined">check</span>Disalin!';
            btn.style.color = '#107c4e';
            setTimeout(() => {
                btn.innerHTML = '<span class="material-symbols-outlined">content_copy</span>Salin';
                btn.style.color = '';
            }, 2000);
        });
    }

    function handleFileChange(input) {
        const area = document.getElementById('uploadArea');
        const preview = document.getElementById('filePreview');
        const nameEl = document.getElementById('fileName');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            area.classList.add('has-file');
            nameEl.textContent = file.name;
            preview.style.display = 'flex';
        } else {
            area.classList.remove('has-file');
            preview.style.display = 'none';
        }
    }
</script>
@endsection
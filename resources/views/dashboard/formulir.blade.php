@extends('layouts.dashboard')

@section('title', 'Formulir Pendaftaran')

@section('content')
<div class="mb-8 animate-fade-in">
    <div class="flex items-center gap-2 text-body-sm text-on-surface-variant mb-2">
        <a href="{{ route('dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
        <span class="material-symbols-outlined text-base">chevron_right</span>
        <span class="text-on-surface">Formulir Pendaftaran</span>
    </div>
    <h2 class="text-h2 text-on-surface" style="font-size: 26px;">Formulir Pendaftaran</h2>
    <p class="text-body-sm text-on-surface-variant mt-1">Lengkapi seluruh data berikut dengan benar dan teliti.</p>
</div>

{{-- Progress indicator --}}
<div class="card rounded-2xl mb-8 animate-fade-in" id="form-progress">
    <div class="flex items-center justify-between mb-3">
        <span class="text-label-md text-on-surface">Kelengkapan Data</span>
        <span class="text-label-md text-primary">6 / 8 terisi</span>
    </div>
    <div class="w-full h-2 bg-surface-high rounded-full overflow-hidden">
        <div class="h-full gradient-primary rounded-full transition-all duration-500" style="width: 75%;"></div>
    </div>
</div>

<form action="#" method="POST" class="space-y-6" id="formulir-form">
    @csrf

    {{-- Section: Data Pribadi --}}
    <div class="card rounded-2xl animate-fade-in" id="section-pribadi">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">person</span>
            </div>
            <div>
                <h3 class="text-h3" style="font-size: 18px;">Data Pribadi</h3>
                <p class="text-body-sm text-on-surface-variant">Informasi dasar sesuai dokumen resmi</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group md:col-span-2">
                <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-error">*</span></label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" value="Rian Andrianto" required>
            </div>
            <div class="form-group">
                <label for="nik" class="form-label">NIK (No. KTP) <span class="text-error">*</span></label>
                <input type="text" id="nik" name="nik" class="form-input" placeholder="16 digit NIK" maxlength="16" required>
            </div>
            <div class="form-group">
                <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-error">*</span></label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-input" placeholder="Contoh: Lamongan" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-error">*</span></label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-error">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-input form-select" required>
                    <option value="">— Pilih —</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="agama" class="form-label">Agama <span class="text-error">*</span></label>
                <select id="agama" name="agama" class="form-input form-select" required>
                    <option value="">— Pilih —</option>
                    <option value="islam" selected>Islam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp" class="form-label">No. HP / WhatsApp <span class="text-error">*</span></label>
                <input type="tel" id="no_hp" name="no_hp" class="form-input" placeholder="08xxxxxxxxxx" required>
            </div>
            <div class="form-group md:col-span-2">
                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-error">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" class="form-input" placeholder="Desa/Kelurahan, Kecamatan, Kabupaten/Kota, Provinsi" required></textarea>
            </div>
        </div>
    </div>

    {{-- Section: Pendidikan Terakhir --}}
    <div class="card rounded-2xl animate-fade-in animate-delay-1" id="section-pendidikan">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-tertiary flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">school</span>
            </div>
            <div>
                <h3 class="text-h3" style="font-size: 18px;">Pendidikan Terakhir</h3>
                <p class="text-body-sm text-on-surface-variant">Riwayat pendidikan formal terakhir</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label for="jenjang" class="form-label">Jenjang Pendidikan <span class="text-error">*</span></label>
                <select id="jenjang" name="jenjang" class="form-input form-select" required>
                    <option value="">— Pilih —</option>
                    <option value="sma">SMA / MA</option>
                    <option value="smk">SMK</option>
                    <option value="pesantren">Pesantren (Paket C)</option>
                    <option value="d3">D3 / Sederajat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_sekolah" class="form-label">Nama Sekolah / Pesantren <span class="text-error">*</span></label>
                <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-input" placeholder="Contoh: MA Mambaul Hikmah" required>
            </div>
            <div class="form-group">
                <label for="tahun_lulus" class="form-label">Tahun Lulus <span class="text-error">*</span></label>
                <input type="number" id="tahun_lulus" name="tahun_lulus" class="form-input" placeholder="{{ date('Y') }}" min="2000" max="{{ date('Y') }}" required>
            </div>
            <div class="form-group">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" id="nisn" name="nisn" class="form-input" placeholder="10 digit NISN" maxlength="10">
            </div>
        </div>
    </div>

    {{-- Section: Program Studi --}}
    <div class="card rounded-2xl animate-fade-in animate-delay-2" id="section-prodi">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-success flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">menu_book</span>
            </div>
            <div>
                <h3 class="text-h3" style="font-size: 18px;">Program Studi Pilihan</h3>
                <p class="text-body-sm text-on-surface-variant">Pilih program studi yang diminati</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label for="prodi_pilihan" class="form-label">Pilihan Program Studi <span class="text-error">*</span></label>
                <select id="prodi_pilihan" name="prodi_pilihan" class="form-input form-select" required>
                    <option value="">— Pilih Program Studi —</option>
                    <option value="pai">S1 Pendidikan Agama Islam (PAI)</option>
                    <option value="pba">S1 Pendidikan Bahasa Arab (PBA)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gelombang" class="form-label">Gelombang Pendaftaran <span class="text-error">*</span></label>
                <select id="gelombang" name="gelombang" class="form-input form-select" required>
                    <option value="">— Pilih Gelombang —</option>
                    <option value="1">Gelombang 1 (Januari - Maret)</option>
                    <option value="2">Gelombang 2 (April - Juni)</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 animate-fade-in animate-delay-3">
        <p class="text-body-sm text-on-surface-variant">
            <span class="text-error">*</span> Wajib diisi
        </p>
        <div class="flex gap-3 w-full sm:w-auto">
            <button type="button" class="btn btn-secondary flex-1 sm:flex-initial" id="btn-simpan-draft">
                <span class="material-symbols-outlined text-lg">save</span>
                Simpan Draft
            </button>
            <button type="submit" class="btn btn-primary flex-1 sm:flex-initial" id="btn-submit-formulir">
                <span class="material-symbols-outlined text-lg">send</span>
                Kirim Formulir
            </button>
        </div>
    </div>
</form>
@endsection

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

@if(session('success'))
    <div class="alert alert-success mb-6 animate-fade-in">
        <span class="material-symbols-outlined text-success mt-0.5 icon-filled">check_circle</span>
        <div>
            <h4 class="text-label-md text-on-surface">Sukses</h4>
            <p class="text-body-sm text-on-surface-variant mt-1">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-error mb-6 animate-fade-in bg-error/10 border-error/30 text-error">
        <span class="material-symbols-outlined mt-0.5 icon-filled">error</span>
        <div>
            <h4 class="text-label-md">Terdapat Kesalahan</h4>
            <ul class="list-disc list-inside text-body-sm mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form action="{{ route('dashboard.formulir.update') }}" method="POST" class="space-y-6" id="formulir-form">
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
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-input" value="{{ old('nama_lengkap', $user->name) }}" required>
            </div>
            <div class="form-group">
                <label for="nik" class="form-label">NIK (No. KTP) <span class="text-error">*</span></label>
                <input type="text" id="nik" name="nik" class="form-input" placeholder="16 digit NIK" maxlength="16" value="{{ old('nik', $user->nik) }}" required>
            </div>
            <div class="form-group">
                <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-error">*</span></label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-input" placeholder="Contoh: Lamongan" value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-error">*</span></label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-input" value="{{ old('tanggal_lahir', $biodata->tanggal_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-error">*</span></label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-input form-select" required>
                    <option value="">— Pilih —</option>
                    <option value="L" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="agama" class="form-label">Agama <span class="text-error">*</span></label>
                <select id="agama" name="agama" class="form-input form-select" required>
                    <option value="">— Pilih —</option>
                    <option value="islam" {{ old('agama', $biodata->agama ?? 'islam') == 'islam' ? 'selected' : '' }}>Islam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp" class="form-label">No. HP / WhatsApp <span class="text-error">*</span></label>
                <input type="tel" id="no_hp" name="no_hp" class="form-input" placeholder="08xxxxxxxxxx" value="{{ old('no_hp', $user->no_hp) }}" required>
            </div>
            <div class="form-group md:col-span-2">
                <label for="alamat" class="form-label">Alamat Lengkap <span class="text-error">*</span></label>
                <textarea id="alamat" name="alamat" rows="3" class="form-input" placeholder="Desa/Kelurahan, Kecamatan, Kabupaten/Kota, Provinsi" required>{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
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
                    <option value="sma" {{ old('jenjang', $biodata->jenjang_pendidikan ?? '') == 'sma' ? 'selected' : '' }}>SMA / MA</option>
                    <option value="smk" {{ old('jenjang', $biodata->jenjang_pendidikan ?? '') == 'smk' ? 'selected' : '' }}>SMK</option>
                    <option value="pesantren" {{ old('jenjang', $biodata->jenjang_pendidikan ?? '') == 'pesantren' ? 'selected' : '' }}>Pesantren (Paket C)</option>
                    <option value="d3" {{ old('jenjang', $biodata->jenjang_pendidikan ?? '') == 'd3' ? 'selected' : '' }}>D3 / Sederajat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_sekolah" class="form-label">Nama Sekolah / Pesantren <span class="text-error">*</span></label>
                <input type="text" id="nama_sekolah" name="nama_sekolah" class="form-input" placeholder="Contoh: MA Mambaul Hikmah" value="{{ old('nama_sekolah', $biodata->nama_sekolah ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="tahun_lulus" class="form-label">Tahun Lulus <span class="text-error">*</span></label>
                <input type="number" id="tahun_lulus" name="tahun_lulus" class="form-input" placeholder="{{ date('Y') }}" min="2000" max="{{ date('Y') }}" value="{{ old('tahun_lulus', $biodata->tahun_lulus ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="nisn" class="form-label">NISN</label>
                <input type="text" id="nisn" name="nisn" class="form-input" placeholder="10 digit NISN" maxlength="10" value="{{ old('nisn', $biodata->nisn ?? '') }}">
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
                    <option value="pai" {{ old('prodi_pilihan', $pendaftaran->prodi ?? '') == 'pai' ? 'selected' : '' }}>S1 Pendidikan Agama Islam (PAI)</option>
                    <option value="pba" {{ old('prodi_pilihan', $pendaftaran->prodi ?? '') == 'pba' ? 'selected' : '' }}>S1 Pendidikan Bahasa Arab (PBA)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gelombang" class="form-label">Gelombang Pendaftaran <span class="text-error">*</span></label>
                <select id="gelombang" name="gelombang" class="form-input form-select" required>
                    <option value="">— Pilih Gelombang —</option>
                    <option value="1" {{ old('gelombang', $pendaftaran->gelombang ?? '') == '1' ? 'selected' : '' }}>Gelombang 1 (Januari - Maret)</option>
                    <option value="2" {{ old('gelombang', $pendaftaran->gelombang ?? '') == '2' ? 'selected' : '' }}>Gelombang 2 (April - Juni)</option>
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
            <button type="submit" class="btn btn-primary flex-1 sm:flex-initial" id="btn-submit-formulir">
                <span class="material-symbols-outlined text-lg">save</span>
                Simpan Formulir
            </button>
        </div>
    </div>
</form>
@endsection

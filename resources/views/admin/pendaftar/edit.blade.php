@extends('layouts.admin')

@section('title', 'Edit Data Pendaftar')

@section('content')
<div class="mb-8 animate-fade-in">
    <div class="flex items-center gap-2 text-body-sm text-on-surface-variant mb-2">
        <a href="{{ route('admin.pendaftar.index') }}" class="hover:text-primary transition-colors">Data Pendaftar</a>
        <span class="material-symbols-outlined text-base">chevron_right</span>
        <a href="{{ route('admin.pendaftar.show', $pendaftaran->id) }}" class="hover:text-primary transition-colors">{{ $pendaftaran->no_pendaftaran }}</a>
        <span class="material-symbols-outlined text-base">chevron_right</span>
        <span class="text-on-surface">Edit Data</span>
    </div>
    <h2 class="text-h2 text-on-surface" style="font-size: 28px;">Edit Data Pendaftar</h2>
    <p class="text-body-sm text-on-surface-variant mt-1">Ubah data pendaftaran mahasiswa baru.</p>
</div>

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

<form action="{{ route('admin.pendaftar.update', $pendaftaran->id) }}" method="POST" class="space-y-6">
    @csrf

    {{-- Section: Data Akun & Pendaftaran --}}
    <div class="card rounded-2xl animate-fade-in">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">settings</span>
            </div>
            <h3 class="text-h3" style="font-size: 18px;">Informasi Pendaftaran</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">NIK</label>
                <input type="text" name="nik" class="form-input" value="{{ old('nik', $user->nik) }}" required maxlength="16">
            </div>
            <div class="form-group">
                <label class="form-label">Email (Hanya Baca)</label>
                <input type="email" class="form-input bg-surface-low" value="{{ $user->email }}" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">No. HP</label>
                <input type="text" name="no_hp" class="form-input" value="{{ old('no_hp', $user->no_hp) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Kategori Pendaftar</label>
                <select name="kategori" class="form-input form-select" required>
                    <option value="umum" {{ old('kategori', $user->kategori) == 'umum' ? 'selected' : '' }}>Umum</option>
                    <option value="santri" {{ old('kategori', $user->kategori) == 'santri' ? 'selected' : '' }}>Santri</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Program Studi</label>
                <select name="prodi" class="form-input form-select" required>
                    <option value="pai" {{ old('prodi', $pendaftaran->prodi) == 'pai' ? 'selected' : '' }}>PAI</option>
                    <option value="pba" {{ old('prodi', $pendaftaran->prodi) == 'pba' ? 'selected' : '' }}>PBA</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Gelombang</label>
                <select name="gelombang" class="form-input form-select" required>
                    <option value="1" {{ old('gelombang', $pendaftaran->gelombang) == '1' ? 'selected' : '' }}>Gelombang 1</option>
                    <option value="2" {{ old('gelombang', $pendaftaran->gelombang) == '2' ? 'selected' : '' }}>Gelombang 2</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Section: Data Pribadi --}}
    <div class="card rounded-2xl animate-fade-in animate-delay-1">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-tertiary flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">person</span>
            </div>
            <h3 class="text-h3" style="font-size: 18px;">Biodata Pribadi</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-input" value="{{ old('tempat_lahir', $biodata->tempat_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-input" value="{{ old('tanggal_lahir', $biodata->tanggal_lahir ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-input form-select" required>
                    <option value="L" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $biodata->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Agama</label>
                <input type="text" name="agama" class="form-input" value="{{ old('agama', $biodata->agama ?? 'Islam') }}" required>
            </div>
            <div class="form-group md:col-span-2">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="form-input" required>{{ old('alamat', $biodata->alamat ?? '') }}</textarea>
            </div>
        </div>
    </div>

    {{-- Section: Pendidikan --}}
    <div class="card rounded-2xl animate-fade-in animate-delay-2">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-success flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">school</span>
            </div>
            <h3 class="text-h3" style="font-size: 18px;">Pendidikan Terakhir</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label class="form-label">Jenjang Pendidikan</label>
                <input type="text" name="jenjang_pendidikan" class="form-input" value="{{ old('jenjang_pendidikan', $biodata->jenjang_pendidikan ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Nama Sekolah</label>
                <input type="text" name="nama_sekolah" class="form-input" value="{{ old('nama_sekolah', $biodata->nama_sekolah ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Tahun Lulus</label>
                <input type="number" name="tahun_lulus" class="form-input" value="{{ old('tahun_lulus', $biodata->tahun_lulus ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">NISN</label>
                <input type="text" name="nisn" class="form-input" value="{{ old('nisn', $biodata->nisn ?? '') }}">
            </div>
        </div>
    </div>

    {{-- Section: Orang Tua --}}
    <div class="card rounded-2xl animate-fade-in animate-delay-3">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-xl bg-secondary flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-xl">family_restroom</span>
            </div>
            <h3 class="text-h3" style="font-size: 18px;">Data Orang Tua / Wali</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="form-group">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-input" value="{{ old('nama_ayah', $biodata->nama_ayah ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" class="form-input" value="{{ old('pekerjaan_ayah', $biodata->pekerjaan_ayah ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-input" value="{{ old('nama_ibu', $biodata->nama_ibu ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" class="form-input" value="{{ old('pekerjaan_ibu', $biodata->pekerjaan_ibu ?? '') }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Nama Wali</label>
                <input type="text" name="nama_wali" class="form-input" value="{{ old('nama_wali', $biodata->nama_wali ?? '') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Pekerjaan Wali</label>
                <input type="text" name="pekerjaan_wali" class="form-input" value="{{ old('pekerjaan_wali', $biodata->pekerjaan_wali ?? '') }}">
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('admin.pendaftar.show', $pendaftaran->id) }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">
            <span class="material-symbols-outlined">save</span> Simpan Perubahan
        </button>
    </div>
</form>
@endsection

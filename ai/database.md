🔷 1. STRUKTUR DATABASE UTAMA
🟢 1. users (default Laravel - dimodifikasi sedikit)
users
- id
- name
- email (unique)
- password
- role (enum: admin, mahasiswa) 
- created_at
- updated_at
🟢 2. pendaftarans (inti data PMB)
pendaftarans
- id
- user_id (FK ke users)
- no_pendaftaran (unique)
- nik
- nama_lengkap
- alamat
- no_wa
- email
- prodi (enum: PAI, PBA)

-- status progress
- is_profile_complete (boolean)
- is_document_uploaded (boolean)
- is_payment_uploaded (boolean)

- created_at
- updated_at
🟢 3. biodatas (data lengkap setelah login)
biodatas
- id
- pendaftaran_id (FK)
- tempat_lahir
- tanggal_lahir
- jenis_kelamin
- agama
- nama_ayah
- nama_ibu
- no_hp_ortu
- alamat_lengkap
- created_at
- updated_at
🟢 4. dokumens
dokumens
- id
- pendaftaran_id (FK)
- ktp (file path)
- ijazah (file path)
- created_at
- updated_at
🟢 5. pembayarans
pembayarans
- id
- pendaftaran_id (FK)
- bank (default: BSI)
- no_rekening
- nama_rekening
- bukti_pembayaran (file path)
- status (enum: pending, valid, ditolak)
- created_at
- updated_at
🟢 6. notifikasis (opsional tapi bagus)
notifikasis
- id
- user_id
- pesan
- is_read (boolean)
- created_at
🔷 2. RELASI MODEL (LARAVEL)
User
  hasOne Pendaftaran

Pendaftaran
  belongsTo User
  hasOne Biodata
  hasOne Dokumen
  hasOne Pembayaran
🔷 3. MIGRATION CONTOH (Laravel)
🔸 pendaftarans table
Schema::create('pendaftarans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('no_pendaftaran')->unique();
    $table->string('nik');
    $table->string('nama_lengkap');
    $table->text('alamat');
    $table->string('no_wa');
    $table->string('email');

    $table->enum('prodi', ['PAI', 'PBA']);

    $table->boolean('is_profile_complete')->default(false);
    $table->boolean('is_document_uploaded')->default(false);
    $table->boolean('is_payment_uploaded')->default(false);

    $table->timestamps();
});
🔸 biodatas table
Schema::create('biodatas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pendaftaran_id')->constrained()->cascadeOnDelete();

    $table->string('tempat_lahir');
    $table->date('tanggal_lahir');
    $table->string('jenis_kelamin');
    $table->string('agama');

    $table->string('nama_ayah');
    $table->string('nama_ibu');
    $table->string('no_hp_ortu');

    $table->text('alamat_lengkap');

    $table->timestamps();
});
🔸 dokumens table
Schema::create('dokumens', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pendaftaran_id')->constrained()->cascadeOnDelete();

    $table->string('ktp')->nullable();
    $table->string('ijazah')->nullable();

    $table->timestamps();
});
🔸 pembayarans table
Schema::create('pembayarans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('pendaftaran_id')->constrained()->cascadeOnDelete();

    $table->string('bank')->default('BSI');
    $table->string('no_rekening')->default('1234567890');
    $table->string('nama_rekening')->default('PMB Kampus');

    $table->string('bukti_pembayaran')->nullable();
    $table->enum('status', ['pending', 'valid', 'ditolak'])->default('pending');

    $table->timestamps();
});
🔷 4. AUTO GENERATE NO PENDAFTARAN
Contoh format:
PMB2026-0001
Di model:
public static function generateNoPendaftaran()
{
    $last = self::latest()->first();
    $number = $last ? (int) substr($last->no_pendaftaran, -4) + 1 : 1;

    return 'PMB' . date('Y') . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
}
🔷 5. LOGIC PROGRESS (PENTING)
$progress = 0;

if ($pendaftaran->is_profile_complete) $progress += 25;
if ($pendaftaran->is_document_uploaded) $progress += 25;
if ($pendaftaran->is_payment_uploaded) $progress += 25;

if ($progress == 75) {
    // tampilkan tombol cetak
}
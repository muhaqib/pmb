🔷 1. TUJUAN DASHBOARD ADMIN
Admin harus bisa:
Melihat jumlah pendaftar
Memverifikasi data
Mengecek dokumen
Memvalidasi pembayaran
Menentukan status akhir (lulus / tidak)
🔷 2. MENU DASHBOARD ADMIN
🟢 1. Dashboard Utama
Isi: statistik + ringkasan
Data yang ditampilkan:
Total Pendaftar
Sudah isi profil
Sudah upload dokumen
Sudah bayar
Sudah selesai
Logic:
$total = Pendaftaran::count();
$profil = Pendaftaran::where('is_profile_complete', true)->count();
$dokumen = Pendaftaran::where('is_document_uploaded', true)->count();
$pembayaran = Pendaftaran::where('is_payment_uploaded', true)->count();
🟢 2. Data Pendaftar (FITUR UTAMA)
Ini bagian paling penting.
Tabel berisi:
No Pendaftaran
Nama
NIK
Prodi (PAI / PBA)
No WA
Status:
Profil ✔
Dokumen ✔
Pembayaran ✔
Status akhir
Aksi:
Detail
Verifikasi
Tolak
Hapus
🟢 3. Detail Pendaftar
Saat admin klik "Detail":
Tampilkan:
📌 Data awal:
Nama
NIK
Alamat
Prodi
📌 Biodata lengkap:
TTL
Orang tua
dll
📌 Dokumen:
Preview KTP
Preview Ijazah
📌 Pembayaran:
Bukti transfer
🟢 4. Verifikasi Dokumen
Logic:
Admin bisa:
✅ Terima
❌ Tolak
Tambahkan field di database:
dokumen_status (pending, valid, ditolak)
🟢 5. Verifikasi Pembayaran
Logic:
if (valid) {
    $pembayaran->status = 'valid';
} else {
    $pembayaran->status = 'ditolak';
}
🟢 6. Penentuan Kelulusan
Tambahkan di pendaftarans:
status_kelulusan (pending, lulus, tidak_lulus)
Logic:
$pendaftaran->status_kelulusan = 'lulus';
$pendaftaran->save();
🟢 7. Filter Data (WAJIB ADA)
Agar admin tidak bingung:
Filter Prodi
Filter Status:
Belum lengkap
Sudah bayar
Sudah diverifikasi
Search nama / NIK
🟢 8. Export Data
Minimal:
Export Excel
Export PDF
🟢 9. Notifikasi
Admin tahu:
Ada pendaftar baru
Ada upload pembayaran
🔷 3. ALUR LOGIC ADMIN (PENTING)
Ini flow kerja admin:
Pendaftar masuk
Isi profil
Upload dokumen
Upload pembayaran
👇 ADMIN MASUK DI SINI
Admin cek dokumen
Admin cek pembayaran
Admin validasi
Admin tentukan kelulusan
🔷 4. CONTROLLER LOGIC (CONTOH)
🔸 Ambil data pendaftar
public function index()
{
    $data = Pendaftaran::with(['biodata', 'dokumen', 'pembayaran'])->latest()->get();

    return view('admin.pendaftar.index', compact('data'));
}
🔸 Verifikasi pembayaran
public function verifikasiPembayaran($id)
{
    $pembayaran = Pembayaran::findOrFail($id);
    $pembayaran->status = 'valid';
    $pembayaran->save();

    return back()->with('success', 'Pembayaran divalidasi');
}
🔸 Set kelulusan
public function setKelulusan($id)
{
    $p = Pendaftaran::findOrFail($id);
    $p->status_kelulusan = 'lulus';
    $p->save();

    return back();
}
🔷 5. STRUKTUR MENU ADMIN
Admin
│
├── Dashboard
├── Data Pendaftar
│   ├── Semua
│   ├── Belum Lengkap
│   ├── Sudah Bayar
│   └── Lulus
├── Verifikasi Dokumen
├── Verifikasi Pembayaran
├── Laporan
└── Pengaturan
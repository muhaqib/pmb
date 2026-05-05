# Aplikasi Web Mahasiswa (SIAKAD & PMB) - PRD

## 1. Latar Belakang
Perguruan tinggi membutuhkan sistem terintegrasi untuk mengelola proses akademik dan penerimaan mahasiswa baru secara digital. dengan nama stit Mambaul Hikmah

## 2. Tujuan Produk
- Membangun platform terintegrasi untuk PMB dan SIAKAD.
- Meningkatkan efisiensi operasional kampus.
- Memberikan akses mandiri (self-service) bagi mahasiswa dan calon mahasiswa.

## 3. Target Pengguna
- Calon Mahasiswa, Mahasiswa Aktif, Dosen, Admin Akademik, Pimpinan Kampus.

## 4. Ruang Lingkup Fitur
### 4.1 Modul PMB (Penerimaan Mahasiswa Baru)
- Registrasi akun, formulir online, upload dokumen, pembayaran, verifikasi, seleksi, pengumuman, daftar ulang.

### 4.2 Modul SIAKAD
- **Calon Mahasiswa:** pendaftaran, login, pendaftaran, pembayaran, verifikasi, seleksi, pengumuman, daftar ulang, profil.
- **Mahasiswa:** KRS, KHS, jadwal, transkrip, pembayaran UKT, profil.
- **Dosen:** Input nilai, presensi, jadwal mengajar.
- **Admin:** Kurikulum, data master, penjadwalan, validasi KRS, Data Mahasiswa Baru, Data Dosen, Data Mahasiswa Aktif, Data Mahasiswa Non-Aktif

### 4.3 Modul Keuangan
- Tagihan, payment gateway, riwayat, laporan.

## 5. Kebutuhan Fungsional
- RBAC (Role-Based Access Control), Dashboard sesuai peran, Document management, Export PDF/Excel.

## 6. Kebutuhan Non-Fungsional
- Keamanan (Enkripsi), Performa (<3s), Mobile-friendly.

## 7. Tech Stack

Berdasarkan kebutuhan, berikut adalah teknologi yang akan digunakan:

- **Frontend / Mobile UI:** **Astro** (Framework yang sangat cepat, akan dibangun dengan desain responsif menyerupai antarmuka aplikasi seluler/Mobile App, lalu dikompilasi menjadi Single Page Application).
- **Backend / API:** **Laravel** (Framework PHP yang sangat tangguh untuk menangani logika keuangan yang kompleks, autentikasi, dan relasi database).
- **Database:** **MySQL** (Relational Database Management System yang teruji dan sangat stabil untuk sistem pencatatan/akuntansi).
- **Deployment:** **Vercel** _(Catatan Teknis: Vercel sangat direkomendasikan untuk men-deploy Frontend Astro. Namun, untuk Backend Laravel dan MySQL, disarankan menggunakan VPS atau layanan Cloud Server khusus PHP/Database seperti VPS Hostinger, DigitalOcean, atau Railway agar sistem berjalan optimal secara ekosistem)._

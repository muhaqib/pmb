<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Biodata;
use App\Models\Dokumen;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@stit.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create Calon Mahasiswa (Rian)
        $rian = User::create([
            'name' => 'Rian Andrianto',
            'email' => 'rian@example.com',
            'password' => Hash::make('password'),
            'nik' => '3524101088000001',
            'no_hp' => '081234567890',
            'role' => 'calon_mahasiswa',
        ]);

        Pendaftaran::create([
            'user_id' => $rian->id,
            'no_pendaftaran' => 'PMB-2024-001',
            'prodi' => 'pai',
            'gelombang' => '1',
            'is_profile_complete' => true,
            'is_document_uploaded' => true,
            'is_payment_uploaded' => true,
            'status_kelulusan' => 'pending',
        ]);

        Biodata::create([
            'user_id' => $rian->id,
            'tempat_lahir' => 'Lamongan',
            'tanggal_lahir' => '2005-08-15',
            'jenis_kelamin' => 'L',
            'agama' => 'islam',
            'alamat' => 'Desa Karanggeneng, Kec. Karanggeneng, Lamongan',
            'jenjang_pendidikan' => 'sma',
            'nama_sekolah' => 'MA Mambaul Hikmah',
            'tahun_lulus' => 2023,
            'nisn' => '0051234567',
        ]);

        // Dokumen
        Dokumen::create(['user_id' => $rian->id, 'jenis_dokumen' => 'ktp', 'file_path' => 'docs/ktp_rian.pdf', 'file_name' => 'KTP_Rian.pdf', 'status' => 'valid']);
        Dokumen::create(['user_id' => $rian->id, 'jenis_dokumen' => 'ijazah', 'file_path' => 'docs/ijazah_rian.pdf', 'file_name' => 'Ijazah_2024.pdf', 'status' => 'pending']);
        Dokumen::create(['user_id' => $rian->id, 'jenis_dokumen' => 'foto', 'file_path' => 'docs/foto_rian.jpg', 'file_name' => 'Foto_3x4.jpg', 'status' => 'valid']);

        // Pembayaran
        Pembayaran::create(['user_id' => $rian->id, 'jenis_pembayaran' => 'pendaftaran', 'jumlah' => 250000, 'bukti_path' => 'bukti/tf_1.jpg', 'status' => 'valid']);
        Pembayaran::create(['user_id' => $rian->id, 'jenis_pembayaran' => 'spp', 'jumlah' => 2500000, 'bukti_path' => null, 'status' => 'belum_bayar']);

        // 3. Create another Calon Mahasiswa (Siti - Not complete)
        $siti = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'nik' => '3524101088000002',
            'no_hp' => '081987654321',
            'role' => 'calon_mahasiswa',
        ]);

        Pendaftaran::create([
            'user_id' => $siti->id,
            'no_pendaftaran' => 'PMB-2024-002',
            'prodi' => 'pba',
            'gelombang' => '1',
            'is_profile_complete' => true,
            'is_document_uploaded' => false,
            'is_payment_uploaded' => false,
            'status_kelulusan' => 'pending',
        ]);

        Biodata::create([
            'user_id' => $siti->id,
            'tempat_lahir' => 'Gresik',
            'tanggal_lahir' => '2004-12-01',
            'jenis_kelamin' => 'P',
            'agama' => 'islam',
            'alamat' => 'Jl. Pahlawan, Gresik',
            'jenjang_pendidikan' => 'sma',
            'nama_sekolah' => 'SMA N 1 Gresik',
            'tahun_lulus' => 2022,
            'nisn' => '0049876543',
        ]);
        
        // Siti belum upload dokumen & bayar.
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Dokumen;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminPendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user', 'user.biodata']);

        // Filters
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }

        if ($request->has('status_kelulusan') && $request->status_kelulusan != '') {
            $query->where('status_kelulusan', $request->status_kelulusan);
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            })->orWhere('no_pendaftaran', 'like', "%{$search}%");
        }

        $pendaftar = $query->latest()->paginate(10);

        return view('admin.pendaftar.index', compact('pendaftar'));
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user.biodata', 'user.dokumens', 'user.pembayarans'])->findOrFail($id);
        
        return view('admin.pendaftar.show', compact('pendaftaran'));
    }

    public function setKelulusan(Request $request, $id)
    {
        $request->validate([
            'status_kelulusan' => 'required|in:pending,lulus,tidak_lulus'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status_kelulusan = $request->status_kelulusan;
        $pendaftaran->save();

        return back()->with('success', 'Status kelulusan berhasil diperbarui.');
    }

    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with(['user.biodata'])->findOrFail($id);
        $user = $pendaftaran->user;
        $biodata = $user->biodata;
        
        return view('admin.pendaftar.edit', compact('pendaftaran', 'user', 'biodata'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $user = $pendaftaran->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:users,nik,' . $user->id,
            'kategori' => 'required|in:umum,santri',
            'no_hp' => 'required|string|max:15',
            'prodi' => 'required|string',
            'gelombang' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'jenjang_pendidikan' => 'required|string',
            'nama_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'kategori' => $request->kategori,
        ]);

        $user->biodata()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'jenjang_pendidikan' => $request->jenjang_pendidikan,
                'nama_sekolah' => $request->nama_sekolah,
                'tahun_lulus' => $request->tahun_lulus,
                'nisn' => $request->nisn,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
            ]
        );

        $pendaftaran->update([
            'prodi' => $request->prodi,
            'gelombang' => $request->gelombang,
        ]);

        return redirect()->route('admin.pendaftar.show', $id)->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    public function verifikasiDokumen(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,valid,ditolak'
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->status = $request->status;
        $dokumen->save();

        return back()->with('success', 'Status dokumen berhasil diperbarui.');
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,valid,ditolak'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = $request->status;
        $pembayaran->save();

        // Update Pendaftaran status if payment is valid and it's the registration fee
        if ($pembayaran->status == 'valid' && $pembayaran->jenis_pembayaran == 'pendaftaran') {
            $pendaftaran = Pendaftaran::where('user_id', $pembayaran->user_id)->first();
            if ($pendaftaran) {
                $pendaftaran->is_payment_uploaded = true;
                $pendaftaran->save();
            }
        }

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        $fileName = 'data_pendaftar_' . date('Y-m-d_H-i-s') . '.csv';

        $query = Pendaftaran::with(['user', 'user.biodata']);

        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }
        if ($request->has('status_kelulusan') && $request->status_kelulusan != '') {
            $query->where('status_kelulusan', $request->status_kelulusan);
        }
        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('kategori', $request->kategori);
            });
        }

        $pendaftar = $query->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = [
            'No Pendaftaran', 'Nama Lengkap', 'NIK', 'Email', 'No HP', 'Kategori',
            'Prodi', 'Status Kelulusan', 'Tempat Lahir', 'Tanggal Lahir', 
            'Jenis Kelamin', 'Agama', 'Alamat', 'Jenjang Pendidikan', 
            'Nama Sekolah', 'Tahun Lulus', 'NISN', 
            'Nama Ayah', 'Pekerjaan Ayah', 'Nama Ibu', 'Pekerjaan Ibu', 
            'Nama Wali', 'Pekerjaan Wali'
        ];

        $callback = function() use($pendaftar, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($pendaftar as $p) {
                $row = [
                    $p->no_pendaftaran,
                    $p->user->name ?? '-',
                    $p->user->nik ?? '-',
                    $p->user->email ?? '-',
                    $p->user->no_hp ?? '-',
                    $p->user->kategori ?? 'umum',
                    strtoupper($p->prodi),
                    ucfirst(str_replace('_', ' ', $p->status_kelulusan)),
                    $p->user->biodata->tempat_lahir ?? '-',
                    $p->user->biodata->tanggal_lahir ?? '-',
                    $p->user->biodata->jenis_kelamin ?? '-',
                    $p->user->biodata->agama ?? '-',
                    $p->user->biodata->alamat ?? '-',
                    $p->user->biodata->jenjang_pendidikan ?? '-',
                    $p->user->biodata->nama_sekolah ?? '-',
                    $p->user->biodata->tahun_lulus ?? '-',
                    $p->user->biodata->nisn ?? '-',
                    $p->user->biodata->nama_ayah ?? '-',
                    $p->user->biodata->pekerjaan_ayah ?? '-',
                    $p->user->biodata->nama_ibu ?? '-',
                    $p->user->biodata->pekerjaan_ibu ?? '-',
                    $p->user->biodata->nama_wali ?? '-',
                    $p->user->biodata->pekerjaan_wali ?? '-'
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'user.dokumens', 'user.pembayarans', 'user.biodata'])->findOrFail($id);
        $user = $pendaftaran->user;

        if ($user) {
            // Hapus file fisik dokumen jika ada
            if ($user->dokumens) {
                foreach ($user->dokumens as $dokumen) {
                    if ($dokumen->file_path && file_exists(public_path($dokumen->file_path))) {
                        @unlink(public_path($dokumen->file_path));
                    }
                }
            }

            // Hapus file fisik bukti pembayaran jika ada
            if ($user->pembayarans) {
                foreach ($user->pembayarans as $pembayaran) {
                    if ($pembayaran->bukti_path && file_exists(public_path($pembayaran->bukti_path))) {
                        @unlink(public_path($pembayaran->bukti_path));
                    }
                }
            }

            // Hapus relasi pendukung dan akun user
            $user->biodata()?->delete();
            $user->dokumens()?->delete();
            $user->pembayarans()?->delete();
            $user->pendaftaran()?->delete();
            $user->delete();
        } else {
            $pendaftaran->delete();
        }

        return redirect()->route('admin.pendaftar.index')->with('success', 'Data pendaftar beserta seluruh berkas terkait berhasil dihapus permanen.');
    }
}

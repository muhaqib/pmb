<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        
        $progress = 0;
        if ($pendaftaran) {
            if ($pendaftaran->is_profile_complete) $progress += 25;
            if ($pendaftaran->is_document_uploaded) $progress += 25;
            if ($pendaftaran->is_payment_uploaded) $progress += 25;
            if ($pendaftaran->status_kelulusan !== 'pending') $progress += 25;
        }

        return view('dashboard.index', compact('user', 'pendaftaran', 'progress'));
    }

    public function formulir()
    {
        $user = Auth::user();
        $biodata = $user->biodata;
        $pendaftaran = $user->pendaftaran;
        
        return view('dashboard.formulir', compact('user', 'biodata', 'pendaftaran'));
    }

    public function dokumen()
    {
        $user = Auth::user();
        $dokumens = $user->dokumens->keyBy('jenis_dokumen');
        
        return view('dashboard.dokumen', compact('user', 'dokumens'));
    }

    public function pembayaran()
    {
        $user = Auth::user();
        $pembayarans = $user->pembayarans;
        
        return view('dashboard.pembayaran', compact('user', 'pembayarans'));
    }

    public function updateFormulir(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:users,nik,' . $user->id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'no_hp' => 'required|string|max:15',
            'kategori' => 'required|in:umum,santri',
            'alamat' => 'required|string',
            'jenjang' => 'required|string',
            'nama_sekolah' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'prodi_pilihan' => 'required|string',
            'gelombang' => 'required|string',
        ]);

        $user->update([
            'name' => $request->nama_lengkap,
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
                'jenjang_pendidikan' => $request->jenjang,
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

        $user->pendaftaran()->update([
            'prodi' => $request->prodi_pilihan,
            'gelombang' => $request->gelombang,
            'is_profile_complete' => true,
        ]);

        return redirect()->route('dashboard.formulir')->with('success', 'Formulir berhasil disimpan.');
    }

    public function uploadDokumen(Request $request)
    {
        $request->validate([
            'jenis_dokumen' => 'required|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $file = $request->file('file');
        
        $fileName = $request->jenis_dokumen . '_' . $user->id . '_' . time() . '.' . $file->extension();
        $path = $file->storeAs('dokumen', $fileName, 'public');

        $user->dokumens()->updateOrCreate(
            ['jenis_dokumen' => $request->jenis_dokumen],
            [
                'file_path' => 'storage/dokumen/' . $fileName,
                'file_name' => $file->getClientOriginalName(),
                'status' => 'pending'
            ]
        );

        // Check if required documents are complete
        $requiredDocs = ['ktp', 'ijazah', 'foto', 'kk'];
        $uploadedDocs = $user->dokumens()->pluck('jenis_dokumen')->toArray();
        $isComplete = count(array_intersect($requiredDocs, $uploadedDocs)) === count($requiredDocs);

        if ($isComplete) {
            $user->pendaftaran()->update(['is_document_uploaded' => true]);
        }

        return back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function uploadPembayaran(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = Auth::user();
        $file = $request->file('file');
        
        $fileName = 'pembayaran_' . $user->id . '_' . time() . '.' . $file->extension();
        $path = $file->storeAs('pembayaran', $fileName, 'public');

        $user->pembayarans()->updateOrCreate(
            ['jenis_pembayaran' => 'pendaftaran'],
            [
                'jumlah' => 150000,
                'bukti_path' => 'storage/pembayaran/' . $fileName,
                'status' => 'pending'
            ]
        );

        return back()->with('success', 'Bukti pembayaran berhasil diunggah dan sedang diverifikasi.');
    }

    public function pembayaranAwal()
    {
        $user = Auth::user();
        $pembayaran = $user->pembayarans()->where('jenis_pembayaran', 'pendaftaran')->latest()->first();

        if ($pembayaran && $pembayaran->status === 'valid') {
            return redirect()->route('dashboard');
        }

        return view('dashboard.pembayaran_awal', compact('user', 'pembayaran'));
    }

    public function uploadPembayaranAwal(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = Auth::user();
        $file = $request->file('file');
        
        $fileName = 'pembayaran_' . $user->id . '_' . time() . '.' . $file->extension();
        $path = $file->storeAs('pembayaran', $fileName, 'public');

        $user->pembayarans()->updateOrCreate(
            ['jenis_pembayaran' => 'pendaftaran'],
            [
                'jumlah' => 150000,
                'bukti_path' => 'storage/pembayaran/' . $fileName,
                'status' => 'pending'
            ]
        );

        $user->pendaftaran()->update(['is_payment_uploaded' => true]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah dan sedang diverifikasi.');
    }

    public function pengumuman()
    {
        return view('dashboard.pengumuman');
    }

    public function jadwal()
    {
        return view('dashboard.jadwal');
    }
}

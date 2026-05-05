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
}

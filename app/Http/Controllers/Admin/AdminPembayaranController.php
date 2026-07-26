<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['user', 'user.pendaftaran']);

        // Filter status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter jenis_pembayaran
        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_pembayaran', $request->jenis);
        }

        // Filter search (Nama, NIK, No Pendaftaran, Email)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhereHas('pendaftaran', function($qp) use ($search) {
                      $qp->where('no_pendaftaran', 'like', "%{$search}%");
                  });
            });
        }

        $pembayarans = $query->latest()->paginate(15);

        $stats = [
            'total' => Pembayaran::count(),
            'pending' => Pembayaran::where('status', 'pending')->count(),
            'valid' => Pembayaran::where('status', 'valid')->count(),
            'ditolak' => Pembayaran::where('status', 'ditolak')->count(),
        ];

        return view('admin.pembayaran.index', compact('pembayarans', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,valid,ditolak,belum_bayar'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = $request->status;
        $pembayaran->save();

        if ($pembayaran->status === 'valid' && $pembayaran->jenis_pembayaran === 'pendaftaran') {
            $pendaftaran = Pendaftaran::where('user_id', $pembayaran->user_id)->first();
            if ($pendaftaran) {
                $pendaftaran->is_payment_uploaded = true;
                $pendaftaran->save();
            }
        }

        $namaPendaftar = $pembayaran->user->name ?? 'Pendaftar';

        return back()->with('success', "Status pembayaran untuk {$namaPendaftar} berhasil diubah menjadi " . strtoupper($pembayaran->status) . ".");
    }
}

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

    public function pengumuman()
    {
        return view('dashboard.pengumuman');
    }

    public function jadwal()
    {
        return view('dashboard.jadwal');
    }
}

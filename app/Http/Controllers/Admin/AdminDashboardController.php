<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pendaftar' => Pendaftaran::count(),
            'profil_lengkap' => Pendaftaran::where('is_profile_complete', true)->count(),
            'dokumen_lengkap' => Pendaftaran::where('is_document_uploaded', true)->count(),
            'sudah_bayar' => Pendaftaran::where('is_payment_uploaded', true)->count(),
            'lulus' => Pendaftaran::where('status_kelulusan', 'lulus')->count(),
            'pendapatan' => Pembayaran::where('status', 'valid')->sum('jumlah'),
        ];

        // Get recent registrations
        $recentPendaftar = Pendaftaran::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPendaftar'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (Auth::user()->role === 'admin') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Akses ditolak. Administrator hanya dapat login melalui halaman khusus Admin.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    public function showAdminLogin()
    {
        return view('auth.login-admin');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Akses ditolak. Halaman ini khusus untuk Administrator.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'string', 'max:15'],
            'kategori' => ['required', 'in:umum,santri'],
            'prodi' => ['required', 'string'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'kategori' => $request->kategori,
            'password' => Hash::make($request->password),
            'role' => 'calon_mahasiswa',
        ]);

        Pendaftaran::create([
            'user_id' => $user->id,
            'no_pendaftaran' => 'PMB-' . date('Y') . '-' . str_pad($user->id, 3, '0', STR_PAD_LEFT),
            'prodi' => $request->prodi,
            'gelombang' => '1',
            'is_profile_complete' => false,
            'is_document_uploaded' => false,
            'is_payment_uploaded' => false,
            'status_kelulusan' => 'pending',
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal melakukan otentikasi dengan Google. Silakan coba lagi.',
            ]);
        }

        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Pengguna Google',
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role' => 'calon_mahasiswa',
                    'password' => Hash::make(Str::random(24)),
                ]);

                Pendaftaran::create([
                    'user_id' => $user->id,
                    'no_pendaftaran' => 'PMB-' . date('Y') . '-' . str_pad($user->id, 3, '0', STR_PAD_LEFT),
                    'prodi' => 'pai',
                    'gelombang' => '1',
                    'is_profile_complete' => false,
                    'is_document_uploaded' => false,
                    'is_payment_uploaded' => false,
                    'status_kelulusan' => 'pending',
                ]);
            }
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Cek apakah pengguna sudah melakukan pembayaran pendaftaran dan diverifikasi
        $pembayaran = $user->pembayarans()->where('jenis_pembayaran', 'pendaftaran')->latest()->first();
        if (!$pembayaran || $pembayaran->status !== 'valid') {
            return redirect()->route('pembayaran.awal');
        }

        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPaymentVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        // Admin bypass
        if ($user && $user->role === 'admin') {
            return $next($request);
        }

        // Check if user has a valid registration payment
        $pembayaran = $user->pembayarans()->where('jenis_pembayaran', 'pendaftaran')->latest()->first();
        
        if (!$pembayaran || $pembayaran->status !== 'valid') {
            // Redirect to the initial payment page if the user doesn't have a valid payment
            return redirect()->route('pembayaran.awal');
        }

        return $next($request);
    }
}

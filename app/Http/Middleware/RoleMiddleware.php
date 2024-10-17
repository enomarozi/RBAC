<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessRole; // Model untuk tabel access_roles

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Atur sesuai rute login Anda
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil role dari tabel access_roles berdasarkan user
        $userRole = AccessRole::where('user', $user->id)->pluck('role')->first();

        // Debugging: lihat role pengguna
        dd($userRole, $roles); // Ini akan menghentikan eksekusi dan menampilkan nilai

        if (!in_array($userRole, $roles)) {
            return redirect()->back()->withErrors(['role' => 'You do not have permission to access this resource.']);
        }

        return $next($request);
    }
}

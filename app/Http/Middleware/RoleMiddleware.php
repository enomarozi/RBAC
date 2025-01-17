<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\{AccessRole,Logs};

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        $user = Auth::user();
        Logs::create([
                'username' => $user->username,
                'action' => $request->method(),
                'path' => $request->path(),
            ]);
        $userRole = AccessRole::where('user', $user->username)->pluck('role')->first();

        if ($userRole !== $roles) {
            return redirect()->route('no_permission'); 
        }
        return $next($request);
    }
}

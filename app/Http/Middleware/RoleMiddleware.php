<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessRole;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }

        $user = Auth::user();

        $userRole = AccessRole::where('user', $user->id)->pluck('role')->first();

        dd($userRole, $roles); 

        if (!in_array($userRole, $roles)) {
            return redirect()->back()->withErrors(['role' => 'You do not have permission to access this resource.']);
        }

        return $next($request);
    }
}

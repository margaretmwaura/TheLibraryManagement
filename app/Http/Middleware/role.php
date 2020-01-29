<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class role
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = Auth::user()->role_id;
        if ($role == 9) {
            Log::info("User is Admin");
            return redirect('/home');
        } else {
            Log::info("User is common mwananchi");
            return redirect('/home');
        }
    }
}

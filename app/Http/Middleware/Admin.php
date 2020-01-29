<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Closure;

class Admin
{

    public function handle($request, Closure $next)
    {
        $role = Auth::user()->role_id;
        if($role == 9 || $role == 35)
        {
            Log::info("User is Admin");
            return $next($request);
        }
        else{
            Log::info("User is common mwananchi");
            return redirect('/home');
        }

    }
}

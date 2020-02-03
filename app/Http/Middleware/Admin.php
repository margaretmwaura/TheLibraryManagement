<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Closure;

class Admin
{

    public function handle($request, Closure $next)
    {
        $roles = \App\Models\Role::where('name','Admin')->get();
        $onerole = $roles[0];
        $roles_id = $onerole->id;
        $role = Auth::user()->role_id;

        if($role == $roles_id)
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

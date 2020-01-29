<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class rolemiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = \App\Models\Role::where('name','Admin')->get();
        $roles_id = $roles->id;
        $role = Auth::user()->role_id;
        if ($role == $roles_id) {
            Log::info("User is Admin");
            return redirect('/admin');
        } else {
            Log::info("User is common mwananchi");
            return redirect('/home');
        }
    }
}

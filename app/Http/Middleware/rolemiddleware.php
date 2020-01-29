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
//        $roles_id = \App\Models\Role::where('name','Admin')->pluck('id');

        $role = Auth::user()->role_id;
        if ($role == 35) {
            Log::info("User is Admin");
            return redirect('/admin');
        } else {
            Log::info("User is common mwananchi");
            return redirect('/home');
        }
    }
}

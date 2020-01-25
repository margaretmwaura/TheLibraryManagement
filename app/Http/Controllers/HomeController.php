<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        Role::create(['name' =>'reader']);
//        Permission::create(['name' => 'view posts']);
//        $role = Role::findById(4);
//        $permission = Permission::findById(4);
//        $role->givePermissionTo($permission);
//         auth()->user()->givePermissionTo('delete posts');
          $users = User::all();
        return view('home') -> with('users',$users);


//        return auth()->user()->getAllpermissions();
//        return auth()->user()->getDirectpermissions();
//        return auth()->user()->getPermissionsViaRoles();
    }
}

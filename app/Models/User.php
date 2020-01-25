<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public function Department()
    {
        return $this->belongsTo(Department::class);
    }
    public function Book()
    {
        return $this->belongsToMany(Book::class);
    }
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllPermissionsAttribute() {
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (Auth::user()->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }
}

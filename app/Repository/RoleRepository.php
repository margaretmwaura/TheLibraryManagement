<?php


namespace App\Repository;


use App\Models\Role;
use App\Repository\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        $user = Auth::user();
        Log::info("The current user is ". $user);
        try {
            $role = $user->role->permissions->pluck('name');
        }
       catch (\Exception $e)
       {
           Log::info("Error while getting the role is " . $e->getMessage());
       }
       //The commented out line was causing an error
//        Log::info("The permissions of the authenticated user " .$role);
        return Role::all()->pluck('name');
    }

    public function storeRecord($input)
    {
         Role::create($input);
        $roles = Role::all()->pluck('name');
        return $roles;
    }

    public function deleteRecord($id)
    {
        $book = Role::find($id);
        Log::info("Data to be deleted " . $id);
        $book->delete();
    }

}

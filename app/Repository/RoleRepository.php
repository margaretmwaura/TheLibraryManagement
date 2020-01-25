<?php


namespace App\Repository;


use App\Models\Role;
use App\Repository\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::all()->pluck('name');
    }

    public function storeRecord($input)
    {
        return Role::create($input);
    }

    public function deleteRecord($id)
    {
        $book = Role::find($id);
        Log::info("Data to be deleted " . $id);
        $book->delete();
    }

}

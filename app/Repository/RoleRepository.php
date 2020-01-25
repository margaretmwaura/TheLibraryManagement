<?php


namespace App\Repository;


use App\Models\Role;
use App\Repository\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::all();
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

    public function updateRecord(Request $request, $id)
    {

    }
}

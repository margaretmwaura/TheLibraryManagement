<?php


namespace App\Repository;


use App\Models\Permission;
use App\Repository\Interfaces\BookRepositoryInterface;
use App\Repository\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all()
    {
        return Permission::all();
    }

    public function storeRecord($input)
    {
        return Permission::create($input);

    }

    public function deleteRecord($id)
    {
        $book = Permission::find($id);
        Log::info("Data to be deleted " . $id);
        $book->delete();
    }

    public function updateRecord(Request $request, $id)
    {

    }
}


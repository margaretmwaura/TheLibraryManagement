<?php


namespace App\Repository\Interfaces;



use Illuminate\Http\Request;

interface PermissionRepositoryInterface
{
    public function all();
    public function storeRecord($request);
    public function deleteRecord($id);
    public function updateRecord(Request $request, $id);

}

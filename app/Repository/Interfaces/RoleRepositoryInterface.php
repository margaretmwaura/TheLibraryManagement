<?php


namespace App\Repository\Interfaces;



use Illuminate\Http\Request;

interface RoleRepositoryInterface
{
    public function all();
    public function storeRecord($request);
    public function deleteRecord($id);


}


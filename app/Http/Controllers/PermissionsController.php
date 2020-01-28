<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PermissionsController extends Controller
{
    public $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function index()
    {
        $permission = $this->permissionRepository->all();
        return response()->json($permission);
    }

    public function store(Request $request)
    {
        Log::info("This is the request " . $request);
       $perms =  $this->permissionRepository->storeRecord($request->all());
        return response()->json($perms);
    }
    public function update(Request $request, $id)
    {
        $this->permissionRepository->updateRecord($request, $id);
    }
    public function destroy($id)
    {
        $this->permissionRepository->deleteRecord($id);
    }
}

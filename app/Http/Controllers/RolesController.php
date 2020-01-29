<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\BookRepositoryInterface;
use App\Models\Role;
use App\Repository\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RolesController extends Controller
{
    public $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository=$roleRepository;
        $this->middleware('Admin');
    }
    public function index()
    {
        $roles=$this->roleRepository->all();
        return response()->json($roles);
    }

    public function store(Request $request)
    {
        Log::info("This is the request ".$request);
        $roles=$this->roleRepository->storeRecord($request->all());
        return response()->json($roles);

    }

    public function update(Request $request, $id)
    {
        $this->roleRepository->updateRecord($request, $id);
    }


    public function destroy($id)
    {
        $this->roleRepository->deleteRecord($id);
    }
}

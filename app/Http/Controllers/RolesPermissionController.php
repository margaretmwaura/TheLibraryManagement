<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RolesPermissionController extends Controller
{

    public function getAllPerms()
    {
        $roles = Role::all();
        $collection = collect([]);
        try{
            $roles->each(function ($item, $key) use ($collection) {

                Log::info($item->id);
                Log::info($item->permissions->pluck('name'));
                $collection->push($item->permissions->pluck('name'));
                Log::info($collection);

            });
        }
        catch (\Exception $e)
        {
            Log::info("The reasons for not getting the collection " . $e->getMessage());
        }
        return response()->json($collection);
    }

    public function assignRoles(Request $request)
    {
       Log::info("The request received " . $request);
    }
}

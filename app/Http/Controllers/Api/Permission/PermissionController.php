<?php

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function rolelist()
    {
        $roles = Role::All();
        if ($roles) {
            return response()->json(['roles' => $roles], 200);
        } else {
            return response()->json(['message' => 'Failed'], 400);
        }
    }

    public function getrole($id)
    {
    }

    public function permissionlist()
    {
        $permissions = Permission::All();
        if ($permissions) {
            return response()->json(['permissions' => $permissions], 200);
        } else {
            return response()->json(['message' => 'Failed'], 400);
        }
    }
}
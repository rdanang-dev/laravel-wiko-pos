<?php

namespace App\Http\Controllers\Api\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function rolelist()
    {
        $roles = Role::all();
        if ($roles) {
            return response()->json(['roles' => $roles], 200);
        } else {
            return response()->json(['message' => 'Failed'], 400);
        }
        // dd($roles);
        // return response()->json($roles);
    }
}
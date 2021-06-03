<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $findAllUser = User::orderBy('created_at', 'desc');
        if ($request->filter) {
            $findAllUser = $findAllUser->where('name', 'like', "%$request->filter%");
        }
        if ($request->privileges == "Admin") {
            $findAllUser = $findAllUser->role('admin');
        }
        if ($request->privileges == "Kasir") {
            $findAllUser = $findAllUser->role('kasir');
        }
        $findAllUser = $findAllUser->get();
        return UserResource::collection($findAllUser);
    }

    public function store()
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $payloadUser = [
            'name' => request()->name,
            'email' => request()->email,
            'password' => bcrypt(request()->password)
        ];

        if (request('image')) {
            $payloadUser['image'] = Storage::disk('s3')->put('user', request()->file('image'), 'public');
        }


        $res = User::create(
            $payloadUser
        );

        if (request()->role_id) {
            $res->assignRole(request()->role_id);
        }

        return response()->json($res);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'email' => "required|unique:users,email,$id",
            'password' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'role_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::findOrFail($id);

        $payloadUser = [
            'name' => request()->name,
            'email' => request()->email,
        ];

        if (request()->password) {
            $payloadUser['password'] = bcrypt(request()->password);
        }

        if (request()->role_id) {
            $user->syncRoles(request()->role_id);
        }

        // if (request()->file('image')) {
        //     if (Storage::disk('s3')->exists($user->image)) {
        //         Storage::disk('s3')->delete($user->image);
        //     }
        //     $payloadUser['image'] = Storage::disk('s3')->put('user', request()->file('image'), 'public');
        // }
        if (request('image')) {
            if (Storage::disk('s3')->exists($user->image)) {
                Storage::disk('s3')->delete($user->image);
            }
            $payloadUser['image'] = Storage::disk('s3')->put('user', request()->file('image'), 'public');
        }

        $user->update($payloadUser);

        return response()->json($user);
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return new UserResource($data);
    }

    public function destroy($id)
    {
        $findUser = User::findOrFail($id);
        if (Storage::disk('s3')->exists($findUser->image)) {
            Storage::disk('s3')->delete($findUser->image);
        }
        $deleteUser = $findUser->delete();
        if (!$deleteUser) {
            return response()->json(['message' => "Delete User Failed"], 500);
        }
        return response()->json($findUser, 200);
    }

    public function rolelist()
    {
        $roles = Role::All();
        if ($roles) {
            return response()->json(['roles' => $roles], 200);
        } else {
            return response()->json(['message' => 'Failed'], 400);
        }
    }
}

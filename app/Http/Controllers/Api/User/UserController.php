<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $findAllUser = User::orderBy('created_at', 'desc')->get();
        return response()->json($findAllUser);
    }

    public function store()
    {
        $validator = validator(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $res = User::create(
            [
                'name' => request()->name,
                'email' => request()->email,
                'password' => bcrypt(request()->password)
            ]
        );
        return response()->json($res);
    }

    public function update($id)
    {
        request()->validate([
            'name' => 'required',
            'email' => "required|unique:users,email,$id",
            'password' => 'required',
        ]);

        $user = User::findOrFail($id);

        $res = $user->update(
            [
                'name' => request()->name,
                'email' => request()->email,
                'password' => bcrypt(request()->password)
            ]
        );
        return response()->json($user);
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $findUser = User::findOrFail($id);
        $deleteUser = $findUser->delete();
        if (!$deleteUser) {
            return response()->json(['message' => "Delete User Failed"], 500);
        }
        return response()->json($findUser, 200);
    }
}
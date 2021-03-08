<?php

namespace App\Http\Controllers\Api\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    public function index()
    {
        $findAllMenu = Menu::orderBy('created_at', 'desc')->get();

        return response()->json($findAllMenu);
    }

    public function store()
    {

        $validator = validator(request()->all(), [
            'nama' => 'required|unique:menus,nama',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $res = Menu::Create(
            [
                'nama' => request()->nama,
                'slug' => Str::slug(request()->nama),
                'harga' => request()->harga
            ]
        );
        return response()->json($res);
    }

    public function update($id)
    {
        request()->validate([
            'nama' => "required|unique:menus,nama,$id",
            'harga' => 'required',
        ]);

        $findMenu = Menu::findOrFail($id);

        $res = $findMenu->update(
            [
                'nama' => request()->nama,
                'slug' => Str::slug(request()->nama),
                'harga' => request()->harga
            ]
        );
        return response()->json($findMenu);
    }

    public function show($id)
    {
        $data = Menu::findOrFail($id);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $findMenu = Menu::findOrFail($id);
        $deleteMenu = $findMenu->delete();
        if (!$deleteMenu) {
            return response()->json(['message' => "Delete Menu Failed"], 500);
        }
        return response()->json($findMenu, 200);
    }
}

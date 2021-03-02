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
        $findAllMenu = Menu::get();

        return response()->json($findAllMenu);
    }

    // public function store(Request $request, Menu $menu)
    // {
    //     if (!$request->id) {
    //         request()->validate([
    //             'nama' => 'required|unique:menus,nama' . $menu->id,
    //             'harga' => 'required',
    //         ]);
    //     } else {
    //         request()->validate([
    //             'nama' => 'required',
    //             'harga' => 'required',
    //         ]);
    //     }

    //     $res = Menu::updateOrCreate(
    //         ['id' => $request->id],
    //         [
    //             'nama' => $request->nama,
    //             'slug' => Str::slug($request->nama),
    //             'harga' => $request->harga
    //         ]
    //     );
    //     return response()->json($res);
    // }

    // public function edit($id)
    // {
    //     $data = Menu::findOrFail($id);
    //     return response()->json($data);
    // }

    // public function delete($id)
    // {
    //     $findMenu = Menu::findOrFail($id);
    //     $deleteMenu = $findMenu->delete();
    //     if (!$deleteMenu) {
    //         return response()->json(['message' => "Delete Menu Failed"], 500);
    //     }
    //     return response()->json($findMenu, 200);
    // }
}

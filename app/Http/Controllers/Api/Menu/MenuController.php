<?php

namespace App\Http\Controllers\Api\Menu;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    public function index()
    {
        $findAllMenu = Menu::orderBy('created_at', 'desc')->get();

        return MenuResource::collection($findAllMenu);
    }

    public function store()
    {

        $validator = validator(request()->all(), [
            'nama' => 'required|unique:menus,nama',
            'harga' => 'required',
            'image' => 'nullable|image|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $payloadMenu = [
            'nama' => request()->nama,
            'slug' => Str::slug(request()->nama),
            'harga' => request()->harga,
        ];

        if (request('image')) {
            // request()->file('image')->store()
            $payloadMenu['image'] = Storage::disk('s3')->put('menu', request()->file('image'), 'public');
        }

        $res = Menu::create(
            $payloadMenu
        );
        return response()->json($res);
    }

    public function update($id)
    {
        request()->validate([
            'nama' => "required|unique:menus,nama,$id",
            'harga' => 'required',
            'image' => 'nullable|image|max:2000',
        ]);

        $findMenu = Menu::findOrFail($id);

        $payloadMenu = [
            'nama' => request()->nama,
            'slug' => Str::slug(request()->nama),
            'harga' => request()->harga,
        ];

        if (request('image')) {
            $payloadMenu['image'] = Storage::disk('s3')->put('menu', request()->file('image'), 'public');
        }
        $findMenu->update(
            $payloadMenu
        );
        return response()->json($findMenu);
    }

    public function show($id)
    {
        $data = Menu::findOrFail($id);
        return new MenuResource($data);
    }

    public function destroy($id)
    {
        $findMenu = Menu::findOrFail($id);
        if (Storage::disk('s3')->exists($findMenu->image)) {
            Storage::disk('s3')->delete($findMenu->image);
        }
        $deleteMenu = $findMenu->delete();
        if (!$deleteMenu) {
            return response()->json(['message' => "Delete Menu Failed"], 500);
        }
        return response()->json($findMenu, 200);
    }
}

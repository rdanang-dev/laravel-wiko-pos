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
            'name' => 'required|unique:menus,name',
            'price' => 'required',
            'image' => 'nullable|image|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $payloadMenu = [
            'name' => request()->name,
            'slug' => Str::slug(request()->name),
            'price' => request()->price,
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
            'name' => "required|unique:menus,name,$id",
            'price' => 'required',
            'image' => 'nullable|image|max:2000',
        ]);

        $findMenu = Menu::findOrFail($id);

        $payloadMenu = [
            'name' => request()->name,
            'slug' => Str::slug(request()->name),
            'price' => request()->price,
        ];

        if (request()->file('image')) {
            if (Storage::disk('s3')->exists($findMenu->image)) {
                Storage::disk('s3')->delete($findMenu->image);
            }
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
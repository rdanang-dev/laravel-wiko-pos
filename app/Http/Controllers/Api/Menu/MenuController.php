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

    public function index(Request $request)
    {
        $findAllMenu = Menu::orderBy('created_at', 'desc');
        if ($request->filter) {
            $findAllMenu = $findAllMenu->where('name', 'like', "%$request->filter%");
        }
        if ($request->has('per_page')) {
            $perPage = 5;
            if ($request->per_page) {
                $perPage = $request->per_page;
                $findAllMenu = $findAllMenu->paginate($perPage);
            }
        } else {
            $findAllMenu = $findAllMenu->get();
        }
        return MenuResource::collection($findAllMenu);
    }

    public function store()
    {
        $validator = validator(request()->all(), [
            'name' => 'required|unique:menus,name',
            'price' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Task Failed', 'errors' => $validator->errors()], 400);
        }
        $payloadMenu = [
            'name' => request()->name,
            'price' => request()->price,
            'category_id' => request()->category_id,
        ];
        if (request('image')) {
            $payloadMenu['image'] = Storage::disk('s3')->put('menu', request()->file('image'), 'public');
        }
        $res = Menu::create(
            $payloadMenu
        );
        return response()->json($res);
    }

    public function update($id)
    {
        $validator = validator(request()->all(), [
            'name' => "required|unique:menus,name,$id",
            'price' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Task Failed', 'errors' => $validator->errors()], 400);
        }
        $findMenu = Menu::findOrFail($id);
        $payloadMenu = [
            'name' => request()->name,
            'price' => request()->price,
            'category_id' => request()->category_id,
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
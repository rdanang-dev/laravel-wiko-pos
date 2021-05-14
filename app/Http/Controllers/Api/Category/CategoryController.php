<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $findAllCategory = Category::orderBy('created_at', 'asc');
        if ($request->filter) {
            $findAllCategory = $findAllCategory->where('name', 'like', "%$request->filter%");
        }

        if ($request->has('per_page')) {
            $perPage = 5;
            if ($request->per_page) {
                $perPage = $request->per_page;
                $findAllCategory = $findAllCategory->paginate($perPage);
            }
        } else {
            $findAllCategory = $findAllCategory->get();
        }
        return CategoryResource::collection($findAllCategory);
    }

    public function categoryList()
    {
        $findAllCategory = Category::orderBy('created_at', 'asc')->get();
        return CategoryResource::collection($findAllCategory);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $res = Category::create(
            request()->all()
        );
        return response()->json($res);
    }

    public function update($id)
    {
        request()->validate([
            'name' => "required|unique:categories,name,$id",
        ]);
        $findCategory = Category::findOrFail($id);
        $findCategory->update(
            request()->all()
        );
        return response()->json($findCategory);
    }

    public function show($id)
    {
        $data = Category::findOrFail($id);
        return new CategoryResource($data);
    }

    public function destroy($id)
    {
        $findCategory = Category::findOrFail($id);
        $deleteCategory = $findCategory->delete();
        if (!$deleteCategory) {
            return response()->json(['message' => "Delete Category Failed"], 500);
        }
        return response()->json($findCategory, 200);
    }
}
<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{

    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();
        if (request()->ajax()) {
            return DataTables::of($menus)
                ->addIndexColumn()
                ->addColumn('created_at', function ($menu) {
                    return $menu->created_at->diffForHumans();
                })
                ->addColumn('action', function ($menu) {
                    return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $menu->id . '" data-original-title="Edit" class="btn btn-sm btn-success btnEditMenu">Edit</a>
                <a href="#" class="btn btn-sm btn-danger ml-1">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.menus.menu');
    }

    public function store(Request $request, Menu $menu)
    {
        request()->validate([
            'nama' => 'required|unique:menus,nama' . $menu->id,
            'harga' => 'required',
        ]);

        $res = Menu::updateOrCreate(
            ['id' => $request->id],
            [

                'nama' => $request->nama,
                'slug' => Str::slug($request->nama),
                'harga' => $request->harga
            ]
        );
        return response()->json($res);
    }



    public function edit($id)
    {
        $data = Menu::findOrFail($id);
        return response()->json($data);
    }
}
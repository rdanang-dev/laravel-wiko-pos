<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    // public function getdatamenu()
    // {
    //     $menus = Menu::get();
    //     return DataTables::of($menus)
    //         ->addIndexColumn()wwww
    //         ->addColumn('created_at', function ($menu) {
    //             return $menu->created_at->diffForHumans();
    //         })
    //         ->addColumn('action', function ($menu) {
    //             return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $menu->slug . '" data-original-title="Edit" class="btn btn-sm btn-success btnEditMenu">Edit</a>
    //             <a href="#" class="btn btn-sm btn-danger ml-1">Delete</a>';
    //         })
    //         ->rawColumns(['action', 'action'])
    //         ->toJson();
    // }

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
                    $button = "<a href='javascript:void(0)' data-toggle='tooltip'  data-id={$menu->id} data-original-title='Edit' class='btn btn-sm btn-success btnEditMenu'>Edit</a>";

                    $button .= "<a href='#' data-id={$menu->id} data-original-title='Delete' class='btn btn-sm btn-danger ml-1 btnDeleteMenu'>Delete</a>";
                    return $button;

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.menus.menu');
    }


    // public function store()
    // {
    //     request()->validate([
    //         'nama' => 'required|unique:menus,nama',
    //         'harga' => 'required',
    //     ]);

    //     Menu::create([
    //         'nama' => request('nama'),
    //         'slug' => Str::slug(request('nama')),
    //         'harga' => request('harga')
    //     ]);

    //     return back()->with('success', 'Menu was Created');
    // }

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
        // $here = array('slug' => $slug);
        // $data = Menu::where($here)->first();
        $data = Menu::findOrFail($id);
        return response()->json($data);
    }


    public function delete($id){
        $findMenu = Menu::findOrFail($id);
        $deleteMenu = $findMenu->delete();
        if(!$deleteMenu){
            return response()->json(['message' => "Delete Menu Failed"],500);
        }
        return response()->json($findMenu,200);
    }

    // public function update(Menu $menu)
    // {
    //     request()->validate([
    //         'nama' => 'required|unique:menus,nama' . $menu->slug,
    //         'harga' => 'required',
    //     ]);

    //     $menu->update([
    //         'nama' => request('nama'),
    //         'slug' => Str::slug(request('nama')),
    //         'harga' => request('harga')
    //     ]);

    //     // dd($menu);
    //     return back()->with('success', 'Menu was Updated');
    // }
}
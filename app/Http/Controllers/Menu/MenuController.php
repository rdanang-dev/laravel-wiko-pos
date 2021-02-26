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
        return view('backend.menus.menu', []);
    }

    public function store()
    {
        request()->validate([
            'nama' => 'required|unique:menus,nama',
            'harga' => 'required',
        ]);

        Menu::create([
            'nama' => request('nama'),
            'slug' => Str::slug(request('nama')),
            'harga' => request('harga')
        ]);

        return back()->with('success', 'Menu was Created');
    }


    public function getdatamenu()
    {
        $menus = Menu::get();
        return DataTables::of($menus)
            ->addIndexColumn()
            ->addColumn('created_at', function ($menu) {
                return $menu->created_at->diffForHumans();
            })
            // ->addColumn('action', function ($menu) {
            //     return '<a href="' . route('menus.update', $menu) . '" class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#editMenuModal">Edit</a>
            //     <a href="#" class="btn btn-sm btn-outline-danger ml-1">Delete</a>';
            // })
            ->addColumn('action', function ($menu) {
                return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $menu->slug . '" data-original-title="Edit" class="btn btn-sm btn-success btnEditMenu">Edit</a>
                <a href="#" class="btn btn-sm btn-danger ml-1">Delete</a>';
            })
            // ->addColumn('action', function ($menu) {
            //     return '<a href="#" class="btn btn-sm btn-outline-success btnEditModal">Edit</a>
            //     <a href="#" class="btn btn-sm btn-outline-danger ml-1">Delete</a>';
            // })
            ->rawColumns(['action', 'action'])
            ->toJson();
    }

    public function edit($slug)
    {
        $here = array('slug' => $slug);
        $data = Menu::where($here)->first();

        return response()->json($data);
    }

    public function update(Menu $menu)
    {
        request()->validate([
            'nama' => 'required|unique:menus,nama' . $menu->id,
            'harga' => 'required',
        ]);

        $menu->update([
            'nama' => request('nama'),
            'slug' => Str::slug(request('nama')),
            'harga' => request('harga')
        ]);

        dd($menu);
        // return back()->with('success', 'Menu was Updated');
    }
}
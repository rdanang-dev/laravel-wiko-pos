<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        return view('backend.menus.menu', []);
    }

    public function getdatamenu()
    {
        $menus = Menu::select('menus.*');
        return DataTables::eloquent($menus)
            ->addIndexColumn()
            ->addColumn('created_at', function (Menu $menu) {
                return $menu->created_at->diffForHumans();
            })
            ->addColumn('action', 'backend.menus.buttons')
            ->rawColumns(['action'])
            ->toJson();
    }
}
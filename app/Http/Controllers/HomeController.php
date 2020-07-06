<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Koneksi ke DB
use DB;

class HomeController extends Controller
{
    // Variabel
    private $list_menu;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menu_list = $this->get_menu_item();
        return view('home')->with(compact('menu_list'));
    }

    // Laman User Management
    public function user_management()
    {
        $menu_list = $this->get_menu_item();
        return view('home')->with(compact('menu_list'));
    }

    // Dapatkan list menu
    private function get_menu_item($array_menu = [], $parent_menu = 0)
    {
        $tempArray = DB::table('to_menu')->select('id', 'parent_menu', 'menu_name', 'menu_icon', 'menu_link', 'menu_child')
            ->whereIn('id', function ($query){
                $query->select('menu_id')->from('to_user_access')->where('user_level', '=', auth()->user()->user_level);
            })->where([
                ['is_enabled', '=', '1']
                , ['parent_menu', '=', $parent_menu]
            ])->get();
        foreach ($tempArray as $array) {
            if ($array->menu_child == 1) {
                $array->sub_child = $this->get_menu_item([], $array->id);
            }
        }
        return $tempArray;
    }
}

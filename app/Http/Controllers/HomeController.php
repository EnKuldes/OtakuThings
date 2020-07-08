<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Koneksi ke DB
use DB;

// Masang Traits
use App\Traits\MenuTrait;

class HomeController extends Controller
{
    // Makai Fungsi yang disediaiin Traits
    use MenuTrait;

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
    
    // Halaman Awal
    public function get_first_page($array_menu = [], $parent_menu = 0)
    {
        $tempArray = DB::table('to_menu')->select('id', 'parent_menu', 'menu_name', 'menu_icon', 'menu_link', 'menu_child')
            ->whereIn('id', function ($query){
                $query->select('menu_id')->from('to_user_access')->where('user_level', '=', auth()->user()->user_level);
            })->where([
                ['is_enabled', '=', '1']
                , ['parent_menu', '=', $parent_menu]
            ])->first();
        return redirect($tempArray->menu_link);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Koneksi ke DB
use DB;

// Masang Traits
use App\Traits\MenuTrait;

class AdminController extends Controller
{
	// Makai Fungsi yang disediaiin Traits
    use MenuTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');//->except(['index']);
    }

    // Laman User Management
    public function user_management()
    {
    	if (! $this->can_access(\Request::path())) {
    		abort(401);
    	}

        $menu_list = $this->get_menu_item();
        return view('utilities.user-managements')->with(compact('menu_list'));
    }

    // Laman Menu Management
    public function menu_management()
    {
        if (! $this->can_access(\Request::path())) {
    		abort(401);
    	}
    	
        $menu_list = $this->get_menu_item();
        return view('utilities.menu-managements')->with(compact('menu_list'));
    }
}

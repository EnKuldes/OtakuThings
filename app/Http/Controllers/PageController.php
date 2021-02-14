<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
	// Declare Menu List
	private $list_menu;

	public function __construct()
    {
        $this->list_menu = collect([
        	(object) ['menu_link' => '', 'menu_icon' => 'feather icon-search', 'menu_name' => 'Pencarian Anime&Manga', 'menu_child' => 0, 'sub_child' => collect([])],
        	(object) ['menu_link' => 'top_rank', 'menu_icon' => 'feather icon-award', 'menu_name' => 'Top Rank Anime&Manga', 'menu_child' => 0, 'sub_child' => collect([])],
        	(object) ['menu_link' => 'jadwal_tayang', 'menu_icon' => 'feather icon-film', 'menu_name' => 'Jadwal Tayang Anime', 'menu_child' => 0, 'sub_child' => collect([])],
        	(object) ['menu_link' => 'seasonal_anime', 'menu_icon' => 'feather icon-monitor', 'menu_name' => 'Seasonal Anime', 'menu_child' => 0, 'sub_child' => collect([])]
        ]);
    }

    // Controller mengatur halaman mana yang mau di akses 
    
    public function index($value='')
    {
    	$menu_list = $this->list_menu;
    	return view('otaku.index')->with(compact('menu_list'));
    }

    public function search(Request $request)
    {
    	// dd($request->all());
    	$data = collect($request->all());
    	$menu_list = $this->list_menu;
    	return view('otaku.search')->with(compact('menu_list'))->with(compact('data'));
    }

    public function detail($type, $mal_id)
    {
    	$data['type'] = $type;
    	$data['mal_id'] = $mal_id;
    	$menu_list = $this->list_menu;
    	return view('otaku.detail')->with(compact('menu_list'))->with(compact('data'));
    }

    public function top_rank(Request $request)
    {
    	$menu_list = $this->list_menu;
    	$data = [];
    	return view('otaku.top-rank')->with(compact('menu_list'))->with(compact('data'));
    }

    public function seasonal_anime(Request $request)
    {
    	$menu_list = $this->list_menu;
    	$data = [];
    	return view('otaku.seasonal-anime')->with(compact('menu_list'))->with(compact('data'));
    }

    public function jadwal_tayang($value='')
    {
    	$menu_list = $this->list_menu;
    	$data = [];
    	return view('otaku.jadwal-tayang')->with(compact('menu_list'))->with(compact('data'));
    }

    
}

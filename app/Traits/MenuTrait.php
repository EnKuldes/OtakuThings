<?php
namespace App\Traits;

// Incase perlu parameter dari request
use Illuminate\Http\Request;
// Incase perlu koneksi ke DB
use DB;
  
trait MenuTrait {
  
    // Dapatkan list menu
    public function get_menu_item($array_menu = [], $parent_menu = 0)
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

    // Check Access
    public function can_access($menu_url)
    {
    	return DB::table('to_menu')->join('to_user_access', 'to_menu.id', '=', 'to_user_access.menu_id')->where([
    		['to_user_access.user_level', '=', auth()->user()->user_level]
    		, ['to_menu.menu_link', '=', $menu_url]
    		, ['to_menu.is_enabled', '=', '1']
    	])->exists();
    }
  
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Koneksi ke DB
use DB;

// Datatables
use yajra\Datatables\Datatables;

// Masang Traits
use App\Traits\MenuTrait;

// Laravel Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;

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
        $list_user_level = $this->list_user_level();
        return view('utilities.menu-managements')->with(compact('menu_list'))->with(compact('list_user_level'));
    }

    // Laman Upload dan set Target
    public function uploads_and_targets()
    {
        if (! $this->can_access(\Request::path())) {
    		abort(401);
    	}
    	
        $menu_list = $this->get_menu_item();
        return view('utilities.uploads-and-targets')->with(compact('menu_list'));
    }

    // List User
    public function list_user(Request $request = null)
    {
    	$datas = DB::table('users')->join('to_user_level', 'users.user_level', '=', 'to_user_level.id');
    	if ( request()->ajax() ) {
    		if ( $request->search['value'] ) {
    			$datas->where('name', 'like', '%'.$request->search['value'].'%');
    		}
    	}
    	if (auth()->user()->user_level != 4) {
    		$datas->whereNotIn('users.user_level', [4]);
    	}
    	$datas = $datas->select('users.id', 'users.name', 'users.email', 'users.perner', 'users.username', 'users.posisi', 'users.user_level as user_level_id', 'users.is_enabled', 'to_user_level.user_level')->get();
    	$datas->map(function ($datas, $i) {
	      $datas->status = $datas->is_enabled == 1 ? 'Aktif' : 'Tidak Aktif';
	      $datas->action = '<button class="btn btn-icon btn-outline-dark" data-toggle="modal" data-target="#add-user" onclick="f_edit_user('.$datas->id.', \''.$datas->name.'\', \''.$datas->email.'\', \''.$datas->perner.'\', \''.$datas->username.'\', \''.$datas->posisi.'\', '.$datas->user_level_id.', '.$datas->is_enabled.')"> <i class="feather icon-edit"></i> </button>';
	      $datas->i = ++$i;
	      return $datas;
	    });

	    return $datas;
    }
    // List User Level
    public function list_user_level(Request $request = null)
    {
    	$datas = DB::table('to_user_level');
    	if (auth()->user()->user_level != 4) {
    		$datas->whereNotIn('id', [4]);
    	}
    	$datas = $datas->select('id', 'user_level', 'user_level_desc', 'is_enabled')->get();
    	$datas->map(function ($datas, $i) {
	      $datas->status = $datas->is_enabled == 1 ? 'Aktif' : 'Tidak Aktif';
	      $datas->action = '<button class="btn btn-icon btn-outline-dark" data-toggle="modal" data-target="#add-user-level" onclick="f_edit_user_level('.$datas->id.', \''.$datas->user_level.'\', \''.$datas->user_level_desc.'\', '.$datas->is_enabled.')"> <i class="feather icon-edit"></i> </button>';
	      $datas->i = ++$i;
	      return $datas;
	    });

	    return $datas;
    }

    public function datatables_list_user(Request $request)
    {
    	$datas = $this->list_user($request);

	    return DataTables::of($datas)->toJson();
    }
    public function ajax_list_user(Request $request)
    {
    	$datas = $this->list_user_level();

	    return response()->json($datas, 200);
    }
    // List User Level
    public function datatables_list_user_level(Request $request)
    {
    	$datas = $this->list_user_level($request);

	    return DataTables::of($datas)->toJson();
    }

    // SSImpan User
    public function save_user(Request $request)
    {
    	$messages = [
    		'name.required' => "Field Nama wajib diisi!",
    		'perner.required' => "Field Perner wajib diisi!",
    		'username.required' => "Field Username wajib diisi!",
    		'email.required' => "Field Email wajib diisi!",
    		'posisi.required' => "Field Posisi wajib diisi!",
    		'user_level.required' => "Field User Level wajib diisi!",
    		// 'is_enabled.required' => "Field Aktif wajib diisi!",
    	];
      # Rules Validation
    	$validation = $this->validate($request, [
    		'name' => 'required',
    		'perner' => 'required',
    		'username' => 'required',
    		'email' => 'required',
    		'posisi' => 'required',
    		'user_level' => 'required',
    		// 'is_enabled' => 'required',
    	], $messages);

    	try {
    		if ($request->is_enabled == 'on') {
    			$is_enabled = '1';
    		}
    		else{
    			$is_enabled = '0';
    		}
    		$user = DB::table('users')->updateOrInsert(
    			['id' => $request->id_user],
    			[
    				'name' => $request->name
    				, 'perner' => $request->perner
    				, 'username' => $request->username
    				, 'email' => $request->email
    				, 'posisi' => $request->posisi
    				, 'user_level' => $request->user_level
    				, 'is_enabled' => $is_enabled
    				, 'updated_at' => \Carbon\Carbon::now()
    			]
    		);
    		return response()->json('success', 200);
    	} catch (\Illuminate\Database\QueryException $e) {
    		// Do whatever you need if the query failed to execute
    		return response()->json('Error saat menyimpan data.', 500);
    	}
    }
    // SSImpan User level
    public function save_user_level(Request $request)
    {
    	$messages = [
    		'user_level.required' => "Field User Level wajib diisi!",
    		'user_level_desc.required' => "Field Deskripsi Level wajib diisi!",
    		// 'is_enabled.required' => "Field Username wajib diisi!",
    		
    	];
      # Rules Validation
    	$validation = $this->validate($request, [
    		'user_level' => 'required',
    		'user_level_desc' => 'required',
    		// 'is_enabled' => 'required',
    	], $messages);

    	try {
    		if ($request->is_enabled == 'on') {
    			$is_enabled = '1';
    		}
    		else{
    			$is_enabled = '0';
    		}
    		$user_level = DB::table('to_user_level')->updateOrInsert(
    			['id' => $request->id_user_level],
    			[
    				'user_level' => $request->user_level
    				, 'user_level_desc' => $request->user_level_desc
    				, 'is_enabled' => $is_enabled
    				, 'updated_at' => \Carbon\Carbon::now()
    			]
    		);
    		$user = DB::table('users')->where('user_level', $request->id_user_level)->update(['is_enabled' => $is_enabled]);
    		return response()->json('success', 200);
    	} catch (\Illuminate\Database\QueryException $e) {
    		// Do whatever you need if the query failed to execute
    		return response()->json('Error saat menyimpan data.', 500);
    	}
    }

    // Get Menu List
    public function list_menu($array_menu = [], $parent_menu = 0, $user_level)
    {
    	// 
    	$userAccess = DB::table('to_user_access')->where('user_level', '=', $user_level)->select('menu_id');
    	$menu = DB::table('to_menu')->select('to_menu.id', 'to_menu.parent_menu', 'to_menu.menu_name', 'to_menu.menu_child', 'to_menu.menu_icon', 'to_menu.menu_link', DB::raw('IF(to_menu.id = to_user_access.menu_id, 1, 0) AS kondisi'))
    		->leftJoinSub($userAccess, 'to_user_access', function ($join) {
            	$join->on('to_menu.id', '=', 'to_user_access.menu_id');
        	})->where('to_menu.parent_menu', '=', $parent_menu)->get();
    	foreach ($menu as $array) {
            if ($array->menu_child == 1) {
                $array->sub_child = $this->list_menu([], $array->id, $user_level);
            }
        }
    	return $menu;
    }
    public function ajax_list_menu(Request $request)
    {
    	$datas = $this->list_menu([], 0, $request->user_level);

	    return response()->json($datas, 200);
    }
    public function ajax_list_parent_menu(Request $request)
    {
    	$datas = DB::table('to_menu')->select('to_menu.id', 'to_menu.menu_name')->where('to_menu.parent_menu', '=', 0)->get();

    	return response()->json($datas, 200);
    }

    // Save Menu
    public function save_menu(Request $request)
    {
    	$messages = [
    		'menu_name.required' => "Field Nama Menu wajib diisi!",
    		'menu_link.required' => "Field Menu Link wajib diisi!",
    		'menu_link.required' => "Field Menu Icon wajib diisi!",
    		// 'is_enabled.required' => "Field Username wajib diisi!",
    		
    	];
      # Rules Validation
    	$validation = $this->validate($request, [
    		'menu_name' => 'required',
    		'menu_link' => 'required',
    		'menu_icon' => 'required',
    		// 'is_enabled' => 'required',
    	], $messages);

    	try {
    		$menu = DB::table('to_menu')->updateOrInsert(
    			['id' => $request->id_menu],
    			[
    				'parent_menu' => $request->parent_menu
    				, 'menu_name' => $request->menu_name
    				, 'menu_child' => $request->menu_child
    				, 'menu_link' => $request->menu_link
    				, 'menu_icon' => $request->menu_icon
    				, 'updated_at' => \Carbon\Carbon::now()
    			]
    		);
    		return response()->json('success', 200);
    	} catch (\Illuminate\Database\QueryException $e) {
    		// Do whatever you need if the query failed to execute
    		return response()->json('Error saat menyimpan data.', 500);
    	}
    }

    // Save User Access
    public function save_user_access(Request $request)
    {
    	$messages = [
    		'user_level.required' => "User Level Wajib diisi!",
    		'checked_menu.required' => "Checked Menu wajib disertakan!",
    		'unchecked_menu.required' => "UnChecked Menu wajib disertakan!",
    		// 'is_enabled.required' => "Field Username wajib diisi!",
    		
    	];
      # Rules Validation
    	$validation = $this->validate($request, [
    		'user_level' => 'required',
    		'checked_menu' => 'required',
    		'unchecked_menu' => 'required',
    		// 'is_enabled' => 'required',
    	], $messages);

    	try {
    		for ($i=0; $i < count($request->checked_menu) ; $i++) { 
	    		DB::table('to_user_access')->updateOrInsert(
	    			['user_level' => $request->user_level, 'menu_id' => $request->checked_menu[$i]]
	    			, ['updated_at' => \Carbon\Carbon::now()]
	    		);
    		}
    		DB::table('to_user_access')->where('user_level', '=', $request->user_level)->whereIn('menu_id', $request->unchecked_menu)->delete();
    		return response()->json('success', 200);
    	} catch (\Illuminate\Database\QueryException $e) {
    		// Do whatever you need if the query failed to execute
    		return response()->json('Error saat menyimpan data.', 500);
    	}
    }

    // Upload files
    public function upload_data(Request $request)
    {
        $messages = [
            'file.required' => "File Wajib dilampirkan!",
            'file.mimes' => "Format File Tidak Sesuai!",
            // 'list_kolom.required' => "List Kolom belum diisi!",
            // 'is_enabled.required' => "Field Username wajib diisi!",
            
        ];
      # Rules Validation
        $validation = $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
            // 'list_kolom' => 'required',
            // 'is_enabled' => 'required',
        ], $messages);
        
        // Ambil file dan simpan ke folder upload
        $file = $request->file('file'); 
        /*$generated_filename = rand().$file->getClientOriginalName();
        $file->move('upload/data',$generated_filename);*/

        // Import Data
        // Excel::import(new DataImport($request), public_path('/upload/data/'.$generated_filename));
        Excel::import(new DataImport($request), $file);

        // notifikasi dengan session
        $request->session()->flash('message', ['success', 'Success', 'Suskes melakukan upload!']);
        return redirect()->route('utilities.uploads-and-targets');
    }
}

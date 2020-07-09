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
    		$datas->whereNotIn('user_level', [4]);
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
}

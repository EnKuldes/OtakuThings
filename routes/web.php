<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes([
	'register' => false, // Registration Routes...
	'reset' => false, // Password Reset Routes...
	'verify' => false, // Email Verification Routes...
	'confirm' => false, // Password Routes...
	'login' => false, // Login Routes...
]);

Route::get('/', 'PageController@index')->name('index');
Route::get('/search', 'PageController@search')->name('search');
Route::get('/detail/{type}/{mal_id}', 'PageController@detail')->name('detail');
Route::get('/top_rank', 'PageController@top_rank')->name('top_rank');
Route::get('/seasonal_anime', 'PageController@seasonal_anime')->name('seasonal_anime');
Route::get('/jadwal_tayang', 'PageController@jadwal_tayang')->name('jadwal_tayang');

// Disable Route ke Controller selain OtakuController
/*Route::get('/', 'HomeController@get_first_page')->name('redirect-first-page');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

// Utilities
Route::get('/utilities/user-managements', 'User\AdminController@user_management')->name('utilities.user-managements');
Route::get('/utilities/user-managements/list-user-datatables', 'User\AdminController@datatables_list_user')->name('utilities.user-managements.list-user-datatables');
Route::post('/utilities/user-managements/save-user', 'User\AdminController@save_user')->name('utilities.user-managements.save-user');

Route::get('/utilities/user-managements/list-user-level-datatables', 'User\AdminController@datatables_list_user_level')->name('utilities.user-managements.list-user-level-datatables');
Route::post('/utilities/user-managements/list-user-level-ajax', 'User\AdminController@ajax_list_user')->name('utilities.user-managements.list-user-level-ajax');
Route::post('/utilities/user-managements/save-user-level', 'User\AdminController@save_user_level')->name('utilities.user-managements.save-user-level');

Route::get('/utilities/menu-managements', 'User\AdminController@menu_management')->name('utilities.menu-managements');
Route::post('/utilities/menu-managements/list-menu-ajax', 'User\AdminController@ajax_list_menu')->name('utilities.menu-managements.list-menu-ajax');
Route::post('/utilities/menu-managements/list-parent-menu-ajax', 'User\AdminController@ajax_list_parent_menu')->name('utilities.menu-managements.list-parent-menu-ajax');
Route::post('/utilities/menu-managements/save-menu', 'User\AdminController@save_menu')->name('utilities.menu-managements.save-menu');
Route::post('/utilities/menu-managements/save-user-access', 'User\AdminController@save_user_access')->name('utilities.menu-managements.save-user-access');*/
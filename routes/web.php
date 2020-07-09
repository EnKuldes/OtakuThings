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
]);
Route::get('/', 'HomeController@get_first_page')->name('redirect-first-page');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

// App Agent
Route::get('/agent/workspace/consumer', 'HomeController@workspace_consumer')->name('agent.workspace-consumer');
Route::get('/agent/workspace/enterprise', 'HomeController@workspace_enterprise')->name('agent.workspace-enterprise');

// App Admin
// Utilities
Route::get('/utilities/user-managements', 'User\AdminController@user_management')->name('utilities.user-managements');
Route::get('/utilities/user-managements/list-user-datatables', 'User\AdminController@datatables_list_user')->name('utilities.user-managements.list-user-datatables');
Route::post('/utilities/user-managements/save-user', 'User\AdminController@save_user')->name('utilities.user-managements.save-user');

Route::get('/utilities/user-managements/list-user-level-datatables', 'User\AdminController@datatables_list_user_level')->name('utilities.user-managements.list-user-level-datatables');
Route::post('/utilities/user-managements/list-user-level-ajax', 'User\AdminController@ajax_list_user')->name('utilities.user-managements.list-user-level-ajax');
Route::post('/utilities/user-managements/save-user-level', 'User\AdminController@save_user_level')->name('utilities.user-managements.save-user-level');

Route::get('/utilities/menu-managements', 'User\AdminController@menu_management')->name('utilities.menu-managements');

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

// App
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/workspace/consumer', 'HomeController@workspace_consumer')->name('workspace.consumer');
Route::get('/workspace/enterprise', 'HomeController@workspace_enterprise')->name('workspace.enterprise');

// Utilities
Route::get('/utilities/user-managements', 'HomeController@user_management')->name('utilities.user-managements');

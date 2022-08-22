<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RightController;
use App\Http\Controllers\MenuController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

// Module
Route::get('/show_module', [ModuleController::class, 'showModule']);
Route::get('/add_module', [ModuleController::class, 'addModule']);
Route::post('/save_module', [ModuleController::class, 'saveModule']);
Route::get('/edit_module/{id}', [ModuleController::class, 'editModule']);
Route::post('/update_module/{id}', [ModuleController::class, 'updateModule']);
Route::get('/delete_module/{id}', [ModuleController::class, 'deleteModule']);

// User
Route::get('/show_user', [UserController::class, 'showUser']);
Route::get('/add_user', [UserController::class, 'addUser']);
Route::post('/save_user', [UserController::class, 'saveUser']);
Route::get('/edit_user/{id}', [UserController::class, 'editUser']);
Route::post('/update_user/{id}', [UserController::class, 'updateUser']);
Route::get('/delete_user/{id}', [UserController::class, 'deleteUser']);

// Role
Route::get('/show_role', [RoleController::class, 'showRole']);
Route::get('/add_role', [RoleController::class, 'addRole']);
Route::post('/save_role', [RoleController::class, 'saveRole']);
Route::get('/edit_role/{id}', [RoleController::class, 'editRole']);
Route::post('/update_role/{id}', [RoleController::class, 'updateRole']);
Route::get('/delete_role/{id}', [RoleController::class, 'deleteRole']);

// Right
Route::get('/show_right', [RightController::class, 'showRight']);
Route::get('/add_right', [RightController::class, 'addRight']);
Route::post('/save_right', [RightController::class, 'saveRight']);
Route::get('/edit_right/{id}', [RightController::class, 'editRight']);
Route::post('/update_right/{id}', [RightController::class, 'updateRight']);
Route::get('/delete_right/{id}', [RightController::class, 'deleteRight']);

// Menu
Route::get('/show_menu', [MenuController::class, 'showMenu']);
Route::get('/add_menu', [MenuController::class, 'addMenu']);
Route::post('/save_menu', [MenuController::class, 'saveMenu']);
Route::get('/edit_menu/{id}', [MenuController::class, 'editMenu']);
Route::post('/update_menu/{id}', [MenuController::class, 'updateMenu']);
Route::get('/delete_menu/{id}', [MenuController::class, 'deleteMenu']);

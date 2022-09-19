<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\ModuleController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\RoleSectionController;
// use App\Http\Controllers\RightController;
// use App\Http\Controllers\MenuController;
// use App\Http\Controllers\DepartmentController;

// LIMS Routes

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

// Role Section
Route::get('/show_role_section', [RoleSectionController::class, 'showRoleSection']);
Route::get('/add_role_section', [RoleSectionController::class, 'addRoleSection']);
Route::post('/save_role_section', [RoleSectionController::class, 'saveRoleSection']);
Route::get('/edit_role_section/{id}', [RoleSectionController::class, 'editRoleSection']);
Route::post('/update_role_section/{id}', [RoleSectionController::class, 'updateRoleSection']);
Route::get('/delete_role_section/{id}', [RoleSectionController::class, 'deleteRoleSection']);

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

// Department
Route::get('/show_department', [DepartmentController::class, 'showDepartment']);
Route::get('/add_department', [DepartmentController::class, 'addDepartment']);
Route::post('/save_department', [DepartmentController::class, 'saveDepartment']);
Route::get('/edit_department/{id}', [DepartmentController::class, 'editDepartment']);
Route::post('/update_department/{id}', [DepartmentController::class, 'updateDepartment']);
Route::get('/delete_department/{id}', [DepartmentController::class, 'deleteDepartment']);
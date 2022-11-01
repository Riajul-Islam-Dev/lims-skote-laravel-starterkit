<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Lims\ModuleController;
use App\Http\Controllers\Lims\UserController;
use App\Http\Controllers\Lims\RoleController;
use App\Http\Controllers\Lims\RoleSectionController;
use App\Http\Controllers\Lims\RightController;
use App\Http\Controllers\Lims\MenuController;
use App\Http\Controllers\Lims\DepartmentController;
use App\Http\Controllers\Lims\CriminalCaseController;
use App\Http\Controllers\Lims\CivilCaseController;

// LIMS Routes

// Module
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_module', [ModuleController::class, 'showModule'])->name('showModule');
    Route::get('add_module', [ModuleController::class, 'addModule'])->name('addModule');
    Route::post('save_module', [ModuleController::class, 'saveModule'])->name('saveModule');
    Route::get('edit_module/{id}', [ModuleController::class, 'editModule'])->name('editModule');
    Route::post('update_module/{id}', [ModuleController::class, 'updateModule'])->name('updateModule');
    Route::post('delete_module/{id}', [ModuleController::class, 'deleteModule'])->name('deleteModule');
});

// User
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_user', [UserController::class, 'showUser'])->name('showUser');
    Route::get('fetch_all_user', [UserController::class, 'fetchAllUser'])->name('fetchAllUser');
    Route::post('save_user', [UserController::class, 'saveUser'])->name('saveUser');
    Route::get('edit_user', [UserController::class, 'editUser'])->name('editUser');
    Route::post('update_user', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('delete_user', [UserController::class, 'deleteUser'])->name('deleteUser');
});

// Role
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_role', [RoleController::class, 'showRole'])->name('showRole');
    Route::get('add_role', [RoleController::class, 'addRole'])->name('addRole');
    Route::post('save_role', [RoleController::class, 'saveRole'])->name('saveRole');
    Route::get('edit_role/{id}', [RoleController::class, 'editRole'])->name('editRole');
    Route::post('update_role/{id}', [RoleController::class, 'updateRole'])->name('updateRole');
    Route::post('delete_role/{id}', [RoleController::class, 'deleteRole'])->name('deleteRole');
});

// Role Section
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_role_section', [RoleSectionController::class, 'showRoleSection'])->name('showRoleSection');
    Route::get('add_role_section', [RoleSectionController::class, 'addRoleSection'])->name('addRoleSection');
    Route::post('save_role_section', [RoleSectionController::class, 'saveRoleSection'])->name('saveRoleSection');
    Route::get('edit_role_section/{id}', [RoleSectionController::class, 'editRoleSection'])->name('editRoleSection');
    Route::post('update_role_section/{id}', [RoleSectionController::class, 'updateRoleSection'])->name('updateRoleSection');
    Route::post('delete_role_section/{id}', [RoleSectionController::class, 'deleteRoleSection'])->name('deleteRoleSection');
});

// Right
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_right', [RightController::class, 'showRight'])->name('showRight');
    Route::get('add_right', [RightController::class, 'addRight'])->name('addRight');
    Route::post('save_right', [RightController::class, 'saveRight'])->name('saveRight');
    Route::get('edit_right/{id}', [RightController::class, 'editRight'])->name('editRight');
    Route::post('update_right/{id}', [RightController::class, 'updateRight'])->name('updateRight');
    Route::post('delete_right/{id}', [RightController::class, 'deleteRight'])->name('deleteRight');
});

// Menu
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_menu', [MenuController::class, 'showMenu'])->name('showMenu');
    Route::get('add_menu', [MenuController::class, 'addMenu'])->name('addMenu');
    Route::post('save_menu', [MenuController::class, 'saveMenu'])->name('saveMenu');
    Route::get('edit_menu/{id}', [MenuController::class, 'editMenu'])->name('editMenu');
    Route::post('update_menu/{id}', [MenuController::class, 'updateMenu'])->name('updateMenu');
    Route::post('delete_menu/{id}', [MenuController::class, 'deleteMenu'])->name('deleteMenu');
});

// Department
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_department', [DepartmentController::class, 'showDepartment'])->name('showDepartment');
    Route::get('add_department', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
    Route::post('save_department', [DepartmentController::class, 'saveDepartment'])->name('saveDepartment');
    Route::get('edit_department/{id}', [DepartmentController::class, 'editDepartment'])->name('editDepartment');
    Route::post('update_department/{id}', [DepartmentController::class, 'updateDepartment'])->name('updateDepartment');
    Route::post('delete_department/{id}', [DepartmentController::class, 'deleteDepartment'])->name('deleteDepartment');
});

// Criminal Case
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_criminal_case', [CriminalCaseController::class, 'showCriminalCase'])->name('showCriminalCase');
    Route::get('fetch_all_criminal_case', [CriminalCaseController::class, 'fetchAllCriminalCase'])->name('fetchAllCriminalCase');
    Route::post('save_criminal_case', [CriminalCaseController::class, 'saveCriminalCase'])->name('saveCriminalCase');
    Route::get('edit_criminal_case', [CriminalCaseController::class, 'editCriminalCase'])->name('editCriminalCase');
    Route::post('update_criminal_case', [CriminalCaseController::class, 'updateCriminalCase'])->name('updateCriminalCase');
    Route::delete('delete_criminal_case', [CriminalCaseController::class, 'deleteCriminalCase'])->name('deleteCriminalCase');
});

// Civil Case
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_civil_case', [CivilCaseController::class, 'showCivilCase'])->name('showCivilCase');
    Route::get('fetch_all_civil_case', [CivilCaseController::class, 'fetchAllCivilCase'])->name('fetchAllCivilCase');
    Route::post('save_civil_case', [CivilCaseController::class, 'saveCivilCase'])->name('saveCivilCase');
    Route::get('edit_civil_case', [CivilCaseController::class, 'editCivilCase'])->name('editCivilCase');
    Route::post('update_civil_case', [CivilCaseController::class, 'updateCivilCase'])->name('updateCivilCase');
    Route::delete('delete_civil_case', [CivilCaseController::class, 'deleteCivilCase'])->name('deleteCivilCase');
});

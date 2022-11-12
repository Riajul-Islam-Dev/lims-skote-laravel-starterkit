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
use App\Http\Controllers\Lims\CourtController;
use App\Http\Controllers\Lims\DivisionController;
use App\Http\Controllers\Lims\DistrictController;
use App\Http\Controllers\Lims\PanelLawyerController;
use App\Http\Controllers\Lims\MeetingController;
use App\Http\Controllers\Lims\BillingController;

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
    Route::get('index_user', [UserController::class, 'indexUser'])->name('indexUser');
    Route::get('fetch_all_user', [UserController::class, 'fetchAllUser'])->name('fetchAllUser');
    Route::post('save_user', [UserController::class, 'saveUser'])->name('saveUser');
    Route::get('edit_user', [UserController::class, 'editUser'])->name('editUser');
    Route::post('update_user', [UserController::class, 'updateUser'])->name('updateUser');
    Route::delete('delete_user', [UserController::class, 'deleteUser'])->name('deleteUser');
    Route::get('show_user', [UserController::class, 'showUser'])->name('showUser');
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

// Court
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_court', [CourtController::class, 'showCourt'])->name('showCourt');
    Route::get('fetch_all_court', [CourtController::class, 'fetchAllCourt'])->name('fetchAllCourt');
    Route::post('save_court', [CourtController::class, 'saveCourt'])->name('saveCourt');
    Route::get('edit_court', [CourtController::class, 'editCourt'])->name('editCourt');
    Route::post('update_court', [CourtController::class, 'updateCourt'])->name('updateCourt');
    Route::delete('delete_court', [CourtController::class, 'deleteCourt'])->name('deleteCourt');
});

// Division
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_division', [DivisionController::class, 'showDivision'])->name('showDivision');
    Route::get('fetch_all_division', [DivisionController::class, 'fetchAllDivision'])->name('fetchAllDivision');
    Route::post('save_division', [DivisionController::class, 'saveDivision'])->name('saveDivision');
    Route::get('edit_division', [DivisionController::class, 'editDivision'])->name('editDivision');
    Route::post('update_division', [DivisionController::class, 'updateDivision'])->name('updateDivision');
    Route::delete('delete_division', [DivisionController::class, 'deleteDivision'])->name('deleteDivision');
});

// District
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('show_district', [DistrictController::class, 'showDistrict'])->name('showDistrict');
    Route::get('fetch_all_district', [DistrictController::class, 'fetchAllDistrict'])->name('fetchAllDistrict');
    Route::post('save_district', [DistrictController::class, 'saveDistrict'])->name('saveDistrict');
    Route::get('edit_district', [DistrictController::class, 'editDistrict'])->name('editDistrict');
    Route::post('update_district', [DistrictController::class, 'updateDistrict'])->name('updateDistrict');
    Route::delete('delete_district', [DistrictController::class, 'deleteDistrict'])->name('deleteDistrict');
});

// Panel Lawyer
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('index_panel_lawyer', [PanelLawyerController::class, 'indexPanelLawyer'])->name('indexPanelLawyer');
    Route::get('fetch_all_panel_lawyer', [PanelLawyerController::class, 'fetchAllPanelLawyer'])->name('fetchAllPanelLawyer');
    Route::post('save_panel_lawyer', [PanelLawyerController::class, 'savePanelLawyer'])->name('savePanelLawyer');
    Route::get('edit_panel_lawyer', [PanelLawyerController::class, 'editPanelLawyer'])->name('editPanelLawyer');
    Route::post('update_panel_lawyer', [PanelLawyerController::class, 'updatePanelLawyer'])->name('updatePanelLawyer');
    Route::delete('delete_panel_lawyer', [PanelLawyerController::class, 'deletePanelLawyer'])->name('deletePanelLawyer');
    Route::get('get_user_avatar', [PanelLawyerController::class, 'getUserAvatar'])->name('getUserAvatar');
    Route::get('show_panel_lawyer', [PanelLawyerController::class, 'showPanelLawyer'])->name('showPanelLawyer');
});

// Meeting
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('index_meeting', [MeetingController::class, 'indexMeeting'])->name('indexMeeting');
    Route::get('fetch_all_meeting', [MeetingController::class, 'fetchAllMeeting'])->name('fetchAllMeeting');
    Route::post('save_meeting', [MeetingController::class, 'saveMeeting'])->name('saveMeeting');
    Route::get('edit_meeting', [MeetingController::class, 'editMeeting'])->name('editMeeting');
    Route::post('update_meeting', [MeetingController::class, 'updateMeeting'])->name('updateMeeting');
    Route::delete('delete_meeting', [MeetingController::class, 'deleteMeeting'])->name('deleteMeeting');
    Route::get('show_meeting', [MeetingController::class, 'showMeeting'])->name('showMeeting');
});

// Billing
Route::group(['prefix' => '', 'middleware' => ['auth']], function () {
    Route::get('index_billing', [BillingController::class, 'indexBilling'])->name('indexBilling');
    Route::get('fetch_all_billing', [BillingController::class, 'fetchAllBilling'])->name('fetchAllBilling');
    Route::post('save_billing', [BillingController::class, 'saveBilling'])->name('saveBilling');
    Route::get('edit_billing', [BillingController::class, 'editBilling'])->name('editBilling');
    Route::post('update_billing', [BillingController::class, 'updateBilling'])->name('updateBilling');
    Route::delete('delete_billing', [BillingController::class, 'deleteBilling'])->name('deleteBilling');
    Route::get('show_billing', [BillingController::class, 'showBilling'])->name('showBilling');
});

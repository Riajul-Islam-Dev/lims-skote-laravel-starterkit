<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=> 'lims',['middleware' => 'auth']],function(){
    Route::get('testing', [App\Http\Controllers\Lims\TestingController::class, 'testing'])->name('testing');
});
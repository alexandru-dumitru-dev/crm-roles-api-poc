<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api'], function () {
    Route::middleware('guest')->post('login', 'App\Http\Controllers\AuthController@login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('me', 'App\Http\Controllers\AuthController@me')->name('me');
        Route::post('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

        Route::resource('users', 'App\Http\Controllers\UserController')->except(['create', 'edit']);

        Route::get('roles', 'App\Http\Controllers\RoleController@index')->name('roles.index');
    });
});

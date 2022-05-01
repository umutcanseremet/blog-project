<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix('/')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/post/{id}/{slug}', 'show')->name('show');
        Route::get('/category/{id}/{slug}', 'category')->name('category');
    });

Route::prefix('/admin')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/', 'admin')->name('dashboard');
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'auth')->name('auth');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/edit/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('delete');
        Route::get('/logout', 'signOut')->name('signOut');
    });

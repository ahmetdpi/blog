<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Ana sayfa
Route::get('/', [HomeController::class, 'index']);

// Admin auth
Route::get('admin/login', [AuthController::class, 'loginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin paneli
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class);
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
});

// Public sayfalar
Route::get('/country/{country}', [PostController::class, 'country'])->name('country.show');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');


Route::get('/api/crypto', [HomeController::class, 'getCrypto']);
Route::get('/api/gold', [HomeController::class, 'getGold']);

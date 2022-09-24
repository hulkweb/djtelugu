<?php

use Illuminate\Support\Facades\Auth;
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



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::post('/authenticate', [App\Http\Controllers\HomeController::class, 'authenticate'])->name('authenticate');

Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact-us', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/desclaimer', [App\Http\Controllers\HomeController::class, 'desclaimer'])->name('disclaimer');
Route::get('/terms-and-conditions', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy'])->name('privacy');


Route::get('/song/{id}/{slug}', [App\Http\Controllers\SongController::class, 'show'])->name('admin.song.show');
Route::get('/artist/{id}/{slug}', [App\Http\Controllers\ArtistController::class, 'show'])->name('admin.artist.show');
Route::get('/download/{id}/{slug}', [App\Http\Controllers\SongController::class, 'download'])->name('admin.song.download');
Route::get('/track/{id}/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('admin.category.show');
Route::get('/search', [App\Http\Controllers\SongController::class, 'search'])->name('admin.song.search');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/songs', [App\Http\Controllers\SongController::class, 'index'])->name('admin.song.index');
    Route::get('/song/create', [App\Http\Controllers\SongController::class, 'create'])->name('admin.song.create');
    Route::post('/song/store', [App\Http\Controllers\SongController::class, 'store'])->name('admin.song.store');
    Route::get('/song/delete/{id}', [App\Http\Controllers\SongController::class, 'delete'])->name('admin.song.delete');
    Route::get('/song/edit/{id}', [App\Http\Controllers\SongController::class, 'edit'])->name('admin.song.edit');
    Route::post('/song/update/', [App\Http\Controllers\SongController::class, 'update'])->name('admin.song.update');


    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('admin.setting.index');
    Route::get('/setting/create', [App\Http\Controllers\SettingController::class, 'create'])->name('admin.setting.create');
    Route::post('/setting/store', [App\Http\Controllers\SettingController::class, 'store'])->name('admin.setting.store');
    Route::get('/setting/delete/{id}', [App\Http\Controllers\SettingController::class, 'delete'])->name('admin.setting.delete');
    Route::get('/setting/edit/{id}', [App\Http\Controllers\SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::post('/setting/update/', [App\Http\Controllers\SettingController::class, 'update'])->name('admin.setting.update');

    Route::get('/keyword/create', [App\Http\Controllers\KeywordController::class, 'create'])->name('admin.keyword.create');
    Route::post('/keyword/store', [App\Http\Controllers\KeywordController::class, 'store'])->name('admin.keyword.store');
    Route::get('/keyword/create_video', [App\Http\Controllers\KeywordController::class, 'create_video'])->name('admin.keyword.create_video');
    Route::post('/keyword/video', [App\Http\Controllers\KeywordController::class, 'video'])->name('admin.keyword.video');

    Route::get('/artist/index', [App\Http\Controllers\ArtistController::class, 'index'])->name('admin.artist.index');
    Route::get('/artist/create', [App\Http\Controllers\ArtistController::class, 'create'])->name('admin.artist.create');
    Route::post('/artist/store', [App\Http\Controllers\ArtistController::class, 'store'])->name('admin.artist.store');
    Route::get('/artist/delete/{id}', [App\Http\Controllers\ArtistController::class, 'delete'])->name('admin.artist.delete');

    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('admin.category.delete');
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/', [App\Http\Controllers\CategoryController::class, 'update'])->name('admin.category.update');
});

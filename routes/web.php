<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\WebsiteCategoryController;
use App\Http\Controllers\Website\WebsitePostController;
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


Route::get('/', [IndexController::class, 'index'])->name('index');


Route::get('/export', [IndexController::class, 'export'])->name('export');
Route::get('/read', [IndexController::class, 'read'])->name('read');



















Route::get('/categories/{category}', [WebsiteCategoryController::class, 'show'])->name('category');
Route::get('/post/{post}', [WebsitePostController::class, 'show'])->name('post');






Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'CheckUser']], function () {

    Route::get('/', function () {
        return view('dashboard.layouts.layout');
    });

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings/update/{setting}', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/users/all', [UserController::class, 'get_users'])->name('users.all');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');

    Route::get('/categories/all', [CategoryController::class, 'get_categories'])->name('categories.all');
    Route::post('/categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

    Route::get('/posts/all', [PostController::class, 'get_posts'])->name('posts.all');
    Route::post('/posts/delete', [PostController::class, 'delete'])->name('posts.delete');

    Route::resources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'posts' => PostController::class
    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

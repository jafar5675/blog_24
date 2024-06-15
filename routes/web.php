<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'home']);
Route::get('about', [HomeController::class, 'about']);
Route::get('courses', [HomeController::class, 'courses']);
Route::get('blog', [HomeController::class, 'blog']);
Route::get('contact', [HomeController::class, 'contact']);

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'auth_login']);
Route::get('logout', [AuthController::class, 'auth_logout']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'create_user']);
Route::get('verify/{token}', [AuthController::class, 'verify']);

Route::get('forgot-password', [AuthController::class, 'forgot']);
Route::post('forgot-password', [AuthController::class, 'forgot_password']);

Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'post_reset']);

// admin
Route::group(['middleware' => 'admin'], function(){
    Route::get('admin/dashboard', [DashboardController::class, 'dash']);

    // user
    Route::get('admin/user/list', [UserController::class, 'user']);
    Route::get('admin/user/add', [UserController::class, 'add_user']);
    Route::post('admin/user/add', [UserController::class, 'insert_user']);
    Route::get('admin/user/edit/{id}', [UserController::class, 'edit_user']);
    Route::post('admin/user/edit/{id}', [UserController::class, 'update_user']);
    Route::get('admin/user/delete/{id}', [UserController::class, 'delete_user']);

    // category
    Route::get('admin/category/list', [CategoryController::class, 'category']);
    Route::get('admin/category/add', [CategoryController::class, 'add_category']);
    Route::post('admin/category/add', [CategoryController::class, 'insert_category']);
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit_category']);
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'update_category']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete_category']);

    // blog
    Route::get('admin/blog/list', [BlogController::class, 'blog']);
    Route::get('admin/blog/add', [BlogController::class, 'add_blog']);
    Route::post('admin/blog/add', [BlogController::class, 'insert_blog']);
    Route::get('admin/blog/edit/{id}', [BlogController::class, 'edit_blog']);
    Route::post('admin/blog/edit/{id}', [BlogController::class, 'update_blog']);
    Route::get('admin/blog/delete/{id}', [BlogController::class, 'delete_blog']);

    // page
    Route::get('admin/page/list', [PageController::class, 'page']);
    Route::get('admin/page/add', [PageController::class, 'add_page']);
    Route::post('admin/page/add', [PageController::class, 'insert_page']);
    Route::get('admin/page/edit/{id}', [PageController::class, 'edit_page']);
    Route::post('admin/page/edit/{id}', [PageController::class, 'update_page']);
    Route::get('admin/page/delete/{id}', [PageController::class, 'delete_page']);
});

Route::group(['middleware' => 'adminuser'], function(){
    Route::get('admin/dashboard', [DashboardController::class, 'dash']);

    Route::get('admin/change-password', [UserController::class, 'ChangePassword']);
    Route::post('admin/change-password', [UserController::class, 'UpdatePassword']);

    Route::get('admin/account-setting', [UserController::class, 'AccountSetting']);
    Route::post('admin/account-setting', [UserController::class, 'UpdateAccountSetting']);

    // blog
    Route::get('admin/blog/list', [BlogController::class, 'blog']);
    Route::get('admin/blog/add', [BlogController::class, 'add_blog']);
    Route::post('admin/blog/add', [BlogController::class, 'insert_blog']);
    Route::get('admin/blog/edit/{id}', [BlogController::class, 'edit_blog']);
    Route::post('admin/blog/edit/{id}', [BlogController::class, 'update_blog']);
    Route::get('admin/blog/delete/{id}', [BlogController::class, 'delete_blog']);

    Route::post('blog-comment-submit', [HomeController::class, 'BlogCommentSubmit']);
    Route::post('blog-comment-reply-submit', [HomeController::class, 'BlogCommentReplySubmit']);

});

Route::get('{slug}', [HomeController::class, 'blogdetail']);
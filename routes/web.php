<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\claimsController;
use App\Http\Controllers\categoryController;
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
Route::post('/login-user', [AuthController::class, 'loginUser'])->name('login-user')->middleware('UserVerificationAuthC');

Route::get('/', [AuthController::class, 'login'])->middleware('loggedInuser');

Route::get('/registration', [AuthController::class, 'registration'])->middleware('loggedInuser');

Route::post('/register-user', [AuthController::class, 'registerUser'])->name('register-user');

Route::get('/view_user/{id}', [AuthController::class, 'view_user'])->name('view_user')->middleware('isLoggedIn');

Route::get('/show_user/{id}', [AuthController::class, 'show_user'])->name('show_user')->middleware('isLoggedIn');

Route::get('/add_user_balance/{id}', [AuthController::class, 'add_user_balance'])->name('add_user_balance')->middleware('isLoggedIn');

Route::get('/update_existing_user/{id}', [AuthController::class, 'update_existing_user'])->name('update_existing_user')->middleware('isLoggedIn');

Route::get('/add_user', [AuthController::class, 'add_user'])->name('add_user')->middleware('isLoggedIn');

Route::post('store_user', [AuthController::class, 'registerUser'])->name('store_user')->middleware('isLoggedIn');


Route::get('state-fetch-city/{state}', [AuthController::class, 'state_fetch_city'])->name('state.fetch.city');


Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('isLoggedIn');

Route::get('/nav', [AuthController::class, 'nav'])->middleware('isLoggedIn');

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/transactions', [AuthController::class, 'transactions'])->middleware('isLoggedIn');

Route::get('/search-bill', [AuthController::class, 'search_claim'])->name('claim.search');

Route::Resource('claims', '\App\Http\Controllers\claimsController')->middleware('isLoggedIn');

Route::Resource('category', '\App\Http\Controllers\categoryController')->middleware('isLoggedIn');


Route::get('/manage_categories', [AuthController::class, 'manage_categories'])->middleware('isLoggedIn');

Route::get('/all_users', [AuthController::class, 'all_users'])->middleware('isLoggedIn' , 'CheckUserRole');

//Route::get('/add_user', [AuthController::class, 'add_user'])->middleware('isLoggedIn');

Route::get('/manage_roles', [AuthController::class, 'manage_roles'])->middleware('isLoggedIn');

Route::get('/profile_setting', [AuthController::class, 'profile_setting'])->middleware('isLoggedIn');

Route::get('/bill_reports', [AuthController::class, 'bill_reports'])->middleware('isLoggedIn');

Route::get('/notifications', [AuthController::class, 'notifications'])->middleware('isLoggedIn');


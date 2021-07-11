<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome2');
});

Route::get('/signin', function () {
    return view('pages.signin');
});

Route::get('/signup', function () {
    return view('pages.signup');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::post('/signIn1', [UserController::class, 'login_user']);
Route::get('/signout', [UserController::class, 'logout_user']);
Route::post('/signup1', [UserController::class, 'register_user']);
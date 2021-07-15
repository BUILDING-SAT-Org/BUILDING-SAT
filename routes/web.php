<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EarthWorksController;

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


Route::post('/signin', [UserController::class, 'login_user']);
Route::get('/signout', [UserController::class, 'logout_user']);
Route::post('/signup', [UserController::class, 'register_user']);

Route::post('/projects', [ProjectController::class, 'create_project']);
Route::get('/projects/{user_id}', [ProjectController::class, 'get_projects']);
Route::delete('/projects/{user_id}/{project_id}', [ProjectController::class, 'delete_project']);

Route::get('/project/{user_id}/{project_id}/earthworks', [EarthWorksController::class, 'get_earthworks']);
Route::get('/earthworks/difficulty', [EarthWorksController::class, 'get_difficulty_levels']);
Route::get('/earthworks/difficulty/siteclearence', [EarthWorksController::class, 'get_difficulty_level_site_clearence']);
Route::get('/earthworks/resources', [EarthWorksController::class, 'get_resources']);
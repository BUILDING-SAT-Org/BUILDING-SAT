<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EarthWorksController;
use App\Http\Controllers\ManageResources;

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

Route::get('/project/{user_id}/{project_id}/manageResources', [ManageResources::class, 'get_resources']); 

Route::post('/signin', [UserController::class, 'login_user']);
Route::get('/signout', [UserController::class, 'logout_user']);
Route::post('/signup', [UserController::class, 'register_user']);

Route::post('/projects', [ProjectController::class, 'create_project']);
Route::get('/projects/{user_id}', [ProjectController::class, 'get_projects']);
Route::delete('/projects/{user_id}/{project_id}', [ProjectController::class, 'delete_project']);

Route::get('/project/{user_id}/{project_id}/earthworks', [EarthWorksController::class, 'get_earthworks']);
Route::post('/project/{user_id}/{project_id}/earthworks', [EarthWorksController::class, 'save_entries']);

Route::get('/project/{user_id}/{project_id}/earthworks/entries', [EarthWorksController::class, 'get_entries']);
Route::delete('/project/{user_id}/{project_id}/earthworks/entries/{entry_id}', [EarthWorksController::class, 'delete_entry']);

Route::get('/earthworks/difficulty', [EarthWorksController::class, 'get_difficulty_levels']);
Route::get('/earthworks/difficulty/siteclearence', [EarthWorksController::class, 'get_difficulty_level_site_clearence']);
Route::get('/earthworks/resources/{user_id}/{project_id}', [EarthWorksController::class, 'get_resources']);

Route::get('/resources/countries', [ManageResources::class, 'get_countries']);

Route::post('/project/{user_id}/{project_id}/machines', [ManageResources::class, 'add_machine']);
Route::put('/project/{user_id}/{project_id}/machines', [ManageResources::class, 'update_machine']);
Route::post('/project/{user_id}/{project_id}/machines/delete', [ManageResources::class, 'delete_machine_list']);
Route::delete('/project/{user_id}/{project_id}/machines/{machine_id}', [ManageResources::class, 'delete_machine']);
Route::get('/project/{user_id}/{project_id}/machines', [ManageResources::class, 'get_machines']);







// Route::get('/resources', [ManageResources::class, 'add_machine']);

// //countries locations....

// /*project types*/
// Route::get('/resources/project-types/{id}', [ManageResources::class, 'add_machine']);
// Route::put('/resources/project-types/{id}', [ManageResources::class, 'add_machine']);
// Route::post('/resources/project-types', [ManageResources::class, 'add_machine']);
// Route::delete('/resources/project-types/{id}', [ManageResources::class, 'add_machine']);

// //https://www.ibm.com/docs/en/supply-chain-insight?topic=apis-bulk-deleting-work-orders
// Route::post('/resources/project-types/bulk', [ManageResources::class, 'add_machine']);


// /*b sat machines*/
// Route::get('/resources/machines', [ManageResources::class, 'add_machine']);

// Route::get('/resources/machines/{id}', [ManageResources::class, 'add_machine']);
// Route::put('/resources/machines/{id}', [ManageResources::class, 'add_machine']);
// Route::post('/resources/machines', [ManageResources::class, 'add_machine']);
// Route::delete('/resources/machines/{id}', [ManageResources::class, 'add_machine']);

// //https://www.ibm.com/docs/en/supply-chain-insight?topic=apis-bulk-deleting-work-orders
// Route::post('/resources/machines/bulk', [ManageResources::class, 'add_machine']);

// /**/

// Route::get('/users', [ManageResources::class, 'add_machine']);

// Route::get('/users/{id}', [ManageResources::class, 'add_machine']);
// Route::put('/users/{id}', [ManageResources::class, 'add_machine']);
// Route::post('/users', [ManageResources::class, 'add_machine']);
// Route::delete('/users/{id}', [ManageResources::class, 'add_machine']);

// //https://www.ibm.com/docs/en/supply-chain-insight?topic=apis-bulk-deleting-work-orders
// Route::post('/users/bulk', [ManageResources::class, 'add_machine']);


// /*user projects*/ 

// Route::get('/users/projects', [ManageResources::class, 'add_machine']);

// Route::get('/users/projects/{id}', [ManageResources::class, 'add_machine']);
// Route::put('/users/projects/{id}', [ManageResources::class, 'add_machine']);
// Route::post('/users/projects', [ManageResources::class, 'add_machine']);
// Route::delete('/users/projects/{id}', [ManageResources::class, 'add_machine']);

// //https://www.ibm.com/docs/en/supply-chain-insight?topic=apis-bulk-deleting-work-orders
// Route::post('/users/projects/bulk', [ManageResources::class, 'add_machine']);



// /*user projects machines*/
// Route::get('/users/projects/{id}/resources/machines', [ManageResources::class, 'add_machine']);

// Route::get('/users/projects/{id}/resources/machines/{id}', [ManageResources::class, 'add_machine']);
// Route::put('/users/projects/{id}/resources/machines/{id}', [ManageResources::class, 'add_machine']);
// Route::post('/users/projects/{id}/resources/machines', [ManageResources::class, 'add_machine']);
// Route::delete('/users/projects/{id}/resources/machines/{id}', [ManageResources::class, 'add_machine']);

// //https://www.ibm.com/docs/en/supply-chain-insight?topic=apis-bulk-deleting-work-orders
// Route::post('/users/projects/{id}/resources/machines/bulk', [ManageResources::class, 'add_machine']);



// /*main phases*/

// // add difficulty levels for this resource , destinations, machinery, transport, unloading destinations, 
// Route::get('/users/projects/earthworks', [ManageResources::class, 'add_machine']);

// Route::get('/users/projects/{id}/earthworks', [ManageResources::class, 'add_machine']);
// Route::put('/users/projects/{id}/earthworks', [ManageResources::class, 'add_machine']);
// Route::post('/users/projects/{id}/earthworks', [ManageResources::class, 'add_machine']);
// Route::delete('/users/projects/earthworks{id}', [ManageResources::class, 'add_machine']);

// //https://www.ibm.com/docs/en/supply-chain-insight?topic=apis-bulk-deleting-work-orders
// Route::post('/users/projects/earthworks/bulk', [ManageResources::class, 'add_machine']);
<?php

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

Route::get('/', function () {
    return redirect('login');
});

/*
 * account management
 */

Route::get('login', 'UserController@showLoginPage');
Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout');

Route::get('register', 'UserController@showSignUpPage');
Route::post('register', 'UserController@signUp');
Route::get('user/account', 'UserController@showUserAccount')->name('dashboard');

/*
 * manage project
 */
Route::get('add_project', 'ProjectController@showAddProjectPage');
Route::post('add_project', 'ProjectController@addProject');

Route::get('edit_project/{id}', 'ProjectController@showEditProjectPage');
Route::post('update_project/{id}', 'ProjectController@updateProject')->name('update_project');

Route::get('projects/list', 'ProjectController@showUserProjects')->name('projects');
Route::get('delete_project/{id}', 'ProjectController@deleteProject');


/*
 * manage task
 */
Route::get('add_task', 'TaskController@showAddTaskPage')->name('add_task');
Route::post('add_task', 'TaskController@addTask');

Route::get('edit_task/{id}', 'TaskController@showEditTaskPage');
Route::post('update_task/{id}', 'TaskController@updateTask')->name('update_task');

Route::get('tasks/list', 'TaskController@showUserTasks')->name('tasks');
Route::get('delete_task/{id}', 'TaskController@deleteTask');
Route::get('project/task', 'TaskController@showProjectTask')->name('sort_task_project');
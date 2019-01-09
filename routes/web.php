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

Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');

/*
 * Convenciones en Laravel.
 * GET /projects (index) Representa dame todos los datos de proyectos
 * GET /projects/create (create) Para ver un formulario que nos haga cargar los datos del proyecto
 * GET /projects/{id} (show) Ver X proyecto ya sea por un HTML o un JSON. Es decir ver uno en particular.
 * POST /projects (store) Representa un endpoint para guardar un resource como en este caso es Proyecto.
 * GET /projects/{id}/edit (edit) Si queremos editar un proyecto determinado la vista.
 * PATCH /projects/{id} (update) Ya que representa que quiero actualizar un proyecto con el id 1 por ej.
 * DELETE /projects/{id} (destroy) Significa que quiero eliminar un proyecto con X id.
 */

//Route::get('/projects', 'ProjectsController@index'); // Represents a resource
//Route::get('/projects/create', 'ProjectsController@create');
//Route::get('/projects/{id}', 'ProjectsController@show'); // Represents a resource
//Route::post('/projects', 'ProjectsController@store');
//Route::get('/projects/{id}/edit', 'ProjectsController@edit');
//Route::patch('/projects/{id}', 'ProjectsController@update');
//Route::delete('/projects/{id}', 'ProjectsController@destroy');

// OR ANOTHER OPTION IT'S

Route::resource('projects', 'ProjectsController');

Route::post('projects/{project}/tasks', 'ProjectTasksController@store');
Route::post('completed-tasks/{task}', 'CompletedTasksController@store');
Route::delete('completed-tasks/{task}', 'CompletedTasksController@destroy');

//Route::get('/', function () { //This is a closure function
//    $tasks = [
//        'Go to the Market',
//        'Go to the Store',
//        'Go to Work',
//        'Go to the Concert'
//    ];
//
//    return view('welcome', [
//        'tasks' => $tasks,
//        'foo' => 'bar'
//    ]);
//
//    /* Another ways...
//        return view('welcome')->with([
//            'tasks' => $tasks,
//            'foo' => 'bar'
//        ]);
//
//        OR
//
//        return view('welcome')
//            ->withTasks($tasks)
//            ->withFoo('bar');
//    */
//});

//Route::get('/about', function () {
//    return view('about');
//});
//
//Route::get('/contact', function () {
//    return view('contact');
//});

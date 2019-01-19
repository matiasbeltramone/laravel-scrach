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


// Ejemplo de Service Container como resuelve Laravel que te trae la clase
//use Illuminate\Filesystem\Filesystem;
//
//Route::get('/', function() {
//   dd(app(FileSystem::class));
//});

//Otro ejemplo pero creando una clase con binding y luego mostrandola. Puede servir para interfaces
//Permite meter clases/interfaces dentro del service container de Laravel
//app()->bind('example', function () { //Si queremos una sola instancia en lugar de bind usar singleton
//    return new \App\Example;
//});
// Al hacer app('example') Lo primero que hace es fijarse en el container si existe un bind o singleton con ese name
// Luego si no encuentra nada trata de resolver si es una clase existente tipo App\Example(funcionaria)
// Esto se llama fallback
//use App\Repositories\UserRepository;
//

//Route::get('/', function(\App\Services\Twitter $twitter) {
//    dd($twitter);
//   return view('welcome'); //En este caso me crea dos instancias diferentes con identificadores distintos
//});


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
//Route::resource('projects', 'ProjectsController');

/*
 * Lección para flash messaging y dejar un mensaje de creado por 1 request
 */
Route::get('projects/create', function () {
    return view('projects.create');
});

Route::post('projects', function() {
    //session()->flash('message', 'Your project has been created.');// Esto lo guarda solo por 1 request + a diferencia del put

    flash('Your project has been created'); //Gracias al archivo helpers.php
    return redirect('/');
});

//Route::resource('projects', 'ProjectsController')->middleware('can:update,project');

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Ejemplo para utilizar los notification que nos permiten enviar mails/mensaje de texto/ a slack o lo que sea necesario
//Route::get('/', function() {
//   $user = App\User::find(1);
//
//   $user->notify(new \App\Notifications\SubscriptionRenewalFailed());
//   return 'Done';
//});
// En tinker podemos utilizar para llenar el campo read_at del notification
// $user->notifications->first()->markAsRead();
// Revisar la documentación que se pueden leer los no leidos con $user->unreadNotifications, entre otros metodos.


/**
 * Lección para Sessions y Flash Messaging
 * Because the web is stateless, we can use sessions as a mechanism for recording important user information
 * from page to page.
 * In this lesson, we'll review the basic sessions API and flash messaging
 */

//Route::get('/', function(\Illuminate\Http\Request $request) {
    //PUT value on name key
    //session(['name' => 'Deckard']);
//    $request->session()->put('foobar', 'baz');
    //GET value name
    //session('name');

//    return $request->session()->get('foobar');
//});

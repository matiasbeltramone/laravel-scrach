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
    $tasks = [
        'Go to the Market',
        'Go to the Store',
        'Go to Work',
        'Go to the Concert'
    ];

    return view('welcome', [
        'tasks' => $tasks,
        'foo' => 'bar'
    ]);

    /* Another ways...
        return view('welcome')->with([
            'tasks' => $tasks,
            'foo' => 'bar'
        ]);

        OR

        return view('welcome')
            ->withTasks($tasks)
            ->withFoo('bar');
    */
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

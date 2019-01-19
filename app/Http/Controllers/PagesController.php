<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //U can do too in routes maybe ->middleware('auth');
    }

    public function home()
    {
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
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}

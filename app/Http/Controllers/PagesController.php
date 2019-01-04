<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
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

<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        //Inmediatamente obtenemos un 419, ya que falta un token de authorización. (Esto sin el Token CSRF) Es un extra de seguridad
        return request()->all();
    }
}

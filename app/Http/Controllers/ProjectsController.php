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
        $project = new Project();

        $project->title = 'My Seconds Project';
        $project->description = 'Lorem Ipsum';

        $project->save();
    }
}

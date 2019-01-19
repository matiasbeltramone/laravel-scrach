<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth')->except(['index']);
//        $this->middleware('auth')->only(['store', 'update']);
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::where('owner_id', auth()->id())->get();

        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        // Si las validaciones fallan te redirigen a la misma pagina
        $attributes = request()->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3'
        ]);

        $attributes['owner_id'] = auth()->id();

        Project::create($attributes);
        //Esto asi va a fallar excepto que lo agreguemos en el model al mass assigment fillable
        // El cual te marca que campos pueden ser asignados masivamente o asignar el $guard = []
        // Esto se debe a que un usuario te puede agregar algun campo al form y enviarlo y si usas el all del request
        // Podes tener ciertos problemas q te asignaron campos q no deberían existir.

//        Project::create(request()->all()); Esto con un protected $guard = []; en el model hace desastre
        //ya que puede reemplazarte el id, o los campos que pueda saber que existen del usuario tipo subscripción
        // El $fillable es mas deseable ya que te dice solo los campos estos pueden ser asignados mediante el create.

//        Project::create([
//            'title' => request('title'),
//            'description' => request('description')
//        ]);

//        $project = new Project();
//
//        $project->title = request('title');
//        $project->description = request('description');
//
//        $project->save();

        return redirect('/projects'); //Siempre hace un get el redirect.
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function show(Project $project)
    {
        /* Authorize con Policies */
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));

        // Otra forma es con Gates
//        if (\Gate::denies('update', $project)) {
//            abort(403);
//        }

        //Authorization de manera manual logica
//        if ($project->owner_id !== auth()->id()) {
//            abort(403);
//        }

        // abort_if($project->owner_id !== auth()->id(), 403);
        // abort_unless(auth()->user()->owns($project), 403);
    }

    public function update(Project $project)
    {
        $project->update(request(['title', 'description']));

//        $project->title = request('title');
//        $project->description = request('description');
//
//        $project->save();

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects');
    }
}

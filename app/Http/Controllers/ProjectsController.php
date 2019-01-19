<?php

namespace App\Http\Controllers;

use App\Events\ProjectCreated;
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
        $projects = auth()->user()->projects;
        //Otra opción
//        $projects = Project::where('owner_id', auth()->id())->get();

        //Clase Telescope usando el dump por detrás hace un var_dump
//        dump($projects);
        // Se puede utilizar algo de cache también en telescope pestaña cache y ver que acción hizo
//        cache()->rememberForever('stats', function () {
//            return ['lessons' => 1300, 'hours' => 50000, 'series' => 100];
//        });
        // Si queres revisar si existe la key stats y ver el hit en telescope
//        $stats = cache()->get('stats');
//        dump($stats);
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

        $project = Project::create($attributes);
        /*
           Basicamente vimos 3 formas de enviar emails:
            Directamente desde el controlador (Poca limpieza en el controller)
            Mediante Eloquent Model Hooks (Mucho acoplamiento a eloquent)
            Mediante Eventos (Pareciera ser el mas desacoplado y la mejor manera
        */
        event(new ProjectCreated($project));

        // Para crear esta clase de mail php artisan make:mail ProjectCreated --markdown="mail.project-created" te hace la plantilla tmb pelado maravilloso
        // Lo que puede pasar con los emails es que tarden unos segundos en enviarse por lo que relentizan el sistema y sería mejor pasarlo por queue
//        Mail::to($project->owner->email)->send(
//          new ProjectCreated($project)
//        ); // Para ver bien este email podemos ir al log (por el driver que pusimos en .env) o en telescope se puede ver la plantilla como renderizada

        /*
         * Existen otras opciones que puede ser cuando crece mucho una aplicacion y eloquent provee
         * Model Hooks
        */


        return redirect('/projects'); //Siempre hace un get el redirect.

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
        $attributes = request()->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3'
        ]);

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

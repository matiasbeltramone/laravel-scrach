@extends('layout')

@section('content')
    <h1 class="title">Edit Project</h1>
    {{--
        Si nosotros mandamos esto asi de una el navegador no entiende y nos deja la petición en get por lo tanto hay
        que usar el method_field('PATCH') para que laravel sepa apesar de usar un POST en el browser que es un PATCH
    --}}
    <form method="POST" action="/projects/{{ $project->id }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title }}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>

            <div class="control">
                <textarea name="description" class="textarea">{{ $project->description }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Project</button>
            </div>
        </div>
    </form>
<form method="POST" action="/projects/{{ $project->id }}">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}

    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link">Delete Project</button>
        </div>
    </div>
</form>

@endsection

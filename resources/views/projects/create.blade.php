@extends('layout')

@section('content')
    <h1 class="title">Create a New Project</h1>

    <form method="POST" action="/projects">
        @csrf
        <div class="field">
            <label class="label" for="title">Project Title</label>
            {{--La validación del lado del cliente no es suficiente ya que desde consola se puede editar (eliminando el atributo require)
             y enviar igual el form sin el campo required ya que ha sido eliminado --}}
            <div class="control">
                <input type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title" value="{{ old('title') }}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Project Description</label>

            <div class="control">
                <textarea name="description" class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}"> {{ old('description') }} </textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="notification is-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
@endsection

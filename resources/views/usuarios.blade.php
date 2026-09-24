@extends('layouts.app')

@section('titulo', 'Usuarios')

@section('contenido')

    <section>
        <h2>{{ $nombreProyecto }}</h2>

        <p>{{ $descripcion }}</p>

        <ul>
            @foreach ($usuarios as $usuario)
                <li>{{ $usuario }}</li>
            @endforeach
        </ul>
    </section>
    
@endsection
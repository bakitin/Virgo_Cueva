@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
    <section>
        <h2>Administración de categorías</h2>

        <p>{{ $descripcion }}</p>
    </section>

    <section>
        <h2>Módulos del sistema</h2>

        <ul>
            @foreach ($modulos as $modulo)
                <li>{{ $modulo }}</li>
            @endforeach
        </ul>
    </section>
@endsection





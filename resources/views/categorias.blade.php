@extends('layouts.app')

@section('titulo', 'Categorias')

@section('contenido')

    <section>
        <h2>{{ $nombreProyecto }}</h2>

        <p>{{ $descripcion }}</p>

        <ul>
            @foreach ($categorias as $categoria)
                <li>{{ $categoria }}</li>
            @endforeach
        </ul>
    </section>
    
@endsection
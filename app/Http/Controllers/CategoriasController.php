<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $nombreProyecto = 'Administracion de categorias';

        $descripcion = 'App desarrollada con Laravel para mostrar las categorias';

        $categorias = [
            '1',
            '2',
            '3'
        ];
        

        return view('categorias', [
            'nombreProyecto' => $nombreProyecto,
            'descripcion' => $descripcion,
            'categorias' => $categorias
        ]);
    }
}



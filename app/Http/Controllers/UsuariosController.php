<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $nombreProyecto = 'Usuarios';

        $descripcion = 'App desarrollada con Laravel para mostrar los usuarios';

        $usuarios = [
            'u1',
            'u2',
            'u3'
        ];
        

        return view('usuarios', [
            'nombreProyecto' => $nombreProyecto,
            'descripcion' => $descripcion,
            'usuarios' => $usuarios
        ]);
    }
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AyudaController extends Controller
{
        public function ayuda()
    {
        return view('ayuda');
    }
}

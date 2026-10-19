<?php

/*
| Mensajes de validación en español, solo para las reglas que usa la tienda.
| Si una regla no aparece acá, Laravel usa el mensaje en inglés que trae por defecto.
*/

return [

    'accepted' => 'Debes aceptar :attribute.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'email' => 'El campo :attribute debe ser un correo válido.',
    'in' => 'El :attribute seleccionado no es válido.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'max' => [
        'numeric' => 'El campo :attribute no puede ser mayor que :max.',
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser texto.',
    'unique' => 'Ese :attribute ya está registrado.',

    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo',
        'password' => 'contraseña',
        'reason' => 'motivo',
        'message' => 'mensaje',
        'cantidad' => 'cantidad',
        'terms' => 'los términos y condiciones',
    ],

];

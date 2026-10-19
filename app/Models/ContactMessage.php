<?php

namespace App\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    /**
     * Opciones del campo "Motivo" del formulario de contacto.
     *
     * @var list<string>
     */
    public const REASONS = [
        'Consulta sobre un producto',
        'Garantía',
        'Cambio o devolución',
        'Estado de mi pedido',
        'Otro',
    ];

    protected $fillable = [
        'name',
        'email',
        'reason',
        'message',
    ];
}

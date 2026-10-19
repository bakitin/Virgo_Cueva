<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactoController extends Controller
{
    public function create(): View
    {
        return view('contacto', [
            'reasons' => ContactMessage::REASONS,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'reason' => ['required', Rule::in(ContactMessage::REASONS)],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contacto')->with('status', '¡Gracias por escribirnos! Recibimos tu mensaje y te responderemos pronto.');
    }
}

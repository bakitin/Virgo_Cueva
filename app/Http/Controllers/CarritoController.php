<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CarritoController extends Controller
{
    /**
     * Llave de la sesión donde vive el carrito, con la forma [id del producto => cantidad].
     */
    public const SESSION_KEY = 'carrito';

    /**
     * Costo fijo de envío a cualquier ciudad de Colombia.
     */
    public const SHIPPING_COST = 17900;

    public function index(): View
    {
        $cart = session(self::SESSION_KEY, []);

        $items = Product::active()
            ->with('brand')
            ->whereKey(array_keys($cart))
            ->orderBy('id')
            ->get()
            ->map(fn (Product $product): array => [
                'product' => $product,
                'quantity' => $cart[$product->id],
                'subtotal' => $product->price * $cart[$product->id],
            ]);

        $subtotal = $items->sum('subtotal');
        $shipping = $items->isEmpty() ? 0 : self::SHIPPING_COST;

        return view('carrito', [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $subtotal + $shipping,
        ]);
    }

    public function store(Product $product): RedirectResponse
    {
        abort_unless($product->is_active, 404);

        $cart = session(self::SESSION_KEY, []);
        $quantity = ($cart[$product->id] ?? 0) + 1;

        if ($quantity > $product->stock) {
            return back()->with('error', "No quedan más unidades disponibles de {$product->name}.");
        }

        $cart[$product->id] = $quantity;
        session([self::SESSION_KEY => $cart]);

        return redirect()->route('carrito.index')->with('status', "Agregaste {$product->name} al carrito.");
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'cantidad' => ['required', 'integer', 'min:1', 'max:'.$product->stock],
        ]);

        $cart = session(self::SESSION_KEY, []);
        $cart[$product->id] = (int) $validated['cantidad'];
        session([self::SESSION_KEY => $cart]);

        return redirect()->route('carrito.index');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $cart = session(self::SESSION_KEY, []);
        unset($cart[$product->id]);
        session([self::SESSION_KEY => $cart]);

        return redirect()->route('carrito.index')->with('status', "Quitaste {$product->name} del carrito.");
    }
}

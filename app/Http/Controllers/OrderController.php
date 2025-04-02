<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Game;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function addToCart($id)
    {
        $game = Game::findOrFail($id);

        // Obtener el carrito desde la sesión (si no hay, lo crea)
        $cart = Session::get('cart', []);

        // Agregar el juego al carrito
        if (!isset($cart[$id])) {
            $cart[$id] = [
                'name' => $game->name,
                'price' => $game->price,
                'portrait' => $game->portrait,
                'quantity' => 1
            ];
        } else {
            // Si ya está en el carrito, incrementar cantidad
            $cart[$id]['quantity'] += 1;
        }

        // Guardar en sesión
        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Juego añadido al carrito.');
    }

    public function showCart()
    {
        $cart = Session::get('cart', []);
        return view('cart', ['cart' => $cart]);
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]); // Eliminar el juego del carrito
            Session::put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Juego eliminado del carrito.');
    }

    public function clearCart()
    {
        Session::forget('cart'); // Vaciar el carrito
        return redirect()->back()->with('success', 'Carrito vaciado.');
    }
}

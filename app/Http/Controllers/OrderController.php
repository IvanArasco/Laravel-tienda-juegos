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

        return redirect()->route('cart.show')->with('success', 'Juego añadido al carrito.');
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

    public function storeCart(){ // completar el pedido

        $cart = Session::get('cart', []);

        $user = auth()->user();

        $userBalance = $user->saldo;

        // Verificar si hay productos en el carrito
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular el total del pedido
        $orderPrice = array_sum(array_map(function ($game) {
            return $game['price'] * $game['quantity'];  
        }, $cart));

        // Verificar si hay saldo suficiente para realizar el pedido.
        if ($userBalance >= $orderPrice){
            $user->saldo -= $orderPrice;
            $user->save();
        } else {
            return redirect()->back()->with('error', 'Saldo insuficiente.');
        }

        // Registrar el pedido en la base de datos
        $order = Order::create([
            'user_id' => auth()->id(), // ID del usuario autenticado
            'price' => $orderPrice,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Asociar los productos del carrito al pedido (relación de muchos a muchos)
        foreach ($cart as $id => $game) {
            $order->games()->attach($id, [
                'quantity' => $game['quantity'],
                'price' => $game['price'],
            ]);
        }

       Session::forget('cart'); // Vaciar el carrito después de procesar la compra.

       return redirect()->route('games')->with('success', 'Pedido completado con éxito.');
    }
}

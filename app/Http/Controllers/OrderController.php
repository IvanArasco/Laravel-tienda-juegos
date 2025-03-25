<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Game;

class OrderController extends Controller
{
    public function comprarJuego(Request $request, $gameId)
    {
        $user = Auth::user();
        $game = Game::findOrFail($gameId);

        // Verificar si el usuario tiene saldo suficiente
        if ($user->saldo < $game->price) {
            return back()->with('error', 'Saldo insuficiente para comprar este juego.');
        }

        // Restar el saldo al usuario
        $user->update(['saldo' => $user->saldo - $game->price]);
        session(['saldo' => $user->saldo]); // actualizar el saldo en la sesión

        // registrar la compra
        Order::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'price' => $game->price,
        ]);

        return back()->with('success', '¡Compra realizada con éxito!');
    }
}

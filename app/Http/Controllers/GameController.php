<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{

    public function index() // ver todos los juegos
    {
        $games = Game::all();
        $cart = Session::get('cart', []); // Recuperar el carrito de la sesión
        return view('welcome',  ['games' => $games, 'cart' => $cart]);
    }
    public function show(string $id) { // ver el juego
        return view('welcome', [
            'game' => Game::findOrFail($id)
        ]);
    }
    public function createGame(Request $request){ // crear un juego

         // Validar los datos del formulario
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:games',
            'description' => 'required|string|max:255',
            'portrait' => 'required|mimes:jpeg,png,jpg,gif|max:10240',
            'price' => 'required|numeric|min:0',
        ]);

        // Si la validación falla, redirigir al formulario con errores
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }   

         // Si hay un archivo de imagen, manejar su almacenamiento
        $portraitPath = null;
        if ($request->hasFile('portrait')) {
            // Guardar la imagen en el directorio 'public/portraits'
            $portraitPath = $request->file('portrait')->store('portraits', 'public');
        }

        // Crear el juego y registrarlo en la base de datos
        Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'portrait' => $portraitPath,
            'price' => $request->price, 
        ]);

        return redirect()->route('games');
    }
}

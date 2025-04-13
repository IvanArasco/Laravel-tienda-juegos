<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{

    public function index(Request $request) // ver todos los juegos
    {
        // Obtener los géneros únicos de los juegos
        $genres = Game::pluck('genre')->unique(); // array con todos los géneros sin duplicar (y juntos por comas en caso de múltiples)

        $allGenres = [];
        foreach ($genres as $genreString) {
            $individualGenres = explode(',', $genreString); // Cada string separado por comas será convertido en otro array
            foreach ($individualGenres as $genre) { 
                $allGenres[] = trim($genre); // Elimina espacios si los hay
            }
        }
            
        $allGenres = array_unique($allGenres);
        sort($allGenres);
        
        $games = Game::all(); 
     
        $cart = Session::get('cart', []); // Recuperar el carrito de la sesión
        return view('welcome',  ['games' => $games, 'cart' => $cart, 'genres' => $allGenres]);
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
            'genre' => 'required|array|min:1',
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
            'genre' => implode(',', $request->genre),
            'price' => $request->price, 
        ]);

        return redirect()->route('games');
    }
    public function editGame($id) {
        $game = Game::findOrFail($id);
        return view('editgame',  ['game' => $game]);
    }

    public function updateGame(Request $request, $id) {
        $game = Game::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|array|min:1',
            'price' => 'required|numeric',
            'portrait' => 'nullable|image|max:2048',
        ]);
    
        // Si la validación falla, redirigir al formulario con errores
        if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }   

        if ($request->hasFile('portrait')) {
            $data['portrait'] = $request->file('portrait')->store('portraits', 'public');
        }

        if ($request->has('genre')) {
            $data['genre'] = implode(',', $request->genre);
        }

        $game->update($data);
    
        return redirect()->route('games')->with('success', 'Juego actualizado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Game;

use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index()
    {
        $games = Game::all();
        return view('welcome', ['games' => $games]);
    }
    public function show(string $id)
    {
        return view('welcome', [
            'game' => Game::findOrFail($id)
        ]);
    }
}

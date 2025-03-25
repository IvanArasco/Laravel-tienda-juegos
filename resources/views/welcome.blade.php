@extends('app')

@section('header')

    <div class="background-header">
        <div class="block-main-header">
            <div class="container">
                <h1 class="main-title">
                    Tienda de juegos
                </h1>
            </div>
        </div>
    </div>

@endsection

@section('content')

    <div class="block-games-list">
        @if(isset($games) && $games->isNotEmpty())
            @foreach($games as $game)
                <div class="game-card">
                    <h3>{{ $game->title }}</h3>
                    <p>Precio: ${{ $game->price }}</p>
            
                    <form action="{{ url('/comprar/' . $game->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Comprar</button>
                    </form>
                </div>
            @endforeach
        @else
            <h2>No hay juegos disponibles.</h2>
        @endif

    </div>

@endsection


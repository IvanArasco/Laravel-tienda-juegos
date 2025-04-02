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
                    <h3 class="game-name">{{ $game->name }}</h3>
                    <img class="game-image" src="{{ asset('storage/' . $game->portrait) }}" alt="{{ $game->name }}">
                    <p class="game-description"> {{ $game->description }}</p>
                    <p class="game-price">Precio: ${{ $game->price }}</p>

                    @if(auth()->check())
                        <form action="{{ route('cart.add', $game->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success game-addcart" type="submit">Añadir al carrito</button>
                        </form>
                    @endif
                    
                </div>
            @endforeach
        @else
            <h2>No hay juegos disponibles.</h2>
        @endif
        
        @if(auth()->check() && auth()->user()->isAdmin())
            <a class="btn btn-primary" href="{{ route('createGame') }}" target="_blank">Crear juego</a>
        @endif

    </div>
@endsection


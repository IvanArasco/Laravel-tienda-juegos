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

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="block-games-list">
        
        <div class="genre-filter mt-3">
            <form id="genreForm" method="GET" action="{{ route('games') }}">
                <select class="form-select" id="genreFilter" name="genre" aria-label="Seleccionar género">
                    <option value="">Selecciona un género</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre }}" {{ request()->genre == $genre ? 'selected' : '' }}>
                            {{ ucfirst($genre) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if(isset($games) && $games->isNotEmpty())
            @foreach($games as $game)
                <div class="game-card" data-genre="{{ $game->genre }}">
                    <div class="row">
                        <div class="col-2 col-lg-2 col-sm-2">
                            <h3 class="game-name">{{ $game->name }}</h3>
                            <img class="game-image" src="{{ asset('storage/' . $game->portrait) }}" alt="{{ $game->name }}">
                        </div>
                        <div class="d-flex align-items-center col-5 col-lg-5 col-sm-5">

                            <p class="game-description"> {{ $game->description }}</p>
                        </div>
                        <div class="col-2 col-lg-2 col-sm-2">
                            <p class="game-price">Precio: ${{ $game->price }}</p>
                        </div>
                    </div>
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <form action="{{ route('game.edit', $game->id) }}" method="GET">
                            @csrf
                            <button class="btn btn-primary" type="submit">Editar juego</button>
                        </form>
                    @endif

                    @if(auth()->check())
                        <form action="{{ route('cart.add', $game->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success" type="submit">Añadir al carrito</button>
                        </form>
                    @endif
                    
                </div>
            @endforeach
        @else
            <h2>No hay juegos disponibles.</h2>
        @endif
        
        @if(auth()->check() && auth()->user()->isAdmin())
            <a class="btn btn-primary" href="{{ route('createGame') }}">Crear juego</a>
        @endif

    </div>

@endsection


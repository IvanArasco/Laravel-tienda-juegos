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
            <p>{{ $game->name }}</p>
        @endforeach
        @else
            <h2>No hay juegos disponibles.</h2>
        @endif
    </div>

@endsection


@extends('app')

@section('title', 'Crear nuevo juego')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('game.update', $game->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nombre del juego</label>
        <input type="name" name="name" id="name" class="form-control" value="{{ old('name', $game->name) }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <input type="description" name="description" id="description" class="form-control" value="{{ old('description', $game->description) }}" required>
    </div>

    <div class="mb-3">  
        <label for="portrait" class="form-label">Portada</label>
        <input type="file" name="portrait" id="portrait" class="form-control" accept="image/*" 
            value="{{ old('portrait', asset('storage/'.$game->portrait)) }}">
    </div>

    <div class="mb-3">
        <label for="genre" class="form-label">Categoría</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="genre[]" id="genreAction" value="Accion"
                {{ in_array('Accion', explode(',', $game->genre)) ? 'checked' : '' }}>
            <label class="form-check-label" for="genreAction">Acción</label>
        </div>
    
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="genre[]" id="genreRpg" value="RPG"
                {{ in_array('RPG', explode(',', $game->genre)) ? 'checked' : '' }}>
            <label class="form-check-label" for="genreRpg">RPG</label>
        </div>
    
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="genre[]" id="genreTerror" value="Terror"
                {{ in_array('Terror', explode(',', $game->genre)) ? 'checked' : '' }}>
            <label class="form-check-label" for="genreTerror">Terror</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{  old('price', $game->price) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar juego</button>
</form>

@endsection


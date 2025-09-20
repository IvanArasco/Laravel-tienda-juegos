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

<h1> Crear juego </h1>

<form method="POST" action="{{ route('game.create') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre del juego</label>
        <input type="name" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <input type="description" name="description" id="description" class="form-control" value="{{ old('description') }}" required>
    </div>

    <div class="mb-3">  
        <label for="portrait" class="form-label">Portada</label>
        <input type="file" name="portrait" id="portrait" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="genre" class="form-label">Categoría</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="genre[]" id="genreAction" value="Accion"
                {{ in_array('Accion', old('genre', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="genre_action">Acción</label>
        </div>
    
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="genre[]" id="genreRpg" value="RPG"
                {{ in_array('RPG', old('genre', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="genre_rpg">RPG</label>
        </div>
    
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="genre[]" id="genreTerror" value="Terror"
                {{ in_array('Terror', old('genre', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="genre_terror">Terror</label>
        </div>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Crear juego</button>
</form>


@endsection


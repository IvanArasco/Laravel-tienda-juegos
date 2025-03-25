@extends('app')

@section('title', 'Crear nuevo juego')

@section('content')

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li class="error">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

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
        <!-- Añadir campo para poner imagen de portada del juego --> 
        <input type="file" name="portrait" id="portrait" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Crear juego</button>
</form>


@endsection


@extends('app')

@section('title', 'Registro de usuario')

@section('header')

@section('content')

    <h1 class="fw-bold">Registrar usuario</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de usuario</label>
            <input type="name" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>
    
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar registro</button>
    </form>

    @endsection

@endsection
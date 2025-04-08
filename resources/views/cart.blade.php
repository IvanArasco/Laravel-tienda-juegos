@extends('app')

@section('title', 'Tu Carrito')

@section('content')

    <h2>Tu Carrito</h2>

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

    @if (!empty($cart) || count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Portada</th>
                    <th>Nombre</th>
                    <th>Precio</th> 
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $id => $game)
                    @php $total += $game['price'] * $game['quantity']; @endphp
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $game['portrait']) }}" alt="{{ $game['name'] }}" width="50">
                        </td>
                        <td>{{ $game['name'] }}</td>
                        <td>{{ number_format($game['price'], 2) }} €</td>
                        <td>{{  $game['quantity'] }} </td>
                        <td>{{ number_format($game['price'] * $game['quantity'], 2) }} €</td>
                        <td>
                            <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <h4>Total: {{ number_format($total, 2) }} €</h4>

            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Vaciar Carrito</button>
            </form>
        </div>
    @else
        <p class="text-muted">Tu carrito está vacío.</p>
    @endif

    <a href="{{ route('games') }}" class="btn btn-primary mt-3">Seguir Comprando</a>
    <form action="{{ route('cart.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success mt-3">Finalizar compra</button>
    </form>
@endsection

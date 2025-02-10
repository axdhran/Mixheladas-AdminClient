@extends('layout.app')

@section('content')
<div class="d-flex flex-wrap justify-content-center gap-3 mt-4 mb-5">
    <div class="card text-center" style="width:250px; height:290px">
        <div class="card-body d-flex flex-column justify-content-between">
            <i class="fas fa-list-alt fa-3x"></i>
            <h4 class="card-title mt-3">MANTENIMINETO CATEGORIA</h4>
            <a href="{{ route('categoria.index') }}" class="btn btn-warning">Ir a Categorías</a>
        </div>
    </div>
    
    <div class="card text-center" style="width:250px; height:290px">
        <div class="card-body d-flex flex-column justify-content-between">
            <i class="fas fa-box fa-3x"></i>
            <h4 class="card-title mt-3">MANTENIMINETO PRODUCTO</h4>
            <a href="{{ route('producto.index') }}" class="btn btn-warning">Ir a Productos</a>
        </div>
    </div>
    
    <div class="card text-center" style="width:250px; height:290px">
        <div class="card-body d-flex flex-column justify-content-between">
            <i class="fas fa-chair fa-3x"></i>
            <h4 class="card-title mt-3">MANTENIMINETO MESA</h4>
            <a href="{{ route('mesa.index') }}" class="btn btn-warning">Ir a Mesas</a>
        </div>
</div>
    <div class="card text-center" style="width:250px; height:290px">
        <div class="card-body d-flex flex-column justify-content-between">
            <i class="fas fa-plus-circle fa-3x"></i>
            <h4 class="card-title mt-3">CREAR PEDIDO</h4>
            <a href="{{ route('pedido.create') }}" class="btn btn-warning">Crear Pedido</a>
        </div>
    </div>
    
    <div class="card text-center" style="width:250px; height:290px">
        <div class="card-body d-flex flex-column justify-content-between">
            <i class="fas fa-eye fa-3x"></i>
            <h4 class="card-title mt-3">PEDIDOS</h4>
            <a href="{{ route('pedido.index') }}" class="btn btn-warning">Ver Pedidos</a>
        </div>
    </div>

    <div class="card text-center" style="width:250px; height:290px">
        <div class="card-body d-flex flex-column justify-content-between">
            <i class="fas fa-eye fa-3x"></i>
            <h4 class="card-title mt-3">PEDIDOS (todos)</h4>
            <a href="{{ route('pedido.todos') }}" class="btn btn-warning">Ver Pedidos</a>
        </div>
    </div>

    <div class="card text-center" style="width:250px; height:290px">
        <div class="card-body d-flex flex-column justify-content-between">
            <i class="fas fa-users fa-3x"></i>
            <h4 class="card-title mt-3">USUARIOS</h4>
            <a href="{{ route('usuario.index') }}" class="btn btn-warning">Ver Usuarios</a>
        </div>
    </div>
</div>
@endsection
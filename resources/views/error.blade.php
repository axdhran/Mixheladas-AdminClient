@extends('layout.app')

@section('content')
<div class="container">
    <h1>Error</h1>
    <p>{{ $message }}</p>
    <a href="{{ route('login') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
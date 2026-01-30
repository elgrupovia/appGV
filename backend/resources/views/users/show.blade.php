@extends('layouts.app')

@section('title', 'Detalle Usuario')

@section('content')
<div class="card">
    <div class="card-header">Detalle del Usuario</div>
    <div class="card-body">
        <h5>{{ $user->name }}</h5>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Empresa:</strong> {{ $user->company ? $user->company->name : 'Sin Empresa' }}</p>
        <a href="/users" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection

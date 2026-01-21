@extends('layouts.app')

@section('title', 'Detalle Registro')

@section('content')
<div class="card">
    <div class="card-header">Detalle del Registro</div>
    <div class="card-body">
        <p><strong>Usuario:</strong> {{ $registration->user->name }}</p>
        <p><strong>Evento:</strong> {{ $registration->event->name }}</p>
        <a href="/registrations" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection

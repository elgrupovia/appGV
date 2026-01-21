@extends('layouts.app')

@section('title', 'Registros')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Registros</h2>
    <a href="/registrations/create" class="btn btn-success">Nuevo Registro</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Evento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registrations as $registration)
        <tr>
            <td>{{ $registration->id }}</td>
            <td>{{ $registration->user->name }}</td>
            <td>{{ $registration->event->name }}</td>
            <td>
                <a href="/registrations/{{ $registration->id }}" class="btn btn-info btn-sm">Ver</a>
                <form action="/registrations/{{ $registration->id }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

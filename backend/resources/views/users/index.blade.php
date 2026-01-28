@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Usuarios</h2>
    <a href="/users/create" class="btn btn-success">Crear Usuario</a>
</div>

<form action="" method="GET" class="mb-3">
    <div class="input-group">
        <select name="role" class="form-control">
            <option value="">All</option>
            @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if($user->roles && $user->roles->count())
                    {{ $user->roles->pluck('name')->implode(', ') }}
                @else
                    -
                @endif
            </td>
            <td>
                <a href="/users/{{ $user->id }}" class="btn btn-info btn-sm">Ver</a>
                <a href="/users/{{ $user->id }}/edit" class="btn btn-warning btn-sm">Editar</a>
                <form action="/users/{{ $user->id }}" method="POST" style="display:inline;">
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

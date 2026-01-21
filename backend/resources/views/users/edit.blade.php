@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Editar Usuario</div>
            <div class="card-body">
                <form method="POST" action="/users/{{ $user->id }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <h5>Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}!</h5>
                <p>Usa el menú para navegar por la aplicación.</p>
            </div>
        </div>
    </div>
</div>
@endsection

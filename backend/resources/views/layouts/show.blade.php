@extends('layouts.app')

@section('title', 'Detalles de la Empresa')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ $company->name }}</h1>
        <div>
            <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary">
                Editar
            </a>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary ms-2">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo de {{ $company->name }}" class="img-fluid rounded shadow-sm">
                    @else
                        <div class="img-fluid bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                            <span class="text-muted">Sin logo</span>
                         </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <p><strong>Sector:</strong> {{ $company->sector }}</p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $company->email }}">{{ $company->email }}</a></p>
                    <p><strong>Teléfono:</strong> {{ $company->phone }}</p>
                    <p><strong>Sitio Web:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
                    <p><strong>Dirección:</strong> {{ $company->address }}, {{ $company->city }}, {{ $company->province }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h4>Usuarios de esta Empresa</h4>
        </div>
        <div class="card-body">
            @if($company->users && $company->users->count() > 0)
                <ul class="list-group">
                    @foreach($company->users as $user)
                        <li class="list-group-item">{{ $user->name }} ({{ $user->email }})</li>
                    @endforeach
                </ul>
            @else
                <p>No hay usuarios asignados a esta empresa.</p>
            @endif
        </div>
    </div>
</div>
@endsection
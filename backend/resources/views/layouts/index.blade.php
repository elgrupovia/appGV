@extends('layouts.app')

@section('title', 'Listado de Empresas')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Listado de Empresas</h1>
        <a href="{{ route('companies.create') }}" class="btn btn-success">
            Añadir Empresa
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Sector</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Email</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($companies as $company)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($company->logo)
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo de {{ $company->name }}" class="rounded-circle me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <strong>{{ $company->name }}</strong>
                                            <div class="text-muted small">{{ $company->city }}, {{ $company->province }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $company->sector }}</td>
                                <td>{{ $company->contact }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>
                                    <a href="{{ route('companies.show', $company) }}" class="btn btn-sm btn-info">Ver</a>
                                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta empresa?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No hay empresas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $companies->links() }}
    </div>
</div>
@endsection
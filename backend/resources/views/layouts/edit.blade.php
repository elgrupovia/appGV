@extends('layouts.app')

@section('title', 'Editar Empresa')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Editar Empresa: ') . $company->name }}</div>
            <div class="card-body">
                    <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @include('layouts._form', ['company' => $company, 'submitButtonText' => 'Actualizar Empresa'])
                    </form>
            </div>
        </div>
    </div>
@endsection
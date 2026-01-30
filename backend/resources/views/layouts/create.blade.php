@extends('layouts.app')

@section('title', 'Añadir Nueva Empresa')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Añadir Nueva Empresa') }}</div>
            <div class="card-body">
                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                        @include('layouts._form', ['submitButtonText' => 'Crear Empresa'])
                    </form>
            </div>
        </div>
    </div>
@endsection
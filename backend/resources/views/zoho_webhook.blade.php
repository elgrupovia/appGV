@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Datos recibidos desde Zoho CRM</h1>
    @if($data)
        <pre>{{ json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
    @else
        <p>No se han recibido datos aún.</p>
    @endif
</div>
@endsection

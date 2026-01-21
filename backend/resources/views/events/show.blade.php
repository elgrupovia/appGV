@extends('layouts.app')

@section('title', $event->name)

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if ($event->image)
                <img src="{{ $event->image }}" class="img-fluid mb-3" alt="{{ $event->name }}">
            @endif
            <h1>{{ $event->name }}</h1>
            <p><strong>Date:</strong> {{ $event->date }}</p>
            <p><strong>City:</strong> {{ $event->city }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Type:</strong> {{ $event->type }}</p>
            @if ($event->sponsors)
                <p><strong>Sponsors:</strong> {{ $event->sponsors }}</p>
            @endif
            <a href="/events" class="btn btn-secondary">Back to Events</a>
        </div>
    </div>
@endsection

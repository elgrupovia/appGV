@extends('layouts.app')

@section('title', 'Events')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Events</h1>
                @auth
                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a>
                    @endif
                @endauth
            </div>
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($event->image)
                                <img src="{{ $event->image }}" class="card-img-top" alt="{{ $event->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text">{{ $event->city }}</p>
                                <p class="card-text"><small class="text-muted">{{ $event->date }}</small></p>
                                <a href="/events/{{ $event->id }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

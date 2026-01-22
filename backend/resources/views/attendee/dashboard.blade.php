@extends('layouts.app')

@section('title', 'Attendee Dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Attendee Dashboard</h1>
        <p class="mb-4">Welcome, {{ Auth::user()->name }}!</p>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-2">My Registered Events</h2>
            <p class="text-gray-600">Here is a list of events you are registered for.</p>
            {{-- Logic to display user's registered events will go here --}}
        </div>
    </div>
@endsection

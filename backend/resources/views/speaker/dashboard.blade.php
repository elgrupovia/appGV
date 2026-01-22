@extends('layouts.app')

@section('title', 'Speaker Dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Speaker Dashboard</h1>
        <p class="mb-4">Welcome, {{ Auth::user()->name }}!</p>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-2">My Sessions</h2>
            <p class="text-gray-600">Here you will find a list of sessions you are speaking at.</p>
            {{-- Logic to display speaker's sessions will go here --}}
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Sponsor Dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Sponsor Dashboard</h1>
        <p class="mb-4">Welcome, {{ Auth::user()->name }}!</p>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-2">My Sponsorship Details</h2>
            <p class="text-gray-600">Here you will find information about your sponsorship package and benefits.</p>
            {{-- Logic to display sponsor's details will go here --}}
        </div>
    </div>
@endsection

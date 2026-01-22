@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Manage Users</h2>
                <p class="text-gray-600 mb-4">Create, view, and manage user accounts and roles.</p>
                <a href="{{ url('/users') }}" class="text-blue-500 hover:text-blue-700">Go to Users &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">Manage Events</h2>
                <p class="text-gray-600 mb-4">Create new events, and manage existing ones.</p>
                <a href="{{ url('/events') }}" class="text-blue-500 hover:text-blue-700">Go to Events &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">View Registrations</h2>
                <p class="text-gray-600 mb-4">See who is registered for which events.</p>
                <a href="{{ url('/registrations') }}" class="text-blue-500 hover:text-blue-700">Go to Registrations &rarr;</a>
            </div>

        </div>
    </div>
@endsection

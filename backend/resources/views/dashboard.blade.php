@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="text-center">
    <h1 class="text-4xl font-bold">Welcome to Your Dashboard</h1>
    <p class="mt-4 text-lg text-gray-600">Please select an option from the navigation bar to get started.</p>

    <div class="mt-8 space-y-4">
        @if(Auth::user()->isAdmin())
            <p>You are logged in as an <strong>Admin</strong>.</p>
            <a href="{{ url('/admin/dashboard') }}" class="inline-block px-6 py-3 mt-4 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-700">
                Go to Admin Dashboard
            </a>
        @endif

        @if(Auth::user()->isSpeaker())
            <p>You are logged in as a <strong>Speaker</strong>.</p>
             <a href="{{ url('/speaker/dashboard') }}" class="inline-block px-6 py-3 mt-4 text-sm font-semibold text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700">
                Go to Speaker Dashboard
            </a>
        @endif
        
        @if(Auth::user()->isSponsor())
            <p>You are logged in as a <strong>Sponsor</strong>.</p>
             <a href="{{ url('/sponsor/dashboard') }}" class="inline-block px-6 py-3 mt-4 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700">
                Go to Sponsor Dashboard
            </a>
        @endif

        @if(Auth::user()->isAttendee())
            <p>You are logged in as an <strong>Attendee</strong>.</p>
             <a href="{{ url('/attendee/dashboard') }}" class="inline-block px-6 py-3 mt-4 text-sm font-semibold text-white bg-purple-600 rounded-md shadow-sm hover:bg-purple-700">
                Go to My Dashboard
            </a>
        @endif
    </div>
</div>
@endsection

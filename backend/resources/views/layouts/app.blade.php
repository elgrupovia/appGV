<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'AppGV')</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div>
                    <a class="text-xl font-semibold text-gray-800" href="{{ url('/') }}">AppGV</a>
                </div>
                <div>
                    @guest
                        <a class="text-gray-800 hover:text-blue-500" href="{{ route('login') }}">Login</a>
                        <a class="ml-4 text-gray-800 hover:text-blue-500" href="{{ route('register') }}">Register</a>
                    @else
                        <span class="text-gray-800 text-sm pr-4">{{ Auth::user()->name }}</span>
                        
                        @if(Auth::user()->isAdmin())
                            <a href="{{ url('/admin/dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600">Admin Dashboard</a>
                        @endif

                        @if(Auth::user()->isSpeaker())
                             <a href="{{ url('/speaker/dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600">Speaker Dashboard</a>
                        @endif
                        
                        @if(Auth::user()->isSponsor())
                             <a href="{{ url('/sponsor/dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600">Sponsor Dashboard</a>
                        @endif

                        @if(Auth::user()->isAttendee())
                             <a href="{{ url('/attendee/dashboard') }}" class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600">My Dashboard</a>
                        @endif
                        
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-gray-800 hover:text-blue-500 ml-4">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

</body>
</html>

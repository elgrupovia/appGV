<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class WebEventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        return view('events.index', ['events' => $events]);
    }

    public function show(Event $event)
    {
        return view('events.show', ['event' => $event]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'city' => 'required|string|max:255',
            'type' => 'required|in:Normal,Networking',
            'location' => 'required|string|max:255',
            'sponsors' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ]);

        Event::create($request->all());

        return redirect('/events')->with('success', 'Event created successfully!');
    }
}

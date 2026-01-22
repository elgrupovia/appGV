<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        \Log::info('Entrando a create() de WebEventController', [
            'user_id' => auth()->id(),
            'user_email' => auth()->check() ? auth()->user()->email : null,
            'user_roles' => auth()->check() ? auth()->user()->roles->pluck('name') : null,
        ]);
        return view('events.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }
        \Log::info('Entrando a store() de WebEventController', [
            'user_id' => auth()->id(),
            'user_email' => auth()->check() ? auth()->user()->email : null,
            'user_roles' => auth()->check() ? auth()->user()->roles->pluck('name') : null,
            'request_data' => $request->all(),
        ]);
        $rules = [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'city' => 'required|string|max:255',
            'type' => 'required|in:Normal,Networking',
            'location' => 'required|string|max:255',
            'sponsors' => 'nullable|string',
            'image' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            \Log::warning('Event creation validation failed:', ['errors' => $validator->errors()->all(), 'request_data' => $request->all()]);
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $event = Event::create($request->all());

        \Log::info('Event created successfully!', ['event_id' => $event->id, 'event_data' => $event->toArray()]);

        return redirect('/events')->with('success', 'Event created successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::all();
        $registrations = Registration::with(['user', 'event']);

        if ($request->has('event_id') && $request->event_id != '') {
            $registrations->where('event_id', $request->event_id);
        }

        $registrations = $registrations->get();

        return view('registrations.index', compact('registrations', 'events'));
    }

    public function create()
    {
        $users = User::all();
        $events = Event::all();
        return view('registrations.create', compact('users', 'events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
        ]);
        Registration::create($validated);
        return redirect('/registrations')->with('success', 'Registro creado correctamente');
    }

    public function show(Registration $registration)
    {
        $registration->load(['user', 'event']);
        return view('registrations.show', compact('registration'));
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect('/registrations')->with('success', 'Registro eliminado correctamente');
    }
}

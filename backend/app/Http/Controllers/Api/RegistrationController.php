<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Store a newly created registration in storage.
     */
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        // Check if the user is already registered for this event
        $existingRegistration = Registration::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->first();

        if ($existingRegistration) {
            return response()->json(['message' => 'Ya estás registrado para este evento.'], 409); // 409 Conflict
        }

        $registration = new Registration();
        $registration->user_id = $user->id;
        $registration->event_id = $event->id;
        $registration->save();

        return response()->json([
            'message' => 'Registrado correctamente en el evento.',
            'registration' => $registration
        ], 201);
    }

    /**
     * Display the user's registrations.
     */
    public function index()
    {
        $user = Auth::user();
        $registrations = Registration::with('event')
            ->where('user_id', $user->id)
            ->get();

        return response()->json($registrations);
    }

    /**
     * Remove the specified registration from storage.
     */
    public function destroy(Registration $registration)
    {
        // Check if the authenticated user owns this registration
        if (Auth::id() !== $registration->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $registration->delete();

        return response()->json(['message' => 'Registro cancelado correctamente.']);
    }
}

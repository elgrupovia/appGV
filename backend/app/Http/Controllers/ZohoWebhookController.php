<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ZohoWebhookController extends Controller
{
    /**
     * Maneja el webhook de Zoho: guarda los datos para depuración y crea un nuevo evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handleWebhook(Request $request)
    {
        // 1. Guardar el payload para depuración (lógica del segundo controlador)
        $data = $request->all();
        Storage::disk('local')->put('zoho_webhook.json', json_encode($data, JSON_PRETTY_PRINT));

        // Log para debugging
        Log::info('Zoho Webhook received:', $data);

        // 2. Validar y crear el evento (lógica del primer controlador)
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'city' => 'required|string|max:255',
            'type' => 'required|in:Normal,Networking',
            'location' => 'required|string|max:255',
            'sponsors' => 'nullable|string',
            'image' => 'nullable|string|url',
        ]);

        if ($validator->fails()) {
            Log::error('Zoho Webhook Validation Failed:', $validator->errors()->toArray());
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Crear el evento si la validación es exitosa
            $event = Event::create($validator->validated());

            Log::info('New event created from Zoho webhook:', $event->toArray());

            // Responder con éxito
            return response()->json(['message' => 'Event created successfully', 'event_id' => $event->id], 201);

        } catch (\Exception $e) {
            Log::error('Error creating event from Zoho webhook: ' . $e->getMessage());
            return response()->json(['message' => 'An internal error occurred while creating the event.'], 500);
        }
    }

    /**
     * Muestra los datos del último webhook recibido para depuración.
     *
     * @return \Illuminate\View\View
     */
    public function showLastWebhook()
    {
        if (Storage::disk('local')->exists('zoho_webhook.json')) {
            $data = json_decode(Storage::disk('local')->get('zoho_webhook.json'), true);
        } else {
            $data = null;
        }
        return view('zoho_webhook', ['data' => $data]);
    }
}


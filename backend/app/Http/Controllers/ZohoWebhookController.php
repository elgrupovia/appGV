<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ZohoWebhookController extends Controller
{
    /**
     * Handle the incoming Zoho webhook to create a new event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request)
    {
        // Log the entire request from Zoho for debugging purposes
        Log::info('Zoho Webhook received:', $request->all());

        // We assume the data is at the root of the request.
        // If Zoho sends it nested (e.g., inside a 'data' key),
        // you might need to change $request->all() to $request->input('data').
        $data = $request->all();

        // Validate the incoming data against your event fields.
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'city' => 'required|string|max:255',
            'type' => 'required|in:Normal,Networking',
            'location' => 'required|string|max:255',
            'sponsors' => 'nullable|string',
            'image' => 'nullable|string|url', // Assuming Zoho sends a URL for the image
        ]);

        if ($validator->fails()) {
            Log::error('Zoho Webhook Validation Failed:', $validator->errors()->toArray());
            // Respond with validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create the event if validation passes
            $event = Event::create($validator->validated());

            Log::info('New event created from Zoho webhook:', $event->toArray());

            // Respond with success
            return response()->json(['message' => 'Event created successfully', 'event_id' => $event->id], 201);

        } catch (\Exception $e) {
            Log::error('Error creating event from Zoho webhook: ' . $e->getMessage());
            // Return a generic error to the webhook sender
            return response()->json(['message' => 'An internal error occurred while creating the event.'], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZohoWebhookController extends Controller
{
    public function receive(Request $request)
    {
        // Guardar el payload recibido en un archivo para mostrarlo luego
        $data = $request->all();
        Storage::disk('local')->put('zoho_webhook.json', json_encode($data, JSON_PRETTY_PRINT));
        return response()->json(['status' => 'received', 'data' => $data]);
    }

    public function show()
    {
        // Leer el último payload recibido
        if (Storage::disk('local')->exists('zoho_webhook.json')) {
            $data = json_decode(Storage::disk('local')->get('zoho_webhook.json'), true);
        } else {
            $data = null;
        }
        return view('zoho_webhook', ['data' => $data]);
    }
}

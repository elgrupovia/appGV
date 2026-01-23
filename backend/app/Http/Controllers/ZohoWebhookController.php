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

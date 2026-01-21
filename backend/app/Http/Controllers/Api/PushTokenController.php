<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PushToken;

class PushTokenController extends Controller
{
    /**
     * Store a new push token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|unique:push_tokens,token',
            'device_type' => 'required|in:android,ios',
        ]);

        $token = PushToken::create([
            'user_id' => auth()->id(),
            'token' => $request->token,
            'device_type' => $request->device_type,
        ]);

        return response()->json(['message' => 'El token push se almacenó correctamente.', 'token' => $token], 201);
    }
}

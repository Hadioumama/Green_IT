<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function store(Request $request)
{
    Device::create([  // utilise le Modèle
        'name' => $request->name,    // données envoyées par l'user
        'type' => $request->type,
        'power' => $request->power,
        'user_id' => auth()->id()  // user connecté automatiquement
    ]);

    return response()->json(['message' => 'Device ajouté']);
}
}

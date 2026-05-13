<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EnergyLog;

class EnergyController extends Controller
{
     public function store(Request $request)
    {
        EnergyLog::create([
            'device_id' => $request->device_id,
            'consumption' => $request->consumption,
            'date' => now()
        ]);

        return response()->json([
            'message' => 'Consommation enregistrée'
        ]);
    }

    public function totalConsumption()
{
    $total = EnergyLog::sum('consumption');

    return response()->json([
        'total_consumption' => $total
    ]);
}

 public function carbonEmission()
{
    $total = EnergyLog::sum('consumption');

    $co2 = $total * 0.5;

    return response()->json([
        'co2' => $co2
    ]);
}

public function byDevice()
{
    $data = EnergyLog::selectRaw('device_id, SUM(consumption) as total')
        ->groupBy('device_id')
        ->get();

    return response()->json($data);
}
}

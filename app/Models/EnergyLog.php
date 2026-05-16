<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyLog extends Model
{
    use HasFactory;

    /**
     * Champs saisissables
     * 
     * NOTE : La migration 2026_05_12 utilise 'consumption' (float)
     *        La migration 2026_05_16 utilise 'consumption_kwh' (decimal)
     *        Les deux coexistent pour compatibilité ancienne/nouvelle API
     */
    protected $fillable = [
        'device_id',
        'consumption',        // ← ancienne migration (compatibilité API)
        'consumption_kwh',  // ← nouvelle migration
        'emission_co2_kg',
        'date',             // ← ancienne migration
        'date_debut',       // ← nouvelle migration
        'date_fin',
        'source',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'date_debut' => 'date',
        'date_fin' => 'date',
        'consumption' => 'float',
        'consumption_kwh' => 'decimal:2',
        'emission_co2_kg' => 'decimal:2',
    ];

    /**
     * Un energy_log appartient à un device
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
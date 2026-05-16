<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'consumption_kwh',
        'emission_co2_kg',
        'date_debut',
        'date_fin',
        'source',
        'notes',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
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
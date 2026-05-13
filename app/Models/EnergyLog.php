<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;   // 👈 AJOUTER cet import !

class EnergyLog extends Model
{
    use HasFactory;

    // Les champs autorisés à être remplis
    protected $fillable = [
        'device_id',
        'consumption',
        'date'
    ];

    // EnergyLog appartient à un Device
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

      // ✅ AJOUTER ÇA (TRÈS IMPORTANT)
    protected $fillable = [
        'name',
        'type',
        'power',
        'user_id'
    ];

    public function user()
{
    return $this->belongsTo(User::class);// device appartient à un user
}

public function logs()
{
    return $this->hasMany(EnergyLog::class);// device a plusieurs logs
}
}

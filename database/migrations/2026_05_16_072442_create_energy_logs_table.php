<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('energy_logs', function (Blueprint $table) {
            $table->id();
            
            // ========== CLÉ ÉTRANGÈRE : device concerné ==========
            // constrained('devices') = FK vers devices.id
            // cascadeOnDelete = si device supprimé, logs supprimés aussi
            $table->foreignId('device_id')
                  ->constrained('devices')    // FK vers devices.id
                  ->cascadeOnDelete();          // Suppression en cascade
            
            // ========== DONNÉES MESURÉES (saisies ou API) ==========
            $table->decimal('consumption_kwh', 10, 2);     // Consommation réelle kWh
            $table->decimal('emission_co2_kg', 10, 2)->nullable(); // CO₂ calculé
            
            // ========== PÉRIODE ==========
            $table->date('date_debut');      // Début période mesure
            $table->date('date_fin');         // Fin période mesure
            
            // ========== SOURCE ==========
            $table->enum('source', [
                'mesure_reelle',      // Compteur électrique
                'estimation',         // Calcul théorique
                'facture',            // Données fournisseur
                'api_carbon'          // API externe
            ])->default('estimation');
            
            // ========== NOTES ==========
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('energy_logs');
    }
};
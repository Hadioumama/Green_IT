<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            
            // ========== IDENTIFICATION (saisi par admin) ==========
            $table->string('nom');                    // Nom de l'équipement
            $table->enum('type', [
                'PC', 
                'Serveur', 
                'Switch', 
                'Routeur', 
                'Imprimante', 
                'Écran', 
                'Onduleur', 
                'Autre'
            ]);
            $table->string('marque')->nullable();      // Dell, HP, Cisco...
            $table->string('modele')->nullable();       // OptiPlex 7090
            $table->string('numero_serie')->unique();    // Numéro de série unique
            
            // ========== ACHAT (saisi par admin) ==========
            $table->date('date_achat')->nullable();
            $table->decimal('prix', 10, 2)->nullable(); // Prix en MAD
            
            // ========== CONSOMMATION (saisi par admin) ==========
            // Seule donnée énergétique connue : puissance sur étiquette
            $table->decimal('puissance_watt', 8, 2)->nullable();
            
            // ========== DONNÉES CALCULÉES (auto, pas de saisie) ==========
            // Remplies par l'application après création
            $table->decimal('conso_annuelle_kwh', 10, 2)->nullable();
            $table->decimal('emission_co2_kg', 10, 2)->nullable();
            $table->decimal('empreinte_carbone_fab', 10, 2)->nullable();
            
            // ========== CLASSE ÉNERGÉTIQUE (optionnel) ==========
            $table->enum('efficacite_energetique', [
                'A+++', 'A++', 'A+', 'A', 'B', 'C', 'D', 'Non classé'
            ])->default('Non classé');
            
            // ========== CYCLE DE VIE (saisi par admin) ==========
            $table->integer('duree_vie_annees')->nullable();
            $table->date('date_mise_hors_service')->nullable();
            
            // ========== STATUT & LOCALISATION ==========
            $table->enum('statut', [
                'actif', 
                'en_reparation', 
                'hors_service', 
                'stock', 
                'recycle'
            ])->default('stock');
            $table->string('localisation')->nullable();  // Bureau 301, Salle serveur...
            
            // ========== CLÉ ÉTRANGÈRE : responsable (user) ==========
            // nullable = équipement peut ne pas avoir de responsable assigné
            // nullOnDelete = si user supprimé, device garde user_id = null
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')  // FK vers users.id
                  ->nullOnDelete();        // Pas de suppression en cascade
            
            // ========== NOTES ==========
            $table->text('description')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
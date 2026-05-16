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
            $table->string('nom');
            $table->enum('type', ['PC', 'Serveur', 'Switch', 'Routeur', 'Imprimante', 'Écran', 'Onduleur', 'Autre']);
            $table->string('marque')->nullable();
            $table->string('modele')->nullable();
            $table->string('numero_serie')->unique();
            $table->date('date_achat')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->decimal('puissance_watt', 8, 2)->nullable();
            $table->decimal('conso_annuelle_kwh', 10, 2)->nullable();
            $table->enum('efficacite_energetique', ['A+++', 'A++', 'A+', 'A', 'B', 'C', 'D', 'Non classé'])->default('Non classé');
            $table->decimal('emission_co2_kg', 10, 2)->nullable();
            $table->decimal('empreinte_carbone_fab', 10, 2)->nullable();
            $table->integer('duree_vie_annees')->nullable();
            $table->date('date_mise_hors_service')->nullable();
            $table->enum('statut', ['actif', 'en_reparation', 'hors_service', 'stock', 'recycle'])->default('stock');
            $table->string('localisation')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
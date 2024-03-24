<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ajouter les clefs étrangères après la colonne adresse
            $table->after('adresse', function (Blueprint $table) {
                $table->boolean('status')->default(true);
                $table->foreignId('role_id')->default(2)->constrained()
                    ->onDelete('cascade')->onUpdate('cascade');
                $table->foreignId('permis_conduite_id')->nullable()->constrained()
                    ->onDelete('cascade')->onUpdate('cascade');
                $table->foreignId('vehicule_id')->nullable()->constrained()
                    ->onDelete('cascade')->onUpdate('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropForeign(['role_id']);
            $table->dropForeign(['permis_conduite_id']);
            $table->dropForeign(['vehicule_id']);
            $table->dropColumn('role_id');
            $table->dropColumn('permis_conduite_id');
            $table->dropColumn('vehicule_id');
        });
    }
};

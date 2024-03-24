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
        Schema::create('permis_conduites', function (Blueprint $table) {
            $table->id();
            $table->string("num_permis")->unique();
            $table->foreignId('category_id')->constrained()
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('delivrance');
            $table->date('expiration');
            $table->integer('annee_experience');
            $table->boolean('is_valid');
            $table->foreignId('user_id')->constrained() ->
                cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permis_conduites');
    }
};

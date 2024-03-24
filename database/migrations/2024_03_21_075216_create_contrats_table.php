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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('salaire');
            $table->integer('duree')->nullable()->default(null);
            $table->enum('type', ['CDI', 'CDD']);
            $table->boolean('actived')->default(true);
            $table->date('date_embauche');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};

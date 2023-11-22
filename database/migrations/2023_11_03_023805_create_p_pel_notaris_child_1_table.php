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
        Schema::create('p_pel_notaris_child_1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_pel_notaris_id')->constrained('p_pel_notaris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('p_pel_notaris_child_1');
            $table->text('isi');
            $table->string('tarif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_pel_notaris_child_1');
    }
};

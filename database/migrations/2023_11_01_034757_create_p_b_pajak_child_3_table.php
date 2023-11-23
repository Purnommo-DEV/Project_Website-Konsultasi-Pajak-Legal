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
        Schema::create('p_b_pajak_child_3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('p_b_pajak_child_2_id')->constrained('p_b_pajak_child_2')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('p_pajak_id')->constrained('p_pajak')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('tarif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_b_pajak_child_3');
    }
};

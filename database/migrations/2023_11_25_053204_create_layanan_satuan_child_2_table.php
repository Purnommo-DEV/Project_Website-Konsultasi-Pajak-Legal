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
        Schema::create('layanan_satuan_child_2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_satuan_child_1_id')->constrained('layanan_satuan_child_1')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('layanan_satuan_child_2');
            $table->text('tarif');
            $table->string('timeline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_satuan_child_2');
    }
};

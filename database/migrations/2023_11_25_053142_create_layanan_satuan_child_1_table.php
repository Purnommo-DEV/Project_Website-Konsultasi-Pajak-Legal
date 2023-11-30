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
        Schema::create('layanan_satuan_child_1', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_satuan_id')->constrained('layanan_satuan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('layanan_satuan_child_1');
            $table->string('slug');
            $table->text('path');
            $table->text('tipe_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_satuan_child_1');
    }
};

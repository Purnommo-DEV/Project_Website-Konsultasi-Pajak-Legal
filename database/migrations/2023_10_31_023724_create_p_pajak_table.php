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
        Schema::create('p_pajak', function (Blueprint $table) {
            $table->id();
            $table->string('paket');
            $table->text('slug');
            $table->text('isi');
            $table->string('tarif');
            $table->text('keterangan')->nullable();
            $table->text('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_pajak');
    }
};

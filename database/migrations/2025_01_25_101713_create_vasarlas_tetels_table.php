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
        Schema::create('vasarlas_tetels', function (Blueprint $table) {
            $table->primary(['vasarlas_id', 'termek_id']);
            $table->foreignId('vasarlas_id')->references('vasarlas_id')->on('vasarlas_fejs');
            $table->foreignId('termek_id')->references('termek_id')->on('termeks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vasarlas_tetels');
    }
};

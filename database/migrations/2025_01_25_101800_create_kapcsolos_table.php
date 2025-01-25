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
        Schema::create('kapcsolos', function (Blueprint $table) {
            
            $table->foreignId('termek_id')->references('termek_id')->on('termeks');
            $table->foreignId('cimke_id')->references('cimke_id')->on('cimkes');
            $table->primary(['termek_id', 'cimke_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapcsolos');
    }
};

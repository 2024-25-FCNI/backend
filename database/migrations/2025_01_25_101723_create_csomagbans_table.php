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
        Schema::create('csomagbans', function (Blueprint $table) {
            /* $table->id('csomag_id');
            $table->foreignId('termek_id')->references('termek_id')->on('termeks'); */    
            $table->foreignId('csomag_id');
            $table->foreignId('termek_id');       
            $table->timestamps();
            
            $table->primary(['csomag_id', 'termek_id']);
            
            $table->foreign('csomag_id')
                  ->references('termek_id')
                  ->on('termeks')
                  ->onDelete('cascade');
            $table->foreign('termek_id')
                  ->references('termek_id')
                  ->on('termeks')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csomagbans');
    }
};

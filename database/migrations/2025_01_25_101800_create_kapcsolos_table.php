<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

        DB::table('kapcsolos')->insert([
            ['termek_id' => 1, 'cimke_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Szalag
            ['termek_id' => 2, 'cimke_id' => 5, 'created_at' => now(), 'updated_at' => now()], // Nyújtás
            ['termek_id' => 3, 'cimke_id' => 2, 'created_at' => now(), 'updated_at' => now()], // Labda
            ['termek_id' => 4, 'cimke_id' => 3, 'created_at' => now(), 'updated_at' => now()], // Karika
            ['termek_id' => 5, 'cimke_id' => 6, 'created_at' => now(), 'updated_at' => now()], // Egyensúly
            ['termek_id' => 6, 'cimke_id' => 1, 'created_at' => now(), 'updated_at' => now()], // Szalag (koreográfia)
            ['termek_id' => 6, 'cimke_id' => 4, 'created_at' => now(), 'updated_at' => now()], // Koreográfia
        ]);
        
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('kapcsolos');
}
};


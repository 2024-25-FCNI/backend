<?php

use App\Models\VasarlasTetel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

       /*  VasarlasTetel::create([
            'vasarlas_id' => 1, // ha tudod, hogy ez lesz az ID
            'termek_id' => 13,
        ]); */


        // Ez a trigger automatikusan frissíti a vásárlási fej összegét, amikor egy új vásárlási tételt adnak hozzá.
        DB::unprepared('CREATE TRIGGER update_total_after_insert AFTER INSERT ON vasarlas_tetels
        FOR EACH ROW BEGIN
            UPDATE vasarlas_fejs SET osszeg = (
                SELECT SUM(termeks.ar) FROM vasarlas_tetels 
                JOIN termeks ON vasarlas_tetels.termek_id = termeks.termek_id
                WHERE vasarlas_tetels.vasarlas_id = NEW.vasarlas_id
            ) WHERE vasarlas_fejs.vasarlas_id = NEW.vasarlas_id;
        END;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vasarlas_tetels');
    }
};

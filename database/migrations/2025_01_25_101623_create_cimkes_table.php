<?php

use App\Models\Cimke;
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
        Schema::create('cimkes', function (Blueprint $table) {
            $table->id('cimke_id');
            $table->string('elnevezes');
            $table->timestamps();
        });


        Cimke::insert([
            [
                'elnevezes' => 'Új',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'elnevezes' => 'Akciós',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'elnevezes' => 'Kedvezményes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'elnevezes' => 'Top termék',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'elnevezes' => 'Limitált kiadás',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'elnevezes' => 'Ajánlott',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cimkes');
    }
};

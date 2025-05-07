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
            ['elnevezes' => 'Szalag', 'created_at' => now(), 'updated_at' => now()],
            ['elnevezes' => 'Labda', 'created_at' => now(), 'updated_at' => now()],
            ['elnevezes' => 'Karika', 'created_at' => now(), 'updated_at' => now()],
            ['elnevezes' => 'Koreográfia', 'created_at' => now(), 'updated_at' => now()],
            ['elnevezes' => 'Nyújtás', 'created_at' => now(), 'updated_at' => now()],
            ['elnevezes' => 'Egyensúly', 'created_at' => now(), 'updated_at' => now()],
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

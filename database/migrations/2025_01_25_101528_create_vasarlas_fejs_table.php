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
        Schema::create('vasarlas_fejs', function (Blueprint $table) {
            $table->id('vasarlas_id');
            //$table->foreignId('id')->references('id')->on('users');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('osszeg');
            $table->date('datum');
            $table->timestamps();
        });


        /*
        //Ez a constraint biztosítja, hogy egy vásárlás mindig egy létező user-hez legyen kötve.
         //Ha a felhasználó törlődik, akkor a hozzá tartozó vásárlások is automatikusan törlődnek.
        Schema::table('vasarlas_fejs', function (Blueprint $table) {
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
        }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vasarlas_fejs');
    }


    
};
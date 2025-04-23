<?php

use App\Models\Termek;
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
        Schema::create('termeks', function (Blueprint $table) {
            $table->id('termek_id');
            $table->string('cim');
            $table->string('bemutatas');
            $table->string('leiras');
            $table->string('video')->nullable();
            $table->integer('hozzaferesi_ido');
            $table->integer('ar');
            $table->string('jelzes');
           // $table->foreignId('cimke_id')->references('cimke_id')->on('cimkes');
            $table->longText('kep');
            $table->timestamps();

        });


        Termek::insert([
            [
                'cim' => 'Termék 1',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez az első termék.',
                'video' => 'https://drive.google.com/file/d/1LMqjnFgRrVg2-l3CtrejDaefkw9G7PVI/view?usp=drive_link',
                'hozzaferesi_ido' => 30,
                'ar' => 5000,
                'jelzes' => 'új',
                // 'cimke_id' => 1,
                'kep' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 2',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez a második termék.',
                'video' => '/termek2',
                'hozzaferesi_ido' => 60,
                'ar' => 8000,
                'jelzes' => 'akciós',
                // 'cimke_id' => 2,
                'kep' => '/images/termek2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 3',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez a harmadik termék.',
                'video' => '/termek3',
                'hozzaferesi_ido' => 90,
                'ar' => 10000,
                'jelzes' => 'top',
                // 'cimke_id' => 3,
                'kep' => '/images/termek3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 4',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez a negyedik termék.',
                'video' => '/termek4',
                'hozzaferesi_ido' => 120,
                'ar' => 15000,
                'jelzes' => 'új',
                // 'cimke_id' => 4,
                'kep' => '/images/termek4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 5',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez az ötödik termék.',
                'video' => '/termek5',
                'hozzaferesi_ido' => 180,
                'ar' => 20000,
                'jelzes' => 'akciós',
                // 'cimke_id' => 5,
                'kep' => '/images/termek5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 6',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez a hatodik termék.',
                'video' => '/termek6',
                'hozzaferesi_ido' => 240,
                'ar' => 25000,
                'jelzes' => 'top',
                // 'cimke_id' => 6,
                'kep' => '/images/termek6.jpg',
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
        Schema::dropIfExists('termeks');
    }
};
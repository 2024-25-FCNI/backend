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
            $table->string('url');
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
                'url' => 'https://drive.google.com/file/d/1LMqjnFgRrVg2-l3CtrejDaefkw9G7PVI/view?usp=drive_link',
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
                'url' => '/termek2',
                'hozzaferesi_ido' => 60,
                'ar' => 8000,
                'jelzes' => 'akciós',
                // 'cimke_id' => 2,
                'kep' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 3',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez a harmadik termék.',
                'url' => '/termek3',
                'hozzaferesi_ido' => 90,
                'ar' => 10000,
                'jelzes' => 'top',
                // 'cimke_id' => 3,
                'kep' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 4',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez a negyedik termék.',
                'url' => '/termek4',
                'hozzaferesi_ido' => 120,
                'ar' => 15000,
                'jelzes' => 'új',
                // 'cimke_id' => 4,
                'kep' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 5',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez az ötödik termék.',
                'url' => '/termek5',
                'hozzaferesi_ido' => 180,
                'ar' => 20000,
                'jelzes' => 'akciós',
                // 'cimke_id' => 5,
                'kep' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 6',
                'bemutatas' => 'Ez az első termék.',
                'leiras' => 'Ez a hatodik termék.',
                'url' => '/termek6',
                'hozzaferesi_ido' => 240,
                'ar' => 25000,
                'jelzes' => 'top',
                // 'cimke_id' => 6,
                'kep' => '',
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
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
            $table->integer('jelzes')->default(1);
           // $table->foreignId('cimke_id')->references('cimke_id')->on('cimkes');
            $table->longText('kep');
            $table->timestamps();

        });


        Termek::insert([
            [
                'cim' => 'Alaptechnikák – szalag',
                'bemutatas' => 'Az egyik leglátványosabb kéziszer elsajátítása kezdőknek.',
                'leiras' => 'Ebben a 20 perces videóban a szalagos gyakorlatok alaptechnikáit sajátíthatod el. Lépésről lépésre, otthoni környezetben is végezhető.',
                'url' => '/szalag-alap',
                'hozzaferesi_ido' => 30,
                'ar' => 3000,
                'jelzes' => 1,
                'kep' => 'szalag_alap.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Nyújtás és mobilitás',
                'bemutatas' => 'Hajlékonyság és testtudatosság fejlesztése alapon.',
                'leiras' => 'Speciális nyújtó és mobilizáló gyakorlatsor 25 percben, mely segíti a hajlékonyság fejlesztését és a sérülések megelőzését.',
                'url' => '/nyujtas-mobilitas',
                'hozzaferesi_ido' => 30,
                'ar' => 3200,
                'jelzes' => 1,
                'kep' => 'nyujtas_mob.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Labdagyakorlat – középhaladó',
                'bemutatas' => 'A labda kéziszer művészi és technikai használata.',
                'leiras' => '30 perces videó, amelyben a labda eszköz középhaladó technikáit sajátíthatod el kombinált mozgássorokon keresztül.',
                'url' => '/labda-kozephalado',
                'hozzaferesi_ido' => 60,
                'ar' => 4000,
                'jelzes' => 1,
                'kep' => 'labda_kozep.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Karika technikák – kezdő szint',
                'bemutatas' => 'Játékos és pontos karikakezelés alapgyakorlatai.',
                'leiras' => '20 percben tanulhatod meg a karika alapvető dobásait, elkapásait és forgatásait – teljes test koordinációs fejlesztéssel.',
                'url' => '/karika-kezdoknek',
                'hozzaferesi_ido' => 30,
                'ar' => 2800,
                'jelzes' => 1,
                'kep' => 'karika_kezd.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Egyensúlygyakorlatok',
                'bemutatas' => 'Stabilitás és testkontroll fejlesztése a ritmikus gimnasztikában.',
                'leiras' => '25 perces videó, amely segít a biztos testtartás, forgások és egyensúlyi helyzetek elsajátításában. Ideális haladóknak és versenyzőknek is.',
                'url' => '/egyensuly-rg',
                'hozzaferesi_ido' => 60,
                'ar' => 3500,
                'jelzes' => 1,
                'kep' => 'egyensuly.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Ritmikus gimnasztika – koreográfia workshop',
                'bemutatas' => 'Rövid koreográfia tanulása kéziszerrel.',
                'leiras' => '40 perces, személyi edző által vezetett koreográfiás edzés, szalaggal és zenére. Cél a mozgás harmóniája és kifejezőkészség.',
                'url' => '/koreografia-szalag',
                'hozzaferesi_ido' => 90,
                'ar' => 5000,
                'jelzes' => 1,
                'kep' => 'koreografia.jpg',
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
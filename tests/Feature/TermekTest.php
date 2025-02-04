<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Termek;

class TermekTest extends TestCase
{
    use RefreshDatabase;

    public function test_termekek_listazasa()
    {
        // Mivel a migráció már beszúr 6 terméket, azokat ellenőrizzük
        $this->seedDatabase(); // Adatbázis feltöltése migrációban megadott adatokkal

        // API hívás a termékek listázására
        $response = $this->get('/api/termekek');

        $response->assertStatus(200);
    }

    public function test_egy_termek_lekerese()
    {
        $this->seedDatabase();

        // Kiválasztunk egy létező terméket az adatbázisból
        $termek = Termek::first();

        // Lekérjük az adott terméket az API-ból
        $response = $this->get('/api/termekek/' . $termek->termek_id);

        $response->assertStatus(200)
                 ->assertJson([
                     'termek_id' => $termek->termek_id,
                     'cim' => $termek->cim,
                     'ar' => $termek->ar
                 ]);
    }

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    private function seedDatabase()
    {
        Termek::insert([
            [
                'cim' => 'Termék 1',
                'leiras' => 'Ez az első termék.',
                'url' => '/termek1',
                'hozzaferesi_ido' => 30,
                'ar' => 5000,
                'jelzes' => 'új',
                'cimke_id' => 1,
                'kep' => '/images/termek1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 2',
                'leiras' => 'Ez a második termék.',
                'url' => '/termek2',
                'hozzaferesi_ido' => 60,
                'ar' => 8000,
                'jelzes' => 'akciós',
                'cimke_id' => 2,
                'kep' => '/images/termek2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 3',
                'leiras' => 'Ez a harmadik termék.',
                'url' => '/termek3',
                'hozzaferesi_ido' => 90,
                'ar' => 10000,
                'jelzes' => 'top',
                'cimke_id' => 3,
                'kep' => '/images/termek3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 4',
                'leiras' => 'Ez a negyedik termék.',
                'url' => '/termek4',
                'hozzaferesi_ido' => 120,
                'ar' => 15000,
                'jelzes' => 'új',
                'cimke_id' => 4,
                'kep' => '/images/termek4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 5',
                'leiras' => 'Ez az ötödik termék.',
                'url' => '/termek5',
                'hozzaferesi_ido' => 180,
                'ar' => 20000,
                'jelzes' => 'akciós',
                'cimke_id' => 5,
                'kep' => '/images/termek5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cim' => 'Termék 6',
                'leiras' => 'Ez a hatodik termék.',
                'url' => '/termek6',
                'hozzaferesi_ido' => 240,
                'ar' => 25000,
                'jelzes' => 'top',
                'cimke_id' => 6,
                'kep' => '/images/termek6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

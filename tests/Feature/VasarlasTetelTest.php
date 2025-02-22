<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\VasarlasTetel;
use App\Models\VasarlasFej;
use App\Models\Termek;

class VasarlasTetelTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function vasarlas_tetel_letrehozhato()
    {
        $vasarlas = VasarlasFej::create(['id' => 1, 'osszeg' => 10000, 'datum' => now()->toDateString()]);
        $termek = Termek::create(['termek_id' => 1, 'cim' => 'Teszt Termék', 'ar' => 5000]);

        $response = $this->postJson('/api/vasarlas_tetelek', [
            'vasarlas_id' => $vasarlas->id,
            'termek_id' => $termek->termek_id
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('vasarlas_tetels', ['vasarlas_id' => 1, 'termek_id' => 1]);
    }
}

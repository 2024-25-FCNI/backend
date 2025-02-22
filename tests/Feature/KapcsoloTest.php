<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Kapcsolo;
use App\Models\Termek;
use App\Models\Cimke;

class KapcsoloTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function kapcsolo_letrehozhato()
    {
        $termek = Termek::create(['termek_id' => 1, 'cim' => 'Teszt Termék', 'ar' => 5000]);
        $cimke = Cimke::create(['cimke_id' => 1, 'elnevezes' => 'Akciós']);

        $response = $this->postJson('/api/kapcsolok', [
            'termek_id' => $termek->termek_id,
            'cimke_id' => $cimke->cimke_id
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('kapcsolos', ['termek_id' => 1, 'cimke_id' => 1]);
    }
}

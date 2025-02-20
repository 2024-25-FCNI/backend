<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Csomagban;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CsomagbanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function csomagban_letrehozhato()
    {
        $response = $this->postJson('/api/csomagban', [
            'nev' => 'Teszt Csomag'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('csomagbans', ['nev' => 'Teszt Csomag']);
    }

    /** @test */
    public function csomagban_listazasa()
    {
        Csomagban::factory()->count(2)->create();

        $response = $this->getJson('/api/csomagban');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
    }
}

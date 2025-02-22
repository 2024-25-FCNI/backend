<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cimke;

class CimkeTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function cimke_letrehozhato()
    {
        $response = $this->postJson('/api/cimkek', [
            'cimke_id' => 1, 
            'elnevezes' => 'Akciós'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('cimkes', ['elnevezes' => 'Akciós']);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function cimke_listazasa()
    {
        $cimke = Cimke::create([
            'cimke_id' => 1,
            'elnevezes' => 'Limitált kiadás'
        ]);

        $response = $this->getJson('/api/cimkek');

        $response->assertStatus(200);
        $response->assertJsonFragment(['elnevezes' => 'Limitált kiadás']);
    }
}

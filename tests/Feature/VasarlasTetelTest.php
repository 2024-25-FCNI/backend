<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VasarlasTetelTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_vasarlasok_analitika_lekerese()
    {
        $response = $this->get('/api/vasarlasok-analitika');

        $response->assertStatus(200);
    }

   /*  public function test_bevetel_trend_lekerese()
    {
        $response = $this->get('/api/vasarlasok-analitika-idolepes');

        $response->assertStatus(200);
    }
 */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

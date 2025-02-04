<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FizetesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_fizetesi_visszaigazolas_kuldese()
    {
        $data = [
            'user_id' => 1,
            'osszeg' => 5000,
            'tranzakcio_id' => 'TRX123456'
        ];

        $response = $this->post('/api/send-payment-confirmation', $data);

        $response->assertStatus(200);
    }
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

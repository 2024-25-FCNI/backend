<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\VasarlasFej;
use App\Models\User;

class VasarlasFejTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function vasarlas_letrehozhato()
    {
        $user = User::create(['id' => 1, 'name' => 'Teszt User']);

        $response = $this->postJson('/api/vasarlasok', [
            'id' => 1,
            'user_id' => $user->id,
            'osszeg' => 10000,
            'datum' => now()->toDateString(),
            'status' => 'Fizetve'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('vasarlas_fejs', ['status' => 'Fizetve']);
    }
}

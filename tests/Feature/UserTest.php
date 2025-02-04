<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_felhasznalok_listazasa()
    {
        User::factory()->count(3)->create(); // Létrehozunk 3 felhasználót

        $response = $this->get('/api/felhasznalok');

        $response->assertStatus(200);
    }

    public function test_felhasznalo_torlese()
    {
        $user = User::factory()->create();

        $response = $this->delete('/api/felhasznalok/' . $user->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_users(): void
    {
        $response = $this->withoutMiddleware()->get('/api/felhasznalok');

        $response->assertStatus(200);
    }

    public function test_users_auth() : void {
            //$this->withoutExceptionHandling(); 
            // create rögzíti az adatbázisban a felh-t
            $admin = User::factory()->make([
                'role' => 0,
            ]);
            $response = $this->actingAs($admin)->get('/api/felhasznalok/'.$admin->id);
            $response->assertStatus(200);
        }
        
}
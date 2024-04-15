<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class JordiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_resultats()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/afegir1');
        $response->assertSee('afegir1'); 
    }
    public function test_loadResultats()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/afegir1');
        $response->assertStatus(200);   
    }
}
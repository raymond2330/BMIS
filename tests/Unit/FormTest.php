<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use App\Models\Household;
use App\Models\Resident;
use App\Models\User;
use App\Models\Street;

class FormTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'secretary account',
            'email' => 'secretary@server.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'user_type' => 0
        ]);

        $this->actingAs($this->user);
    }
    public function test_only_bonafide_residents_are_allowed_to_be_selected()
    {
        $response = $this->get('forms/certification');
        $response->assertStatus(200);
        $response->assertViewHas('residents');

    }
}

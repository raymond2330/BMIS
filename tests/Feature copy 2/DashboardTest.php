<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;


class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/dashboard');
        $response->assertStatus(200);
    }
    public function test_user_activity()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/admin-panel/user-activity');
        $response->assertStatus(200);
    }
    public function test_resident_bonafides_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/bonafide');
        $response->assertStatus(200);
    }
    public function test_resident_voters_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/voters');
        $response->assertStatus(200);
    }
    public function test_resident_seniors_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/seniors');
        $response->assertStatus(200);
    }
    public function test_resident_women_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/women');
        $response->assertStatus(200);
    }
    public function test_resident_women_and_children_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/womenchildren');
        $response->assertStatus(200);
    }
    public function test_resident_pregnants_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/pregnants');
        $response->assertStatus(200);
    }
    public function test_resident_pwds_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/pwds');
        $response->assertStatus(200);
    }
    public function test_resident_in_schools_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/inschools');
        $response->assertStatus(200);
    }
    public function test_resident_employed_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/employed');
        $response->assertStatus(200);
    }
    public function test_resident_unemployed_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/unemployed');
        $response->assertStatus(200);
    }
    public function test_resident_filipinos_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/filipinos');
        $response->assertStatus(200);
    }
    public function test_resident_non_filipinos_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/nonfil');
        $response->assertStatus(200);
    }
    public function test_resident_religion_table()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('/residents/religion');
        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Unit;

use App\Models\Announcement;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;


class AnnouncementTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;
    protected $user;

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
    public function test_announcement_can_be_stored()
    {

        $announcement = [
            'title' => 'Announcement 1',
            'announcement' => 'This is a test announcement'
        ];
        $response = $this->post(route('announcements.store'), $announcement);
        $response->assertStatus(302);
        $this->assertDatabaseHas('announcements', $announcement);
    }
    public function test_announcement_can_be_updated()
    {
        $announcement = Announcement::factory()->create([
            'title' => 'Old Title',
            'announcement' => 'Old Announcement',
        ]);

        $response = $this->post("/announcements/update/{$announcement->id}", [
            'title' => 'New Title',
            'announcement' => 'New Announcement',
        ]);

        $this->assertDatabaseHas('announcements', [
            'id' => $announcement->id,
            'title' => 'New Title',
            'announcement' => 'New Announcement',
        ]);
    }
    public function test_announcement_can_be_deleted()
    {
        $announcement = Announcement::factory()->create([
            'title' => 'Announcement Title',
            'announcement' => 'Announcement Body',
        ]);

        $response = $this->get("/announcements/destroy/{$announcement->id}");

        $this->assertDatabaseMissing('announcements', ['id' => $announcement->id]);
    }
    public function test_announcement_cannot_be_deleted_by_unauthorized_user_type()
    {
        $user = User::create([
            'name' => 'unauthorized user',
            'email' => 'unauthorized@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'user_type' => 1
        ]);
        $this->actingAs($user);

        $announcement = Announcement::factory()->create([
            'title' => 'Announcement Title',
            'announcement' => 'Announcement Body',
        ]);
        
        $response = $this->get("/announcements/destroy/{$announcement->id}");

        $this->assertDatabaseHas('announcements', [
            'title' => 'Announcement Title',
            'announcement' => 'Announcement Body',
        ]);
    }
}

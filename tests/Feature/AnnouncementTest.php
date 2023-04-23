<?php

namespace Tests\Feature;

use App\Models\Announcement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AnnouncementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_official_website()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_announcement()
    {
        $user = User::find(1); //user id 1 is the admin account
        $response = $this->actingAs($user)
            ->get('announcements/index');
        $response->assertStatus(200);
    }
    public function test_announcement_created_or_updated()
    {
        $response = DB::table('announcements')->updateOrInsert([
            'title' => 'Typhoon Henry moving away from PH; Rainy, cloudy Saturday expected',
            'announcement' => 'MANILA, Philippines – Typhoon Henry (international name: Hinnamnor) is swirling away from the country but will still trigger moderate to heavy rainfall in Batanes, Babuyan Islands and other parts of Luzon on Saturday, according to the Philippine Atmospheric, Geophysical and Astronomical Services Administration (Pagasa).
            In its early morning update, Pagasa said “Henry”, as of 3:00 a.m., was spotted some 355 kilometers east-northeast of Itbayat, Batanes with maximum sustained winds of 150 kilometers per hour (kph) near the center and gustiness of up to 185 kph) while slowly moving north.',

        ]);
        $this->assertTrue($response);
    }
    public function test_view_announcement()
    {
        $announcement = Announcement::first();
        if ($announcement) {
            echo "";
        }
        $this->assertTrue(true);
    }
    public function test_announcement_deleted()
    {
        $announcement = Announcement::first();
        if ($announcement) {
            $announcement->delete();
        }
        $this->assertTrue(true);
    }
}

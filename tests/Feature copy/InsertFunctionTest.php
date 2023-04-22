<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Announcement;
use App\Models\Certificate;
use App\Models\Dashboard;
use App\Models\Household;
use App\Models\Link;
use App\Models\Resident;
use App\Models\Street;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;


class InsertFunctionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_link_created()
    {
        $response = DB::table('links')->updateOrInsert([
            
                'title' => 'Services',
                'subtitle' => 'These are the services offered by the barangay',
                'hyperlink' => '#',
                'image' => 'services.jpg'
            
        ]);
        $this->assertTrue($response);
    }
    public function test_login()
    {
        $response = $this->post('/login', [
            'email' => 'secretary@server.com',
            'password' => 'secretary'
        ]);
        $response->assertRedirect('/dashboard');
    }
}

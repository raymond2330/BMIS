<?php

namespace Database\Seeders;
use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        Link::create([
            'title' => 'About barangay 385',
            'subtitle' => 'Be familiarized with the general information of the barangay',
            'hyperlink' => '#',
            'image' => 'about.jpg'
        ]);
        Link::create([
            'title' => 'Citizen Charter',
            'subtitle' => 'Read more about the charter',
            'hyperlink' => '#',
            'image' => 'charter.jpg'
        ]);
        Link::create([
            'title' => 'Frequently asked questions',
            'subtitle' => 'Here are the answers for the most commonly asked questions of the residents',
            'hyperlink' => '#',
            'image' => 'faqs.jpg'
        ]);
        Link::create([
            'title' => 'Services',
            'subtitle' => 'These are the services offered by the barangay',
            'hyperlink' => '#',
            'image' => 'services.jpg'
        ]);
    }
}

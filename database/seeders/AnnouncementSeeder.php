<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        Announcement::create([
            'title' => 'Typhoon Henry moving away from PH; Rainy, cloudy Saturday expected',
            'announcement' => 'MANILA, Philippines – Typhoon Henry (international name: Hinnamnor) is swirling away from the country but will still trigger moderate to heavy rainfall in Batanes, Babuyan Islands and other parts of Luzon on Saturday, according to the Philippine Atmospheric, Geophysical and Astronomical Services Administration (Pagasa).
            In its early morning update, Pagasa said “Henry”, as of 3:00 a.m., was spotted some 355 kilometers east-northeast of Itbayat, Batanes with maximum sustained winds of 150 kilometers per hour (kph) near the center and gustiness of up to 185 kph) while slowly moving north.',
        ]);
        Announcement::create([
            'title' => 'DOH – Ilocos hiring 500 nurses to boost COVID-19 vaccination drive',
            'announcement' => 'Child gets COVID-19 vaccination in Vigan
            A child gets vaccinated against COVID-19 in Vigan City, Ilocos Sur, during the launch of the vaccination of those aged 5 to 11 earlier this year.  (Photo from the Vigan City government)
            
            LAOAG CITY, Ilocos Norte – The Department of Health (DOH) is looking to hire around 500 nurses in a bid to bolster COVID-19 vaccination coverage in three Ilocos region.
            
            DOH Ilocos regional director Paula Paz Sydiongco on Thursday said that 250 nurses will be deployed in Pangasinan while the remaining would be assigned in Ilocos Sur, Ilocos Norte and La Union.
            
            The DOH had allotted at least P111 million for the hiring of the nurses under a contract of service arrangement, said Sydiongco.
            
            Earlier, the regional DOH had also deployed “social mobilizers” in Pangasinan and La Union to help in convincing more people about the advantages of getting vaccinated against COVID-19.
            
            Latest data from the health department showed that around 3.8 million residents have received their primary vaccine doses.
            
            Some 1.1 million have availed of booster shots.',
        ]);
    }
}

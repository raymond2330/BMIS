<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Resident;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\IncomeController;
use App\Models\Household;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        foreach (range(1, 2500) as $resident) {
            $household_id = $this->faker->numberBetween($min = 1, $max = 850);
            $household_head = $this->faker->randomElement(["Yes", "No"]);
            $income = $this->faker->numberBetween($min = 2500, $max = 100000);
            $resident = Resident::create([
                'household_id' =>  $household_id,
                'surname' => $this->faker->lastName($gender = null),
                'given_name' => $this->faker->firstName($gender = null),
                'middle_name' => $this->faker->lastName($gender = null),
                'birth_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
                'age' => $this->faker->numberBetween($min = 0, $max = 90),
                'sex' => $this->faker->randomElement(["Male", "Female"]),
                'religion' => $this->faker->randomElement(["Catholic", "INC", "Others"]),
                'civil_status' => $this->faker->randomElement(["Single", "Married", "Separated", "Annulled", "Widowed"]),
                'nationality' =>  $this->faker->randomElement(["Filipino", "Spanish", "Chinese"]),
                'contact' => $this->faker->numerify('09#########'),
                'household_head' => $household_head,
                'bona_fide' => $this->faker->randomElement(["Yes", "No"]),
                'resident_six_months' => $this->faker->randomElement(["Yes", "No"]),
                'solo_parent' => $this->faker->randomElement(["Yes", "No"]),
                'voter' => $this->faker->randomElement(["Yes", "No"]),
                'pwd' => $this->faker->randomElement(["No"]),
                'is_studying' => $this->faker->randomElement(["Yes", "No"]),
                'education' => $this->faker->randomElement([
                    "No grade completed",
                    "Elementary undergraduate",
                    "Elementary graduate",
                    "High school undergraduate",
                    "High school graduate",
                    "Post secondary undergraduate",
                    "Post secondary graduate",
                    "College undergraduate",
                    "College graduate",
                    "Post baccalaureate"
                ]),
                'institution' => $this->faker->company,
                'graduate_year' => $this->faker->date($format = 'Y-m'),
                'specialization' => $this->faker->jobTitle,
                'is_employed' => $this->faker->randomElement(["Yes", "No"]),
                'job_title' => $this->faker->randomElement([
                    "Manual Laborer",
                    "Doctor/Lawyer/Professionals",
                    "Government employee",
                    "Private employee",
                    "Pro-driver",
                    "Non pro-driver",
                    "Househelper",
                    "Lending",
                    "Vendor/Sales worker",
                    "Skilled agricultural forestry and fishery workers",
                    "Others"
                ]),
                'income' => $income,
                'income_classification' => IncomeController::store_household_income($income),
                'updated_at' => $this->faker->dateTimeBetween($startDate = '-1 year', $endDate = 'now', $timezone = null)
            ]);
            if ($household_head == "Yes") {
                DB::table('households')->where('id', $household_id)->increment('number_family', 1);
            }
            DB::table('households')->where('id', $household_id)->increment('household_size', 1);
            DB::table('households')->where('id', $household_id)->increment('income', $income);
            $household_income = Household::where('id', $household_id)->pluck('income')->first();
            DB::table('households')->where('id', $household_id)->update(
                [
                    'income_classification' => IncomeController::update_resident_household_income($household_income)
                ]
            );
        }
    }
}

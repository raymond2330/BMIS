<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Household;
use App\Models\Resident;
use App\Models\Street;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Support\Facades\Artisan;



class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('isMaster');
    }
    public function dashboard()
    {
        $general = $this->get_general_household_and_resident_information();
        $genderAge = $this->get_gender_and_age_distribution();
        $education = $this->get_education();
        $incomeClassesJob = $this->get_income_and_job_classes();
        $civilStatusNationality = $this->get_civil_status_and_nationality();
        $religion = $this->get_religion();
        $householdInformation = $this->get_household_information();
        $form_chart = $this->get_form_chart_options();
        return view('barangay-385.dashboard', compact(
            'general',
            'genderAge',
            'education',
            'incomeClassesJob',
            'civilStatusNationality',
            'religion',
            'householdInformation',
            'form_chart',
        ));
    }
    private function familiesPerStreet()
    {
        $unique_streets = Household::select('street_id as data')->distinct()->pluck('data');
        $number_families[] = null;
        foreach ($unique_streets as $unique_street) {
            $number_family = DB::table('households')->where('street_id', $unique_street)->sum('number_family');
            array_push($number_families, intval($number_family));
        }
        array_shift($number_families);
        return $number_families;
    }
    private function residentsPerStreet()
    {
        $unique_streets = Household::select('street_id as data')->distinct()->pluck('data');
        $number_residents[] = null;
        foreach ($unique_streets as $unique_street) {
            $number_resident = DB::table('households')->where('street_id', $unique_street)->sum('household_size');
            array_push($number_residents, intval($number_resident));
        }
        array_shift($number_residents);
        return $number_residents;
    }
    private function get_general_household_and_resident_information()
    {
        $general = [
            'household_count' => (Household::count() == 0) ? 1 : Household::count(),
            'resident_count' => (Resident::count() == 0) ? 1 : Resident::count(),
            'families' => Household::sum('number_family'),
            'bona_fide' => Resident::where('bona_fide', 'Yes')->count(),
            'voters' => Resident::where('voter', 'Yes')->where('age', '>=', 18)->count(),
            'senior_citizens' => Resident::where('age', '>=', 60)->count(),
            'household_per_street' => Street::select('household_count as data')->pluck('data'),
            'families_per_street' => $this->familiesPerStreet(),
            'residents_per_street' => $this->residentsPerStreet(),
            'street_names' => Street::select('street as name')->pluck('name'),
            'household_per_street' => Street::select('household_count as data')->pluck('data'),
            'families_per_street' => $this->familiesPerStreet(),
            'residents_per_street' => $this->residentsPerStreet()
        ];
        return $general;
    }
    private function get_gender_and_age_distribution()
    {
        $resident_count = (Resident::count() == 0) ? 1 : Resident::count();
        // gender and age distribution
        $males = Resident::where('sex', 'Male')->count();
        $females = Resident::where('sex', 'Female')->count();
        $infants_male = Resident::where('age', '<', 1)->where('sex', 'Male')->count();
        $children_male = Resident::where('age', '>=', 1)->where('age', '<=', 17)->where('sex', 'Male')->count();
        $adults_male = Resident::where('age', '>=', 18)->where('age', '<=', 59)->where('sex', 'Male')->count();
        $elderly_male = Resident::where('age', '>=', 60)->where('sex', 'Male')->count();
        $infants_female = Resident::where('age', '<', 1)->where('sex', 'Female')->count();
        $children_female = Resident::where('age', '>=', 1)->where('age', '<=', 17)->where('sex', 'Female')->count();
        $adults_female = Resident::where('age', '>=', 18)->where('age', '<=', 59)->where('sex', 'Female')->count();
        $elderly_female = Resident::where('age', '>=', 60)->where('sex', 'Female')->count();
        // pyramid age chart male
        $male_age_grp1 = round(($infants_male / $resident_count) * 100, 1);
        $male_age_grp2 = round((Resident::where('age', '>=', 1)->where('age', '<=', 2)->where('sex', 'Male')->count() / $resident_count) * 100, 1);
        $male_age_grp3 = round((Resident::where('age', '>=', 3)->where('age', '<=', 5)->where('sex', 'Male')->count() / $resident_count) * 100, 1);
        $male_age_grp4 = round((Resident::where('age', '>=', 6)->where('age', '<=', 12)->where('sex', 'Male')->count() / $resident_count) * 100, 1);
        $male_age_grp5 = round((Resident::where('age', '>=', 13)->where('age', '<=', 17)->where('sex', 'Male')->count() / $resident_count) * 100, 1);
        $male_age_grp6 = round(($adults_male / $resident_count) * 100, 1);
        $male_age_grp7 = round(($elderly_male / $resident_count) * 100, 1);
        // pyramid age chart female
        $female_age_grp1 = round(($infants_female / $resident_count) * 100, 1);
        $female_age_grp2 = round((Resident::where('age', '>=', 1)->where('age', '<=', 2)->where('sex', 'Female')->count() / $resident_count) * 100, 1);
        $female_age_grp3 = round((Resident::where('age', '>=', 3)->where('age', '<=', 5)->where('sex', 'Female')->count() / $resident_count) * 100, 1);
        $female_age_grp4 = round((Resident::where('age', '>=', 6)->where('age', '<=', 12)->where('sex', 'Female')->count() / $resident_count) * 100, 1);
        $female_age_grp5 = round((Resident::where('age', '>=', 13)->where('age', '<=', 17)->where('sex', 'Female')->count() / $resident_count) * 100, 1);
        $female_age_grp6 = round(($adults_female / $resident_count) * 100, 1);
        $female_age_grp7 = round(($elderly_female / $resident_count) * 100, 1);

        $genderAge = [
            'males' => Resident::where('sex', 'Male')->count(),
            'females' => Resident::where('sex', 'Female')->count(),
            'female_percentage' => round(($females / $resident_count) * 100, 2),
            'male_percentage' => round(($males / $resident_count) * 100, 2),
            'infants_male' => $infants_male,
            'children_male' => $children_male,
            'adults_male' => $adults_male,
            'elderly_male' => $elderly_male,
            'infants_female' => $infants_female,
            'children_female' => $children_female,
            'adults_female' => $adults_female,
            'elderly_female' => $elderly_female,
            'infants_percentage' => round((($infants_male + $infants_female) / $resident_count) * 100, 1),
            'children_percentage' => round((($children_male + $children_female) / $resident_count) * 100, 1),
            'adults_percentage' => round((($adults_male + $adults_female) / $resident_count) * 100, 1),
            'elderly_percentage' => round((($elderly_male + $elderly_female) / $resident_count) * 100, 1),
            'male_age_array' => array($male_age_grp1  * -1, $male_age_grp2 * -1, $male_age_grp3 * -1, $male_age_grp4 * -1, $male_age_grp5 * -1, $male_age_grp6 * -1, $male_age_grp7 * -1),
            'female_age_array' => array($female_age_grp1, $female_age_grp2, $female_age_grp3, $female_age_grp4, $female_age_grp5, $female_age_grp6, $female_age_grp7),
            'women_children' => $infants_female + $infants_male + $children_male + $children_female + Resident::where('sex', 'Female')->where('age', '>=', 18)->count(),
            'pregnants' => Resident::where('pregnant', 'Yes')->count(),
            'pwds' => Resident::where('pwd', 'Yes')->count()
        ];
        return $genderAge;
    }
    private function get_education()
    {
        $education = [
            'in_school' => Resident::where('is_studying', 'Yes')->count(),
            'outofschoolyouth' => Resident::where('is_studying', 'No')->where('age', '>=', 15)->where('age', '<=', 25)->where('education', 'High school undergraduate')->count(),
            'array_education' => Resident::select('education as name', DB::raw('count(education) data'))->groupBy('education')->pluck('data'),
            'array_education_categories' => Resident::select('education as name')->groupBy('education')->pluck('name')
        ];
        return $education;
    }
    private function get_income_and_job_classes()
    {
        $resident_count = (Resident::count() == 0) ? 1 : Resident::count();
        // income classification and job
        $incomeClassesJob = [
            'resident_poor' => round((Resident::where('income_classification', 'Poor')->count() / $resident_count) * 100, 1),
            'resident_low_income' => round((Resident::where('income_classification', 'Low income')->count() / $resident_count) * 100, 1),
            'resident_lower_middle' => round((Resident::where('income_classification', 'Lower middle class')->count() / $resident_count) * 100, 1),
            'resident_middle' => round((Resident::where('income_classification', 'Middle class')->count() / $resident_count) * 100, 1),
            'resident_upper_middle' => round((Resident::where('income_classification', 'Upper middle class')->count() / $resident_count) * 100, 1),
            'resident_rich' => round((Resident::where('income_classification', 'Rich')->count() / $resident_count) * 100, 1),
            'resident_high_income' => round((Resident::where('income_classification', 'High income')->count() / $resident_count) * 100, 1),
            'household_poor' => round((Household::where('income_classification', 'Poor')->count() / $resident_count) * 100, 1),
            'household_low_income' => round((Household::where('income_classification', 'Low income')->count() / $resident_count) * 100, 1),
            'household_lower_middle' => round((Household::where('income_classification', 'Lower middle class')->count() / $resident_count) * 100, 1),
            'household_middle' => round((Household::where('income_classification', 'Middle class')->count() / $resident_count) * 100, 1),
            'household_upper_middle' => round((Household::where('income_classification', 'Upper middle class')->count() / $resident_count) * 100, 1),
            'household_rich' => round((Household::where('income_classification', 'Rich')->count() / $resident_count) * 100, 1),
            'household_high_income' => round((Household::where('income_classification', 'High income')->count() / $resident_count) * 100, 1),
            'array_job_categories' => Resident::select('job_title as name')->groupBy('job_title')->pluck('name'),
            'array_job' => Resident::select('job_title as name', DB::raw('count(job_title) data'))->groupBy('job_title')->pluck('data'),
            'average_income' => round(Resident::average('income'), 2),
            'employed' => Resident::where('is_employed', 'Yes')->count(),
            'unemployed' => Resident::where('is_employed', 'No')->where('age', '>=', 18)->where('education', 'Post secondary graduate')->count()
        ];
        return $incomeClassesJob;
    }
    private function get_civil_status_and_nationality()
    {
        $resident_count = (Resident::count() == 0) ? 1 : Resident::count();
        $civilStatusNationality = [
            'civil_status_labels' => Resident::select('civil_status as name')->groupBy('civil_status')->pluck('name'),
            'civil_status' => Resident::select('civil_status as name', DB::raw('count(civil_status) data'))->groupBy('civil_status')->pluck('data'),
            'single' => Resident::where('civil_status', 'Single')->count(),
            'married' => Resident::where('civil_status', 'Married')->count(),
            'annulled' => Resident::where('civil_status', 'Annulled')->count(),
            'separated' => Resident::where('civil_status', 'Separated')->count(),
            'widowed' => Resident::where('civil_status', 'Widowed')->count(),
            'single_percentage' => round((Resident::where('civil_status', 'Single')->count() / $resident_count) * 100, 2),
            'married_percentage' => round((Resident::where('civil_status', 'Married')->count() / $resident_count) * 100, 2),
            'annulled_percentage' => round((Resident::where('civil_status', 'Annulled')->count() / $resident_count) * 100, 2),
            'separated_percentage' => round((Resident::where('civil_status', 'Separated')->count() / $resident_count) * 100, 2),
            'widowed_percentage' => round((Resident::where('civil_status', 'Widowed')->count() / $resident_count) * 100, 2),
            'filipinos' => Resident::where('nationality', 'Filipino')->count(),
            'non_filipinos' => Resident::where('nationality', '!=', 'Filipino')->count(),
            'filipinos_percentage' => round((Resident::where('nationality', 'Filipino')->count() / $resident_count) * 100, 2),
            'non_filipinos_percentage' => round((Resident::where('nationality', '!=', 'Filipino')->count() / $resident_count) * 100, 2),
        ];
        return $civilStatusNationality;
    }
    private function get_religion()
    {
        $resident_count = (Resident::count() == 0) ? 1 : Resident::count();
        // religion
        $religion = [
            'catholic_percentage' => round((Resident::where('religion', 'Catholic')->count() / $resident_count) * 100, 1),
            'inc_percentage' => round((Resident::where('religion', 'INC')->count() / $resident_count) * 100, 1),
            'other_religion_percentage' => round((Resident::where('religion', 'Others')->count() / $resident_count) * 100, 1),
        ];
        return $religion;
    }
    private function get_household_information()
    {
        $household_count = (Household::count() == 0) ? 1 : Household::count();
        $householdInformation = [
            'composting' =>  round((Household::where('waste_management', 'Composting')->count() / $household_count) * 100, 1),
            'incineration' =>  round((Household::where('waste_management', 'Incineration')->count() / $household_count) * 100, 1),
            'recycled' =>  round((Household::where('waste_management', 'Recycled')->count() / $household_count) * 100, 1),
            'waste_others' =>  round((Household::where('waste_management', 'Others')->count() / $household_count) * 100, 1),
            'pail' =>  round((Household::where('toilet', 'Pail type')->count() / $household_count) * 100, 1),
            'flushed' => round((Household::where('toilet', 'Water-sealed/Flushed')->count() / $household_count) * 100, 1),
            'toilet_others' =>  round((Household::where('toilet', 'Others')->count() / $household_count) * 100, 1),
            'no_toilet' =>  round((Household::where('toilet', 'No toilet facility')->count() / $household_count) * 100, 1),
            'concrete' =>  round((Household::where('dwelling_type', 'Concrete')->count() / $household_count) * 100, 1),
            'logwood' =>  round((Household::where('dwelling_type', 'Log/Wood')->count() / $household_count) * 100, 1),
            'semiconcrete' =>  round((Household::where('dwelling_type', 'Semi-concrete')->count() / $household_count) * 100, 1),
            'dwelling_others' =>  round((Household::where('dwelling_type', 'Others')->count() / $household_count) * 100, 1),
            'rented' =>  round((Household::where('ownership', 'Rented')->count() / $household_count) * 100, 1),
            'owned' =>  round((Household::where('ownership', 'Owned')->count() / $household_count) * 100, 1),
            'sharedowner' =>  round((Household::where('ownership', 'Shared with owner')->count() / $household_count) * 100, 1),
            'sharedrenter' => round((Household::where('ownership', 'Shared with renter')->count() / $household_count) * 100, 1),
            'informalsettler' =>  round((Household::where('ownership', 'Informal settler')->count() / $household_count) * 100, 1),
        ];
        return $householdInformation;
    }
    private function get_form_chart_options()
    {
        $form_chart_options = [
            'chart_title' => 'Forms requested by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Certificate',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $form_chart = new LaravelChart($form_chart_options);
        return $form_chart;
    }
    public function backup()
    {
        set_time_limit(980);
        ini_set('memory_limit', '256M');
        Artisan::call('backup:run');
        return redirect('/dashboard')->with('backup', '');
    }
    public function bonafide()
    {
        $bonafides = Resident::where('bona_fide', 'Yes')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.bonafide', compact('bonafides'));
    }
    public function voters()
    {
        $voters = Resident::where('voter', 'Yes')
            ->where('age', '>=', 18)
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.voters', compact('voters'));
    }
    public function seniors()
    {
        $residents = Resident::where('age', '>=', 60)
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.seniors', compact('residents'));
    }
    public function men()
    {
        $men = Resident::where('sex', 'Male')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.men', compact('men'));
    }
    public function women()
    {
        $women = Resident::where('sex', 'Female')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.women', compact('women'));
    }
    public function womenchildren()
    {
        $womenchildren = Resident::where('sex', 'Female')
            ->orWhere('age', '<', 18)
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.womenchildren', compact('womenchildren'));
    }
    public function pregnant()
    {
        $pregnants = Resident::where('pregnant', 'Yes')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.pregnants', compact('pregnants'));
    }
    public function pwd()
    {
        $pwds = Resident::where('pwd', 'Yes')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'disability', 'age', 'updated_at']);

        return view('residents.pwds', compact('pwds'));
    }
    public function inschools()
    {
        $inschools = Resident::where('is_studying', 'Yes')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'education', 'updated_at']);

        return view('residents.inschools', compact('inschools'));
    }
    public function outofschools()
    {
        $residents = Resident::where('is_studying', 'No')
            ->where('age', '>=', 15)
            ->where('age', '<=', 25)
            ->where('education', 'High school undergraduate')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
        return view('residents.outofschools', compact('residents'));
    }
    public function employed()
    {
        $search = request()->query('search');
        $residents = Resident::where('is_employed', 'Yes')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'job_title', 'updated_at']);
        return view('residents.employed', compact('residents'));
    }
    public function unemployed()
    {
        $search = request()->query('search');
        $residents = Resident::where('is_employed', 'No')
            ->where('age', '>=', 18)
            ->where('education', 'Post secondary graduate')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);

        return view('residents.unemployed', compact('residents'));
    }
    public function filipinos()
    {
        $residents = Resident::where('nationality', 'Filipino')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'civil_status', 'updated_at']);

        return view('residents.filipinos', compact('residents'));
    }
    public function nonfil()
    {
        $search = request()->query('search');
        $residents = Resident::where('nationality', '!=', 'Filipino')
            ->with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'nationality', 'civil_status', 'updated_at']);

        return view('residents.nonfil', compact('residents'));
    }
    public function religion()
    {
        $search = request()->query('search');
        $residents = Resident::with('household')
            ->orderBy('household_id', 'asc')
            ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'religion', 'updated_at']);
        return view('residents.religion', compact('residents'));
    }
}

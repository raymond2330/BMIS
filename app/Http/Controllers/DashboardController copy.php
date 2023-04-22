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
    public function dashboard()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1 || Auth::user()->user_type == 2 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                //general household and resident information
                $street_count = Street::count();
                $household_count = Household::count();
                $resident_count = Resident::count();
                if ($resident_count == 0) {
                    $resident_count = 1;
                    $household_count = 1;
                }
                $average_resident_per_household = round(($resident_count / $household_count), 0);
                $voters = Resident::where('voter', 'Yes')->where('age', '>=', 18)->count();
                $bona_fide = Resident::where('bona_fide', 'Yes')->count();
                $families = Household::sum('number_family');
                $senior_citizens = Resident::where('age', '>=', 60)->count();

                //job chart
                $array_job = Resident::select('job_title as name', DB::raw('count(job_title) data'))->groupBy('job_title')->pluck('data');
                $array_job_categories = Resident::select('job_title as name')->groupBy('job_title')->pluck('name');
                //education chart
                $array_education = Resident::select('education as name', DB::raw('count(education) data'))->groupBy('education')->pluck('data');
                $array_education_categories = Resident::select('job_title as name')->groupBy('job_title')->pluck('name');
                



                // gender and age distribution
                $males = Resident::where('sex', 'Male')->count();
                $females = Resident::where('sex', 'Female')->count();
                $female_percentage = round(($females / $resident_count) * 100, 2);
                $male_percentage = round(($males / $resident_count) * 100, 2);
                $infants_male = Resident::where('age', '<', 1)->where('sex', 'Male')->count();
                $children_male = Resident::where('age', '>=', 1)->where('age', '<=', 17)->where('sex', 'Male')->count();
                $adults_male = Resident::where('age', '>=', 18)->where('age', '<=', 59)->where('sex', 'Male')->count();
                $elderly_male = Resident::where('age', '>=', 60)->where('sex', 'Male')->count();
                $infants_female = Resident::where('age', '<', 1)->where('sex', 'Female')->count();
                $children_female = Resident::where('age', '>=', 1)->where('age', '<=', 17)->where('sex', 'Female')->count();
                $adults_female = Resident::where('age', '>=', 18)->where('age', '<=', 59)->where('sex', 'Female')->count();
                $elderly_female = Resident::where('age', '>=', 60)->where('sex', 'Female')->count();
                $infants_percentage = round((($infants_male + $infants_female) / $resident_count) * 100, 1);
                $children_percentage = round((($children_male + $children_female) / $resident_count) * 100, 1);
                $adults_percentage = round((($adults_male + $adults_female) / $resident_count) * 100, 1);
                $elderly_percentage = round((($elderly_male + $elderly_female) / $resident_count) * 100, 1);
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

                $male_age_array = array(
                    $male_age_grp1  * -1, $male_age_grp2 * -1, $male_age_grp3 * -1, $male_age_grp4 * -1, $male_age_grp5 * -1, $male_age_grp6 * -1, $male_age_grp7 * -1
                );
                $female_age_array = array(
                    $female_age_grp1, $female_age_grp2, $female_age_grp3, $female_age_grp4, $female_age_grp5, $female_age_grp6, $female_age_grp7
                );




                $women_children = $infants_female + $infants_male + $children_male + $children_female + Resident::where('sex', 'Female')->where('age', '>=', 18)->count();
                $pregnants = Resident::where('pregnant', 'Yes')->count();
                $pwds = Resident::where('pwd', 'Yes')->count();
                //educational attainment
                $in_school = Resident::where('is_studying', 'Yes')->count();
                //income classes
                $employed = Resident::where('is_employed', 'Yes')->count();
                $unemployed = Resident::where('is_employed', 'No')->count();
                $average_income = round(Resident::average('income'), 2);
                // civil status
                $single = Resident::where('civil_status', 'Single')->count();
                $married = Resident::where('civil_status', 'Married')->count();
                $annulled = Resident::where('civil_status', 'Annulled')->count();
                $separated = Resident::where('civil_status', 'Separated')->count();
                $widowed = Resident::where('civil_status', 'Widowed')->count();
                $single_percentage = round(($single / $resident_count) * 100, 2);
                $married_percentage = round(($married / $resident_count) * 100, 2);
                $annulled_percentage = round(($annulled / $resident_count) * 100, 2);
                $separated_percentage = round(($separated / $resident_count) * 100, 2);
                $widowed_percentage = round(($widowed / $resident_count) * 100, 2);
                // nationality
                $filipinos = Resident::where('nationality', 'Filipino')->count();
                $non_filipinos = Resident::where('nationality', '!=', 'Filipino')->count();
                $filipinos_percentage = round(($filipinos / $resident_count) * 100, 2);
                $non_filipinos_percentage = round(($non_filipinos / $resident_count) * 100, 2);
                //charts and graphs
                $household_street_chart_options = [
                    'chart_title' => 'Household density per street',
                    'report_type' => 'group_by_relationship',
                    'relationship_name' => 'street',
                    'model' => 'App\Models\Household',
                    'group_by_field' => 'street',
                    'chart_type' => 'bar',
                    'chart_height' => '500',
                ];

                $waste_management_chart_options = [
                    'chart_title' => 'Waste Management',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Household',
                    'group_by_field' => 'waste_management',
                    'chart_type' => 'pie',
                    'chart_height' => '500',
                ];

                $toilet_chart_options = [
                    'chart_title' => 'Toilet Facility',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Household',
                    'group_by_field' => 'toilet',
                    'chart_type' => 'pie',
                    'chart_height' => '500',
                ];

                $dwelling_type_chart_options = [
                    'chart_title' => 'Dwelling Type',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Household',
                    'group_by_field' => 'dwelling_type',
                    'chart_type' => 'pie',
                    'chart_height' => '500',
                ];

                $ownership_chart_options = [
                    'chart_title' => 'Type of Ownership',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Household',
                    'group_by_field' => 'ownership',
                    'chart_type' => 'pie',
                    'chart_height' => '500',
                ];


                $gender_chart_options = [
                    'chart_title' => 'Gender Statistics',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'sex',
                    'chart_type' => 'pie',
                    'chart_height' => '300',

                ];

                $age_chart_options = [
                    'chart_title' => 'Age Statistics',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'age',
                    'chart_type' => 'line',
                    'chart_height' => '300',
                ];
                $education_chart_options = [
                    'chart_title' => 'Educational Attainment of Residents',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'education',
                    'chart_type' => 'bar',
                    'chart_height' => '350',

                ];
                $civil_status_chart_options = [
                    'chart_title' => 'Civil Status of Residents',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'civil_status',
                    'chart_type' => 'bar',

                ];
                $income_household_chart_options = [
                    'chart_title' => 'Income Classification by Households',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Household',
                    'group_by_field' => 'income_classification',
                    'chart_type' => 'pie',
                    'chart_height' => '3',

                ];
                $income_classification_chart_options = [
                    'chart_title' => 'Income Classification by Residents',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'income_classification',
                    'chart_type' => 'pie',
                    'chart_height' => '3',

                ];
                $job_classification_chart_options = [
                    'chart_title' => 'Job Classification',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'job_title',
                    'chart_type' => 'bar',
                ];
                $nationality_chart_options = [
                    'chart_title' => 'Nationality of residents',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'nationality',
                    'chart_type' => 'pie',
                ];

                $religion_chart_options = [
                    'chart_title' => 'Religion of Residents',
                    'report_type' => 'group_by_string',
                    'model' => 'App\Models\Resident',
                    'group_by_field' => 'religion',
                    'chart_type' => 'pie',
                ];

                $form_chart_options = [
                    'chart_title' => 'Forms requested by months',
                    'report_type' => 'group_by_date',
                    'model' => 'App\Models\Certificate',
                    'group_by_field' => 'created_at',
                    'group_by_period' => 'month',
                    'chart_type' => 'bar',
                ];
                $household_street_chart = new LaravelChart($household_street_chart_options);
                $waste_management_chart = new LaravelChart($waste_management_chart_options);
                $toilet_chart = new LaravelChart($toilet_chart_options);
                $dwelling_chart = new LaravelChart($dwelling_type_chart_options);
                $ownership_chart = new LaravelChart($ownership_chart_options);



                $gender_chart = new LaravelChart($gender_chart_options);
                $age_chart = new LaravelChart($age_chart_options);
                $education_chart = new LaravelChart($education_chart_options);
                $income_household_chart = new LaravelChart($income_household_chart_options);
                $income_classification_chart = new LaravelChart($income_classification_chart_options);
                $job_classification_chart = new LaravelChart($job_classification_chart_options);
                $civil_status_chart = new LaravelChart($civil_status_chart_options);
                $nationality_chart = new LaravelChart($nationality_chart_options);
                $form_chart = new LaravelChart($form_chart_options);
                $religion_chart = new LaravelChart($religion_chart_options);



                return view('barangay-385.dashboard', compact(
                    'street_count',
                    'resident_count',
                    'bona_fide',
                    'families',
                    'voters',
                    'senior_citizens',
                    'male_percentage',
                    'female_percentage',
                    'infants_male',
                    'children_male',
                    'adults_male',
                    'elderly_male',
                    'infants_female',
                    'children_female',
                    'adults_female',
                    'elderly_female',
                    'infants_percentage',
                    'children_percentage',
                    'adults_percentage',
                    'elderly_percentage',
                    'male_age_array',
                    'female_age_array',
                    'women_children',
                    'pwds',
                    'pregnants',
                    'single',
                    'married',
                    'annulled',
                    'separated',
                    'widowed',
                    'single_percentage',
                    'married_percentage',
                    'annulled_percentage',
                    'separated_percentage',
                    'widowed_percentage',
                    'in_school',
                    'employed',
                    'unemployed',
                    'average_income',
                    'array_job',
                    'array_job_categories',



                    'filipinos',
                    'non_filipinos',
                    'filipinos_percentage',
                    'non_filipinos_percentage',
                    'average_resident_per_household',
                    'household_count',
                    'household_street_chart',
                    'waste_management_chart',
                    'toilet_chart',
                    'dwelling_chart',
                    'ownership_chart',
                    'gender_chart',
                    'age_chart',
                    'education_chart',
                    'civil_status_chart',
                    'income_household_chart',
                    'income_classification_chart',
                    'job_classification_chart',
                    'nationality_chart',
                    'religion_chart',
                    'form_chart'
                ));
            } else {
                return redirect('login');
            }
        } else {
            return redirect('/');
        }

        //data 
    }
    
    public function backup()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                Artisan::call('backup:run');
                return redirect('/dashboard')->with('backup', '');
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function bonafide()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $bonafides = Resident::where('bona_fide', 'Yes')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
                return view('residents.bonafide', compact('bonafides'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function voters()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $voters = Resident::where('voter', 'Yes')
                    ->where('age', '>=', 18)
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
                return view('residents.voters', compact('voters'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function seniors()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $residents = Resident::where('age', '>=', 60)
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
                return view('residents.seniors', compact('residents'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function men()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $men = Resident::where('sex', 'Male')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
                return view('residents.men', compact('men'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function women()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $women = Resident::where('sex', 'Female')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
                return view('residents.women', compact('women'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function womenchildren()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {

                $womenchildren = Resident::where('sex', 'Female')
                    ->orWhere('age', '<', 18)
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);
                return view('residents.womenchildren', compact('womenchildren'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function pregnant()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {

                $pregnants = Resident::where('pregnant', 'Yes')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);

                return view('residents.pregnants', compact('pregnants'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function pwd()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {

                $pwds = Resident::where('pwd', 'Yes')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'disability', 'age', 'updated_at']);

                return view('residents.pwds', compact('pwds'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function inschools()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {


                $inschools = Resident::where('is_studying', 'Yes')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'education', 'updated_at']);

                return view('residents.inschools', compact('inschools'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function employed()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $search = request()->query('search');

                $residents = Resident::where('is_employed', 'Yes')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'job_title', 'updated_at']);


                return view('residents.employed', compact('residents'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function unemployed()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $search = request()->query('search');

                $residents = Resident::where('is_employed', 'No')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'updated_at']);

                return view('residents.unemployed', compact('residents'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function filipinos()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {

                $residents = Resident::where('nationality', 'Filipino')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'civil_status', 'updated_at']);

                return view('residents.filipinos', compact('residents'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function nonfil()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $search = request()->query('search');

                $residents = Resident::where('nationality', '!=', 'Filipino')
                    ->with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'nationality', 'civil_status', 'updated_at']);

                return view('residents.nonfil', compact('residents'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }
    public function religion()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $search = request()->query('search');

                $residents = Resident::with('household')
                    ->orderBy('household_id', 'asc')
                    ->get(['household_id', 'id', 'given_name', 'surname', 'sex', 'age', 'religion', 'updated_at']);
                return view('residents.religion', compact('residents'));
            } else {
                return back()->with('unauthorized', "");
            }
        } else {
            return redirect('/');
        }
    }

    public function test()
    {
        $array_job = Resident::select('job_title as name', DB::raw('count(job_title) data'))->groupBy('job_title')->pluck('data');
        // dd(json_encode($array_job));


        return view('tests.highcharts', compact('array_job'));
    }
}






// if (Auth::id()) {
//     if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
        
//     } else {
//         return redirect('login');
//     }
// } else {
//     return redirect('login');
// }

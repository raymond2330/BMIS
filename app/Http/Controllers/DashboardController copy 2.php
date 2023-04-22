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
                $household_count = Household::count();
                $resident_count = Resident::count();
                if ($resident_count == 0 || $household_count == 0) {
                    $resident_count = 1;
                    $household_count = 1;
                }
                $families = Household::sum('number_family');
                $bona_fide = Resident::where('bona_fide', 'Yes')->count();
                $voters = Resident::where('voter', 'Yes')->where('age', '>=', 18)->count();
                $senior_citizens = Resident::where('age', '>=', 60)->count();
                $street_names = Street::select('street as name')->pluck('name');
                $household_per_street = Street::select('household_count as data')->pluck('data');
                //waste management
                $composting =  round((Household::where('waste_management', 'Composting')->count() / $household_count) * 100, 1);
                $incineration =  round((Household::where('waste_management', 'Incineration')->count() / $household_count) * 100, 1);
                $recycled =  round((Household::where('waste_management', 'Recycled')->count() / $household_count) * 100, 1);
                $waste_others =  round((Household::where('waste_management', 'Others')->count() / $household_count) * 100, 1);
                //toilet facility
                $pail =  round((Household::where('toilet', 'Pail type')->count() / $household_count) * 100, 1);
                $flushed =  round((Household::where('toilet', 'Water-sealed/Flushed')->count() / $household_count) * 100, 1);
                $toilet_others =  round((Household::where('toilet', 'Others')->count() / $household_count) * 100, 1);
                $no_toilet =  round((Household::where('toilet', 'No toilet facility')->count() / $household_count) * 100, 1);
                //dwelling type
                $concrete =  round((Household::where('dwelling_type', 'Rented')->count() / $household_count) * 100, 1);
                $logwood =  round((Household::where('dwelling_type', 'Log/Wood')->count() / $household_count) * 100, 1);
                $semiconcrete =  round((Household::where('dwelling_type', 'Semi-concrete')->count() / $household_count) * 100, 1);
                $dwelling_others =  round((Household::where('dwelling_type', 'Others')->count() / $household_count) * 100, 1);
                //ownership type
                $rented =  round((Household::where('ownership', 'Rented')->count() / $household_count) * 100, 1);
                $owned =  round((Household::where('ownership', 'Owned')->count() / $household_count) * 100, 1);
                $sharedowner =  round((Household::where('ownership', 'Shared with owner')->count() / $household_count) * 100, 1);
                $sharedrenter =  round((Household::where('ownership', 'Shared with renter')->count() / $household_count) * 100, 1);
                $informalsettler =  round((Household::where('ownership', 'Informal settler')->count() / $household_count) * 100, 1);



                //job chart
                $array_job_categories = Resident::select('job_title as name')->groupBy('job_title')->pluck('name');
                $array_job = Resident::select('job_title as name', DB::raw('count(job_title) data'))->groupBy('job_title')->pluck('data');
                //education chart
                $array_education = Resident::select('education as name', DB::raw('count(education) data'))->groupBy('education')->pluck('data');
                $array_education_categories = Resident::select('education as name')->groupBy('education')->pluck('name');

                //income residents chart
                $resident_poor = round((Resident::where('income_classification', 'Poor')->count() / $resident_count) * 100, 1);
                $resident_low_income = round((Resident::where('income_classification', 'Low income')->count() / $resident_count) * 100, 1);
                $resident_lower_middle = round((Resident::where('income_classification', 'Lower middle class')->count() / $resident_count) * 100, 1);
                $resident_middle = round((Resident::where('income_classification', 'Middle class')->count() / $resident_count) * 100, 1);
                $resident_upper_middle = round((Resident::where('income_classification', 'Upper middle class')->count() / $resident_count) * 100, 1);
                $resident_rich = round((Resident::where('income_classification', 'Rich')->count() / $resident_count) * 100, 1);
                $resident_high_income = round((Resident::where('income_classification', 'High income')->count() / $resident_count) * 100, 1);
                //income households chart
                $household_poor = round((Household::where('income_classification', 'Poor')->count() / $resident_count) * 100, 1);
                $household_low_income = round((Household::where('income_classification', 'Low income')->count() / $resident_count) * 100, 1);
                $household_lower_middle = round((Household::where('income_classification', 'Lower middle class')->count() / $resident_count) * 100, 1);
                $household_middle = round((Household::where('income_classification', 'Middle class')->count() / $resident_count) * 100, 1);
                $household_upper_middle = round((Household::where('income_classification', 'Upper middle class')->count() / $resident_count) * 100, 1);
                $household_rich = round((Household::where('income_classification', 'Rich')->count() / $resident_count) * 100, 1);
                $household_high_income = round((Household::where('income_classification', 'High income')->count() / $resident_count) * 100, 1);
                //civil_status
                $civil_status_labels = Resident::select('civil_status as name')->groupBy('civil_status')->pluck('name');
                $civil_status = Resident::select('civil_status as name', DB::raw('count(civil_status) data'))->groupBy('civil_status')->pluck('data');


                $household_incomes = Household::select('income_classification as name', DB::raw('count(income_classification) data'))->groupBy('income_classification')->get();
                $catholic_percentage = round((Resident::where('religion', 'Catholic')->count() / $resident_count) * 100, 1);
                $inc_percentage = round((Resident::where('religion', 'INC')->count() / $resident_count) * 100, 1);
                $other_religion_percentage = round((Resident::where('religion', 'Others')->count() / $resident_count) * 100, 1);



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


                $form_chart_options = [
                    'chart_title' => 'Forms requested by months',
                    'report_type' => 'group_by_date',
                    'model' => 'App\Models\Certificate',
                    'group_by_field' => 'created_at',
                    'group_by_period' => 'month',
                    'chart_type' => 'bar',
                ];
                $form_chart = new LaravelChart($form_chart_options);



                return view('barangay-385.dashboard', compact(
                    'resident_count',
                    'bona_fide',
                    'families',
                    'voters',
                    'street_names',
                    'household_per_street',
                    'senior_citizens',
                    'males',
                    'females',
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
                    'civil_status_labels',
                    'civil_status',
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
                    'array_education',
                    'array_education_categories',
                    'employed',
                    'unemployed',
                    'average_income',

                    'resident_poor',
                    'resident_low_income',
                    'resident_lower_middle',
                    'resident_middle',
                    'resident_upper_middle',
                    'resident_high_income',
                    'resident_rich',

                    'household_poor',
                    'household_low_income',
                    'household_lower_middle',
                    'household_middle',
                    'household_upper_middle',
                    'household_high_income',
                    'household_rich',


                    'array_job',
                    'array_job_categories',
                    'catholic_percentage',
                    'inc_percentage',
                    'other_religion_percentage',


                    'filipinos',
                    'non_filipinos',
                    'filipinos_percentage',
                    'non_filipinos_percentage',
                    'household_count',


                    'composting',
                    'incineration',
                    'recycled',
                    'waste_others',

                    'pail',
                    'flushed',
                    'toilet_others',
                    'no_toilet',

                    'concrete',
                    'logwood',
                    'semiconcrete',
                    'dwelling_others',

                    'rented',
                    'owned',
                    'sharedowner',
                    'sharedrenter',
                    'informalsettler',

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
                set_time_limit(360);
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
        $incomes = Resident::select('income_classification as name', DB::raw('count(income_classification) data'))->groupBy('income_classification')->get();




        return view('tests.highcharts', compact('incomes'));
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

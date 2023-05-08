<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidentStoreRequest;
use App\Http\Requests\ResidentUpdateRequest;
use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Street;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ResidentExport;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ResidentController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {

                $residents = cache()->remember('residents.index', 1, function () {
                    return $residents = Resident::orderBy('household_id', 'asc')
                        ->with('household')
                        ->get(['household_id', 'id', 'given_name', 'surname', 'age', 'sex', 'household_head', 'is_employed', 'is_studying', 'bona_fide', 'resident_six_months', 'solo_parent', 'voter', 'pwd', 'contact', 'updated_at']);
                });
                return view('residents.index', compact('residents'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function simplified()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $search = request()->query('search');
                if ($search) {
                    $residents = Resident::with('household')
                        ->where('surname', 'LIKE', "%{$search}%")
                        ->orWhere('given_name', 'LIKE', "%{$search}%")
                        ->orWhere('middle_name', 'LIKE', "%{$search}%")
                        ->orWhere('age', 'LIKE', "%{$search}%")
                        ->orWhere('sex', 'LIKE', "%{$search}%")
                        ->orWhere('birth_date', 'LIKE', "%{$search}%")
                        ->orWhere('education', 'LIKE', "%{$search}%")
                        ->orWhere('income_classification', 'LIKE', "%{$search}%")
                        ->orWhere('job_title', 'LIKE', "%{$search}%")
                        ->orWhere('household_id', 'LIKE', "%{$search}%")
                        ->orderBy('household_id', 'asc')
                        ->paginate(25);
                } else {
                    $residents = Resident::with('household')->paginate(25);
                }
                return view('residents.simplified', compact('residents'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function create($id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $household = Household::find($id);
                return view('residents.create', compact('household'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function store(ResidentStoreRequest $request)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                //household id and income
                $household = Household::find(Crypt::decryptString($request->household_id));
                $household_income = $household->income;
                //resident object
                $resident = new Resident();
                $resident->surname = $request->surname;
                $resident->given_name = $request->given_name;
                $resident->middle_name = $request->middle_name;
                $resident->birth_date = $request->birth_date;
                $resident->age = Carbon::parse($request->birth_date)->age;
                $resident->sex = $request->sex;
                $resident->pregnant = $request->pregnant;
                $resident->religion = $request->religion;
                $resident->civil_status = $request->civil_status;
                $resident->nationality = $request->nationality;
                $resident->contact = $request->contact;
                $household_head = $request->household_head;
                $resident->household_head = $household_head;
                $resident->bona_fide = $request->bona_fide;
                $resident->resident_six_months = $request->resident_six_months;
                $resident->solo_parent = $request->solo_parent;
                $resident->voter = $request->voter;
                $resident->pwd = $request->pwd;
                $resident->disability = $request->disability;
                $resident->is_studying = $request->is_studying;
                $resident->education = $request->education;
                $resident->institution = $request->institution;
                $resident->graduate_year = $request->graduate_year;
                $resident->specialization = $request->specialization;
                $resident->is_employed = $request->is_employed;
                $resident->job_title = $request->job_title;
                $resident_income = $request->income;
                $resident->income = $resident_income;
                $resident->income_classification = IncomeController::store_resident_income($resident_income);
                //increment household size, income, and identify the new income classification
                $household->increment('income', $resident_income);
                $household->increment('household_size', 1);
                if ($household_head == "Yes") {
                    $household->increment('number_family', 1);
                }
                DB::table('households')->where('id', $household->id)->update(
                    ['income_classification' => IncomeController::total_household_income($household_income, $resident_income)]
                );
                // save resident and household data
                $household->residents()->save($resident);
                return back()->with('success', "");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function view($id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $resident = Resident::find($id);
                return view('residents.view', compact('resident'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function edit(Request $request, $id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $resident = Resident::find($id);
                return view('residents.edit', compact('resident'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function update(ResidentUpdateRequest $request, $id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $household = Household::find(Crypt::decryptString($request->household_id));
                $household_income = $household->income;
                $resident = Resident::find($id);
                $resident->surname = $request->surname;
                $resident->given_name = $request->given_name;
                $resident->middle_name = $request->middle_name;
                $resident->birth_date = $request->birth_date;
                $resident->age = Carbon::parse($request->birth_date)->age;
                $resident->sex = $request->sex;
                $resident->pregnant = $request->pregnant;
                $resident->religion = $request->religion;
                $resident->civil_status = $request->civil_status;
                $resident->nationality = $request->nationality;
                $resident->contact = $request->contact;
                $household_head = $request->household_head;
                $resident->household_head = $household_head;
                $resident->bona_fide = $request->bona_fide;
                $resident->resident_six_months = $request->resident_six_months;
                $resident->solo_parent = $request->solo_parent;
                $resident->voter = $request->voter;
                $resident->pwd = $request->pwd;
                $resident->disability = $request->disability;
                $resident->is_studying = $request->is_studying;
                $resident->education = $request->education;
                $resident->institution = $request->institution;
                $resident->graduate_year = $request->graduate_year;
                $resident->specialization = $request->specialization;
                $resident->is_employed = $request->is_employed;
                $resident->job_title = $request->job_title;
                //income, income range, income classification
                $resident_income = $request->income;
                $resident->income = $resident_income;
                $resident->income_classification = IncomeController::store_resident_income($resident_income);

                $old_income = Crypt::decryptString($request->old_income);
                //deduct resident income from household income
                $new_household_income = $household_income - $old_income;
                //get resident new income
                $new_income = $request->income;
                //update household income by adding the household income to resident new income
                DB::table('households')->where('id', $household->id)->update([
                    'income' => $new_household_income +  $new_income,
                ]);
                //declare household income again to fetch latest income

                if ($household_head == "Yes" && $resident->isDirty('household_head')) {
                    $household->increment('number_family', 1);
                }
                if ($household_head == "No" && $resident->isDirty('household_head')) {
                    $household->decrement('number_family', 1);
                }
                $household->refresh();
                $household_income = $household->income;
                DB::table('households')->where('id', $household->id)->update([
                    'income_classification' => IncomeController::update_resident_household_income($household_income)
                ]);
                $household->residents()->save($resident);
                return back()->with('success', "");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function archive($id)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $resident = Resident::find($id);
                $household = Household::find($resident->household_id);
                $household->decrement('household_size', 1);
                $household->decrement('income', $resident->income);
                if ($resident->household_head == "Yes") {
                    $household->decrement('number_family', 1);
                }
                $household->refresh();
                $household_income = $household->income;
                DB::table('households')->where('id', $household->id)->update([
                    'income_classification' => IncomeController::update_resident_household_income($household_income)
                ]);
                $resident->delete();
                return back()->with('archived', '');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function archive_index()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $residents = Resident::with('household')->onlyTrashed()->orderBy('household_id', 'asc')->get();
                return view('residents.archives', compact('residents'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function restore($id)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                $resident = Resident::onlyTrashed()->find($id);
                $household = Household::find($resident->household_id);
                $household->increment('household_size', 1);
                $household->increment('income', $resident->income);
                if ($resident->household_head == "Yes") {
                    $household->increment('number_family', 1);
                }
                $household->refresh();
                $household_income = $household->income;
                DB::table('households')->where('id', $household->id)->update([
                    'income_classification' => IncomeController::update_resident_household_income($household_income)
                ]);
                $resident->restore();
                return back()->with('restored', '');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function destroy(Request $request, $id)
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {

                $request->validate([
                    'password' => 'required|current_password'
                ]);
                if ($request) {
                    $resident = Resident::onlyTrashed()->find($id);
                    $resident->forceDelete();
                    return back()->with('deleted', '');
                }
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function export()
    {
        if (Auth::id()) {
            if (Auth::user()->user_type == 0 && Auth::user()->email_verified_at != NULL) {
                set_time_limit(360);
                return Excel::download(new ResidentExport, now() . '-residents of 385.csv');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('login');
        }
    }
}

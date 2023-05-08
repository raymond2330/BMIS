<?php

namespace App\Http\Controllers;

use App\Http\Requests\HouseholdStoreRequest;
use App\Http\Controllers\IncomeController;
use App\Http\Requests\HouseholdUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Household;
use App\Models\Resident;
use App\Models\Street;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\HouseholdExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;


class HouseholdController extends Controller
{


    public function list()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $households = Household::with('street')->get();
                return view('households.list', compact('households'));
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
                $street = Street::find($id);
                return view('households.create', compact('street', 'id'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function store(HouseholdStoreRequest $request)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $street = Street::find(Crypt::decryptString($request->street_id));
                $household = new Household();
                $household->edifice_number = $request->edifice_number;
                $household->postal_code = "1001";
                $household->city = "Quiapo, Manila";
                $household->household_size = 0;
                // $household->income = 0;
                $household->income = ($request->income == "") ? 0 : $request->income;
                $household->income_classification = ($request->income_classification == "") ? "Poor" : $request->income_classification;
                $household->waste_management = $request->waste_management;
                $household->toilet = $request->toilet;
                $household->dwelling_type = $request->dwelling_type;
                $household->ownership = $request->ownership;
                $street->increment('household_count', 1);
                $street->households()->save($household);
                return back()->with('success', "");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $household = Household::find($id);
                return view('households.edit', compact('household'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function update(HouseholdUpdateRequest $request, $id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                $street = Street::find(Crypt::decryptString($request->street_id));
                $household =  Household::find($id);
                $household->edifice_number = $request->edifice_number;
                $household->postal_code = "1001";
                $household->city = "Quiapo, Manila";
                $household->waste_management = $request->waste_management;
                $household->toilet = $request->toilet;
                $household->dwelling_type = $request->dwelling_type;
                $household->ownership = $request->ownership;
                $street->households()->save($household);
                return back()->with('success', "");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function residents($id)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 1) && Auth::user()->email_verified_at != NULL) {
                // $residents = Household::find($id)->residents()->orderBy('age')->get();
                // $street = Household::find($id);
                $residents = Household::find($id)->residents()->orderBy('age')->get();
                $household = Household::find($id);
                return view('households.residents', compact('residents', 'household'));
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
                return Excel::download(new HouseholdExport, now() . '-households of 385.csv');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('login');
        }
    }
}

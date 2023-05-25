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
    public function __construct()
    {
        $this->middleware('isProfiling');
    }

    public function list()
    {
        $households = Household::with('street')->get();
        return view('households.list', compact('households'));
    }
    public function create($id)
    {
        $street = Street::find($id);
        return view('households.create', compact('street', 'id'));
    }
    public function store(HouseholdStoreRequest $request)
    {
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
    }

    public function edit($id)
    {
        $household = Household::find($id);
        return view('households.edit', compact('household'));
    }
    public function update(HouseholdUpdateRequest $request, $id)
    {
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
    }
    public function residents($id)
    {
        // $residents = Household::find($id)->residents()->orderBy('age')->get();
        // $street = Household::find($id);
        $residents = Household::find($id)->residents()->orderBy('age')->get();
        $household = Household::find($id);
        return view('households.residents', compact('residents', 'household'));
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

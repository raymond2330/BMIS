<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Resident;
use App\Models\Certificate;
use \PDF;
// use Barryvdh\DomPDF\PDF;


class CertificateController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                $forms = Certificate::all();
                return view('clearances.index', compact('forms'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function forms()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                return view('clearances.forms');
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function indigency()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                $residents = Resident::where('resident_six_months', 'Yes')->with('household')->get();
                return view('clearances.indigency', compact('residents'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function certification()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                $residents = Resident::where('bona_fide', 'Yes')->with('household')->get();
                return view('clearances.certification', compact('residents'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function legal_guardian()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                $residents = Resident::where('resident_six_months', 'Yes')->with('household')->get();
                return view('clearances.legal-guardian', compact('residents'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function goodmoral()
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                $residents = Resident::where('resident_six_months', 'Yes')->with('household')->get();
                return view('clearances.goodmoral', compact('residents'));
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function indigencyPDF(Request $request)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {
                $request->validate([
                    'resident_id' => 'exists:residents,id',
                    'punong_barangay' => 'required|max:255'
                ]);

                $resident = Resident::find($request->resident_id);
                $punong_barangay = $request->punong_barangay;
                $certificate = new Certificate();
                $certificate->form = "Indigency";
                $certificate->requester = $resident->given_name . " " . $resident->surname;
                $certificate->save();
                $pdf = PDF::loadView('pdf.indigency-pdf', compact('resident', 'punong_barangay'));
                return $pdf->download($resident->surname . " Indigency.pdf");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function certificationPDF(Request $request)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {

                $request->validate([
                    'resident_id' => 'exists:residents,id',
                    'punong_barangay' => 'required|max:255'
                ]);
                $resident = Resident::find($request->resident_id);
                $punong_barangay = $request->punong_barangay;

                $certificate = new Certificate();
                $certificate->form = "Certification";
                $certificate->requester = $resident->given_name . " " . $resident->surname;
                $certificate->save();

                $pdf = PDF::loadView('pdf.certification-pdf', compact('resident', 'punong_barangay'));
                return $pdf->download($resident->surname . " Certification.pdf");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function legalGuardianPDF(Request $request)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {

                $request->validate([
                    'guardian_id' => 'exists:residents,id',
                    'ward_id' => 'exists:residents,id',
                    'type' => 'required|in:mother,father,legal guardian',
                    'punong_barangay' => 'required|max:255'

                ]);
                $guardian = Resident::find($request->guardian_id);
                $ward = Resident::find($request->ward_id);
                $type = $request->type;
                $punong_barangay = $request->punong_barangay;

                $certificate = new Certificate();
                $certificate->form = "Legal Guardian";
                $certificate->requester = $guardian->given_name . " " . $guardian->surname;
                $certificate->save();

                $pdf = PDF::loadView('pdf.legal-guardian-pdf', compact('guardian', 'ward', 'type', 'punong_barangay'));
                return $pdf->download($ward->surname . " Legal Guardian.pdf");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
    }
    public function goodMoralPDF(Request $request)
    {
        if (Auth::id()) {
            if ((Auth::user()->user_type == 0 || Auth::user()->user_type == 3) && Auth::user()->email_verified_at != NULL) {

                $request->validate([
                    'resident_id' => 'exists:residents,id',
                    'purpose' => 'required|max:255',
                    'punong_barangay' => 'required|max:255'

                ]);
                $resident = Resident::find($request->resident_id);
                $purpose = $request->purpose;
                $punong_barangay = $request->punong_barangay;

                $certificate = new Certificate();
                $certificate->form = "Good Moral";
                $certificate->requester = $resident->given_name . " " . $resident->surname;
                $certificate->save();

                $pdf = PDF::loadView('pdf.goodmoral-pdf', compact('resident', 'purpose', 'punong_barangay'));
                return $pdf->download($resident->surname . " Good Moral.pdf");
            } else {
                return redirect('/welcome-user');
            }
        } else {
            return redirect('/');
        }
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

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
    public function __construct()
    {
        $this->middleware('isCertificate');
    }
    public function index()
    {
        $forms = Certificate::all();
        return view('clearances.index', compact('forms'));
    }
    public function forms()
    {
        return view('clearances.forms');
    }
    public function indigency()
    {
        $residents = Resident::where('resident_six_months', 'Yes')->with('household')->get();
        return view('clearances.indigency', compact('residents'));
    }
    public function certification()
    {
        $residents = Resident::where('bona_fide', 'Yes')->with('household')->get();
        return view('clearances.certification', compact('residents'));
    }
    public function legal_guardian()
    {
        $residents = Resident::where('resident_six_months', 'Yes')->with('household')->get();
        return view('clearances.legal-guardian', compact('residents'));
    }
    public function goodmoral()
    {
        $residents = Resident::where('resident_six_months', 'Yes')->with('household')->get();
        return view('clearances.goodmoral', compact('residents'));
    }
    public function indigencyPDF(Request $request)
    {
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
    }
    public function certificationPDF(Request $request)
    {
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
    }
    public function legalGuardianPDF(Request $request)
    {
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
    }
    public function goodMoralPDF(Request $request)
    {
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
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Street;
use Illuminate\Support\Facades\DB;



class StreetController extends Controller
{
    public function __construct()
    {
        $this->middleware('isProfiling');
    }
    public function index()
    {
        $streets = DB::table('streets')->orderBy('street', 'asc')->paginate('12');
        return view('streets.index', compact('streets'));
    }
    public function households($id)
    {
        $search = request()->query('search');
        if ($search) {
            $households = Street::find($id)->households()
                ->where('edifice_number', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%")
                ->orderBy('edifice_number', 'asc')
                ->paginate(20);
        } else {
            $households = Street::find($id)->households()->orderBy('edifice_number')->paginate(20);
        }
        return view('streets.households', compact('households', 'id'));
    }
    public static function street_name($id)
    {
        $street_name = "";
        switch ($id) {
            case 1:
                $street_name = "Arlegui";
                break;
            case 2:
                $street_name = "Duque de Alba";
                break;
            case 3:
                $street_name = "Castillejos";
                break;
            case 4:
                $street_name = "Vergara";
                break;
            case 5:
                $street_name = "Fraternal";
                break;
            case 6:
                $street_name = "P. Casal";
                break;
            case 7:
                $street_name = "Pax";
                break;
            case 8:
                $street_name = "Farnecio";
                break;
            default:
                $street_name = "Error";
        }
        return $street_name;
    }
}

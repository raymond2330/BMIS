<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'surname' => 'required|max:100',
            'given_name' => 'required|max:100',
            'middle_name' => '',
            'birth_date' => 'required',
            // 'age' => 'required|numeric|min:0|max:120',
            'sex' => 'in:Male,Female',
            'pregnant' => '',
            'religion' => 'required|in:Catholic,INC,Others',
            'civil_status' => 'required|in:Single,Married,Annulled,Separated,Widowed',
            'nationality' => 'required|max:50',
            'contact' => '',
            'household_head' => 'required|in:Yes,No',
            'bona_fide' => 'required|in:Yes,No',
            'resident_six_months' => 'required|in:Yes,No',
            'solo_parent' => 'required|in:Yes,No',
            'voter' => 'required|in:Yes,No',
            'pwd' => 'required|in:Yes,No',
            'disability' => '',
            'is_studying' => 'required|in:Yes,No',
            'education' => 'in:No grade completed,Elementary undergraduate,Elementary graduate,High school undergraduate,High school graduate,Post secondary undergraduate,Post secondary graduate,College undergraduate,College graduate,Post baccalaureate',
            'institution' => '',
            'graduate_year' => '',
            'specialization' => '',
            'income' => 'numeric|min:0|max:999999|required',
            'is_employed' => 'required|in:Yes,No',
            // 'job_title' => 'nullable|in:Managers,Professionals,Technicians and associate professionals,Clerical support workers,Service and sales workers,Skilled agricultural forestry and fishery workers,Craft and related trades workers,Plant and machine operators and assemblers,Elementary occupations,Armed forces occupations',
            'job_title' => 'nullable|in:Manual Laborer,Doctor/Lawyer/Professionals,Government employee,Private employee,Pro-driver,Non pro-driver,Househelper,Lending,Vendor/Sales worker,Skilled agricultural forestry and fishery workers,Others',
        ];
    }
}

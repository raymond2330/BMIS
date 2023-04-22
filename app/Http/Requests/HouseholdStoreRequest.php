<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseholdStoreRequest extends FormRequest
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
            'edifice_number' => 'required|max:50',
            'waste_management' => 'required|in:Incineration,Composting,Recycled,Others',
            'toilet' => 'required|in:Pail type,Water-sealed/Flushed,Others,No toilet facility',
            'dwelling_type' => 'required|in:Concrete,Semi-concrete,Log/Wood,Others',
            'ownership' => 'required|in:Rented,Owned,Shared with owner,Shared with renter,Informal settler'
        ];
    }
}

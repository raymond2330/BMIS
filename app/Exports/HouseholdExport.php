<?php

namespace App\Exports;

use App\Models\Household;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class HouseholdExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Household::select(
            "id",
            "street_id",
            "edifice_number",
            "postal_code",
            "city",
            "household_size",
            "number_family",
            "income",
            "income_classification",
            "waste_management",
            "toilet",
            "dwelling_type",
            "ownership",
            "created_at",
            "updated_at"
        )->get();
    }
    public function headings(): array
    {
        return [
            "id",
            "street_id",
            "edifice_number",
            "postal_code",
            "city",
            "household_size",
            "number_family",
            "income",
            "income_classification",
            "waste_management",
            "toilet",
            "dwelling_type",
            "ownership",
            "created_at",
            "updated_at"
        ];
    }
}

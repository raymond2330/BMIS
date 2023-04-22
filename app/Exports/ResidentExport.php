<?php

namespace App\Exports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResidentExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Resident::select(
            "id",
            "household_id",
            "surname",
            "given_name",
            "middle_name",
            "birth_date",
            "age",
            "sex",
            "pregnant",
            "religion",
            "civil_status",
            "nationality",
            "contact",
            "household_head",
            "bona_fide",
            "resident_six_months",
            "solo_parent",
            "voter",
            "pwd",
            "disability",
            "is_studying",
            "education",
            "institution",
            "graduate_year",
            "specialization",
            "income",
            "income_classification",
            "is_employed",
            "job_title",
            "created_at",
            "updated_at",
            "deleted_at"
        )->get();
    }
    public function headings(): array
    {
        return [
            "id",
            "household_id",
            "surname",
            "given_name",
            "middle_name",
            "birth_date",
            "age",
            "sex",
            "pregnant",
            "religion",
            "civil_status",
            "nationality",
            "contact",
            "household_head",
            "bona_fide",
            "resident_six_months",
            "solo_parent",
            "voter",
            "pwd",
            "disability",
            "is_studying",
            "education",
            "institution",
            "graduate_year",
            "specialization",
            "income",
            "income_classification",
            "is_employed",
            "job_title",
            "created_at",
            "updated_at",
            "deleted_at"
        ];
    }
}

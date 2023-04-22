<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public static function store_household_income($income)
    {
        if ($income <= 10957) {
            $income_classification = "Poor";
        } elseif ($income > 10957 && $income <= 21194) {
            $income_classification = "Low income";
        } elseif ($income > 21194 && $income <= 43828) {
            $income_classification = "Lower middle class";
        } elseif ($income > 43828 && $income <= 76669) {
            $income_classification = "Middle class";
        } elseif ($income > 76670 && $income <= 131484) {
            $income_classification = "Upper middle class";
        } elseif ($income > 131484 && $income <= 219140) {
            $income_classification = "High income";
        } elseif ($income > 219140) {
            $income_classification = "Rich";
        } else {
            $income_classification = "No data";
        }
        return $income_classification;
    }
    public static function store_resident_income($resident_income)
    {
        if ($resident_income <= 10957) {
            $income_classification = "Poor";
        } elseif ($resident_income > 10957 && $resident_income <= 21194) {
            $income_classification = "Low income";
        } elseif ($resident_income > 21194 && $resident_income <= 43828) {
            $income_classification = "Lower middle class";
        } elseif ($resident_income > 43828 && $resident_income <= 76669) {
            $income_classification = "Middle class";
        } elseif ($resident_income > 76670 && $resident_income <= 131484) {
            $income_classification = "Upper middle class";
        } elseif ($resident_income > 131484 && $resident_income <= 219140) {
            $income_classification = "High income";
        } elseif ($resident_income > 219140) {
            $income_classification = "Rich";
        } else {
            $income_classification = "No data";
        }
        return $income_classification;
    }
    public static function total_household_income($household_income, $resident_income)
    {
        if ($household_income + $resident_income <= 10957) {
            $household_income_classification = "Poor";
        } elseif ($household_income + $resident_income > 10957 && $household_income + $resident_income <= 21194) {
            $household_income_classification = "Low income";
        } elseif ($household_income + $resident_income > 21194 && $household_income + $resident_income <= 43828) {
            $household_income_classification = "Lower middle class";
        } elseif ($household_income + $resident_income > 43828 && $household_income + $resident_income <= 76669) {
            $household_income_classification = "Middle class";
        } elseif ($household_income + $resident_income > 76670 && $household_income + $resident_income <= 131484) {
            $household_income_classification = "Upper middle class";
        } elseif ($household_income + $resident_income > 131484 && $household_income + $resident_income <= 219140) {
            $household_income_classification = "High income";
        } elseif ($household_income + $resident_income > 219140) {
            $household_income_classification = "Rich";
        } else {
            $household_income_classification = "No data";
        }
        return $household_income_classification;
    }
    public static function update_resident_household_income($household_income)
    {
        if ($household_income <= 10957) {
            $income_classification = "Poor";
        } elseif ($household_income > 10957 && $household_income <= 21194) {
            $income_classification = "Low income";
        } elseif ($household_income > 21194 && $household_income <= 43828) {
            $income_classification = "Lower middle class";
        } elseif ($household_income > 43828 && $household_income <= 76669) {
            $income_classification = "Middle class";
        } elseif ($household_income > 76670 && $household_income <= 131484) {
            $income_classification = "Upper middle class";
        } elseif ($household_income > 131484 && $household_income <= 219140) {
            $income_classification = "High income";
        } elseif ($household_income > 219140) {
            $income_classification = "Rich";
        } else {
            $income_classification = "No data";
        }
        return $income_classification;
    }
}

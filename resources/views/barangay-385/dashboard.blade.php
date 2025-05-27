@extends('layouts.server_test')
@section('title', 'Barangay 386 System Dashboard')
@section('content')

@if(session()->has('unauthorized'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'You are not authorized to view that page',
    })
</script>
@elseif(session()->has('backup'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Backup success.',
        footer: '<a href="https://drive.google.com/drive/u/5/folders/1RCSHjhoCmdmF7aYwiIdOM78azeTKNZmY">Backups storage</a>'
    })
</script>
@endif
<ul class="nav nav-tabs justify-content-center nav-fill" id="myTab" role="tablist">

    <li class="nav-item" role="presentation">
        <button class="nav-link active rounded-3" id="generalinfo-tab" data-bs-toggle="tab" data-bs-target="#generalinfo-tab-pane" type="button" role="tab" aria-controls="generalinfo-tab-pane" aria-selected="false"><i class="fa-solid fa-person-shelter fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="General Household and Resident Information"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-3" id="genderage-tab" data-bs-toggle="tab" data-bs-target="#genderage-tab-pane" type="button" role="tab" aria-controls="genderage-tab-pane" aria-selected="false"><i class="fa-solid fa-children fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Gender and Age Distribution"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-3" id="education-tab" data-bs-toggle="tab" data-bs-target="#education-tab-pane" type="button" role="tab" aria-controls="education-tab-pane" aria-selected="false"><i class="fa-solid fa-book-open-reader fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Educational Attainment"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-3" id="income-tab" data-bs-toggle="tab" data-bs-target="#income-tab-pane" type="button" role="tab" aria-controls="income-tab-pane" aria-selected="false"><i class="fa-solid fa-money-bills fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Income Classes and Job Classification"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-3" id="civilnat-tab" data-bs-toggle="tab" data-bs-target="#civilnat-tab-pane" type="button" role="tab" aria-controls="civilnat-tab-pane" aria-selected="false"><i class="fa-solid fa-flag fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Civil Status and Nationality"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-3" id="religion-tab" data-bs-toggle="tab" data-bs-target="#religion-tab-pane" type="button" role="tab" aria-controls="religion-tab-pane" aria-selected="false"><i class="fa-solid fa-church fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Religion"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-3" id="others-tab" data-bs-toggle="tab" data-bs-target="#others-tab-pane" type="button" role="tab" aria-controls="others-tab-pane" aria-selected="false"><i class="fa-solid fa-house-circle-check fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Other Household Information"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link rounded-3" id="formlog-tab" data-bs-toggle="tab" data-bs-target="#formlog-tab-pane" type="button" role="tab" aria-controls="formlog-tab-pane" aria-selected="false"><i class="fa-solid fa-print fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Forms and Certificates requests"></i></button>
    </li>
    @if(Auth::user()->user_type == 0)
    <li class="nav-item" role="presentation">
        <a class="nav-link" href="/admin-panel/user-activity"><i class="fa-solid fa-user-clock fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="User Activity"></i></a>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="backup-tab" data-bs-toggle="tab" data-bs-target="#backup-tab-pane" type="button" role="tab" aria-controls="backup-tab-pane" aria-selected="false"><i class="fa-solid fa-cloud-arrow-up fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Show database backup options"></i></button>
    </li>
    @endif
</ul>
<div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="generalinfo-tab-pane" role="tabpanel" aria-labelledby="generalinfo-tab" tabindex="0">
        <h5 class="mt-3 mb-4">General Household and Resident Information</h5>
        <div id="general_information">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of households">
                            <div class="card-body">
                                <p class="admin-card-text">Households<i class="float-end fa-solid fa-house fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color: #414b62;">{{$general['household_count']}}</h4>
                                <a href="{{route('households.list')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card" id="tooltip-2" style="background-color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of population in the barangay">
                            <div class="card-body">
                                <p class="admin-card-text" style="color: #f6f6f6;">Total Population<i class="float-end fa-solid fa-users-line fa-2x" style="color: #f6f6f6;"></i></p>
                                <h4 class="card-title fw-bold text-white">{{$general['resident_count']}} </h4>
                                <a href="{{route('residents.index')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of families. It is indicative of how many are the household heads">
                            <div class="card-body">
                                <p class="admin-card-text">Families <i class="float-end fa-solid fa-people-group fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color:#414b62;">{{$general['families']}} </h4>
                                <a href="#" class="invisible">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" id="tooltip-2" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Number of residents that are born in this barangay">
                            <div class="card-body">
                                <p class="admin-card-text">Bona fide residents<i class="float-end fa-solid fa-user-check fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color: #414b62;">{{$general['bona_fide']}} </h4>
                                <a href="{{route('bonafide')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of registered voters">
                            <div class="card-body">
                                <p class="admin-card-text">Registered Voters <i class="float-end fa-solid fa-check-to-slot fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color:#414b62;">{{$general['voters']}} </h4>
                                <a href="{{route('voters')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of person aged 60 and above">
                            <div class="card-body">
                                <p class="admin-card-text">Senior Citizens <i class="float-end fa-solid fa-person-cane fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color:#414b62;">{{$general['senior_citizens']}} </h4>
                                <a href="{{route('seniors')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of households per street">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="household_per_street"> </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of families per street">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="families_per_street"> </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of residents per street">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="residents_per_street"> </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="others-tab-pane" role="tabpanel" aria-labelledby="others-tab" tabindex="0">
        <h5 class="mt-3 mb-4">Other Household Information</h5>
        <div id="others">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-3 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="How households manage their waste">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="waste_management"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Toilet facilities of households">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="toilet_facility"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Primary construction material used in households">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="dwelling_type"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Type of ownership of the household">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="ownership"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="genderage-tab-pane" role="tabpanel" aria-labelledby="genderage-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Gender and Age Distribution</h4>
            <div id="gender_age_distribution">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Gender distribution pie chart">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <figure class="highcharts-figure">
                                            <div id="gender"></div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 mb-3">
                            <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Percentage of people in distinct age groups">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <figure class="highcharts-figure">
                                            <div id="age"> </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="card shadow-sm db-card border-white" style="background-color:#f06e9c" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Percentage of women">
                                        <div class="card-body">
                                            <p class="admin-card-text" style="color: #f6f6f6;">Women<i class="float-end fa-solid fa-person-dress fa-2x" style="color: #f6f6f6;"></i></p>
                                            <h4 class="card-title fw-bold text-white">{{$genderAge['females']}}</h4>
                                            <a href="{{route('women')}}" class="text-light">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="card shadow-sm db-card border-white" style="background-color:#3d8af7" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Percentage of men">
                                        <div class="card-body">
                                            <p class="admin-card-text" style="color: #f6f6f6;">Men<i class="float-end fa-solid fa-person fa-2x" style="color: #f6f6f6;"></i></p>
                                            <h4 class="card-title fw-bold text-white">{{$genderAge['males']}}</h4>
                                            <a href="{{route('men')}}" class="text-light">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 mb-3">
                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of women and children">
                                        <div class="card-body">
                                            <p class="admin-card-text">Women & Children<i class="float-end fa-solid fa-person-breastfeeding fa-2x" style="color: #414b62;"></i></p>
                                            <h4 class="card-title fw-bold" style="color: #414b62;">{{$genderAge['women_children']}}</h4>
                                            <a href="{{route('womenchildren')}}" class="text-secondary">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of pregnant women">
                                        <div class="card-body">
                                            <p class="admin-card-text">Pregnant Women<i class="float-end fa-solid fa-person-pregnant fa-2x" style="color: #414b62;"></i></p>
                                            <h4 class="card-title fw-bold" style="color: #414b62;">{{$genderAge['pregnants']}}</h4>
                                            <a href="{{route('pregnants')}}" class="text-secondary">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of people with disability">
                                        <div class="card-body">
                                            <p class="admin-card-text">PWDs<i class="float-end fa-solid fa-wheelchair fa-2x" style="color: #414b62;"></i></p>
                                            <h4 class="card-title fw-bold" style="color: #414b62;">{{$genderAge['pwds']}}</h4>
                                            <a href="{{route('pwds')}}" class="text-secondary">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Gender distribution in specified age range">
                                <div class="card-body">
                                    <div class="container-fluid">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped mt-3">
                                                <caption>Gender Distribution and Percentage in Distinct Age Range</caption>
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="fw-bold">Age Range</th>
                                                        <th scope="col" class="fw-bold">Men</th>
                                                        <th scope="col" class="fw-bold">Women</th>
                                                        <th scope="col" class="fw-bold">Percentage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="">
                                                        <td scope="row">Less than 1 year</td>
                                                        <td>{{$genderAge['infants_male']}} </td>
                                                        <td>{{$genderAge['infants_female']}}</td>
                                                        <td>{{$genderAge['infants_female']}}%</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td scope="row">1 to 17 years</td>
                                                        <td>{{$genderAge['children_male']}}</td>
                                                        <td>{{$genderAge['children_female']}}</td>
                                                        <td>{{$genderAge['children_percentage']}}%</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td scope="row">18 to 59 years</td>
                                                        <td>{{$genderAge['adults_male']}}</td>
                                                        <td>{{$genderAge['adults_female']}}</td>
                                                        <td>{{$genderAge['adults_percentage']}}%</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td scope="row">60+ years</td>
                                                        <td>{{$genderAge['elderly_male']}}</td>
                                                        <td>{{$genderAge['elderly_female']}}</td>
                                                        <td>{{$genderAge['elderly_percentage']}}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Total</td>
                                                        <td>{{$genderAge['infants_male'] + $genderAge['children_male'] + $genderAge['adults_male'] + $genderAge['elderly_male']}} </td>
                                                        <td>{{$genderAge['infants_female'] + $genderAge['children_female'] + $genderAge['adults_female'] + $genderAge['elderly_female']}} </td>
                                                        <td>{{$genderAge['infants_percentage'] + $genderAge['children_percentage'] + $genderAge['adults_percentage'] + $genderAge['elderly_percentage']}}%</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
    <div class="tab-pane fade" id="education-tab-pane" role="tabpanel" aria-labelledby="education-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Educational Attainment</h5>
        <div id="educational_attainment">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-9 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Bar chart for educational attainment of residents">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="education_attainment"> </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm db-card border-white " style="background-color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of residents that are currently studying">
                                    <div class="card-body">
                                        <p class="admin-card-text" style="color: #f6f6f6;">In school<i class="float-end fa-solid fa-chalkboard-user fa-2x" style="color: #f6f6f6;"></i></p>
                                        <h4 class="card-title fw-bold text-white">{{$education['in_school']}}</h4>
                                        <a href="{{route('inschools')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of out of school youths">
                                    <div class="card-body">
                                        <p class="admin-card-text">Out of school youths<i class="float-end fa-solid fa-school-circle-xmark fa-2x" style="color: #414b62;"></i></p>
                                        <h4 class="card-title fw-bold" style="color: #414b62;">{{$education['outofschoolyouth']}}</h4>
                                        <a href="{{route('outofschools')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="income-tab-pane" role="tabpanel" aria-labelledby="income-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Income Classes and Job Classifications</h5>
        <div id="income_classes">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-4 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Pie chart income classification of residents">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="resident_incomes"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Pie chart income classification by households">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="household_incomes"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="row">
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm py-2 db-card" style="background-color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of employed residents">
                                    <div class="card-body">
                                        <p class="admin-card-text" style="color: #f6f6f6;">Employed<i class="float-end fa-solid fa-id-card fa-2x" style="color: #f6f6f6;"></i></p>
                                        <h4 class="card-title fw-bold text-white">{{$incomeClassesJob['employed']}} </h4>
                                        <a href="{{route('employed')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of unemployed residents">
                                    <div class="card-body">
                                        <p class="admin-card-text">Unemployed<i class="float-end fa-solid fa-user-xmark fa-2x" style="color: #414b62;"></i></p>
                                        <h4 class="card-title fw-bold" style="color:#414b62;">{{$incomeClassesJob['unemployed']}} </h4>
                                        <a href="{{route('unemployed')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Average income of residents">
                                    <div class="card-body">
                                        <p class="admin-card-text">Average Income of Residents<i class="float-end fa-solid fa-money-bills fa-2x" style="color: #414b62;"></i></p>
                                        <h4 class="card-title fw-bold" style="color:#414b62;">Php {{$incomeClassesJob['average_income']}} </h4>
                                        <a href="" class="invisible text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Bar chart job classifications">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="job"></div>
                                        <p class="highcharts-description">

                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="civilnat-tab-pane" role="tabpanel" aria-labelledby="civilnat-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Civil Status and Nationality</h5>
        <div id="civil_nationality">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-sm-7 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Bar chart civil status of residents">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="civil_status"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Pie chart nationality of residents">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="nationality"></div>
                                        <p class="highcharts-description">

                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6 mb-3">
                                <div class="card shadow-sm py-2 db-card" style="background-color:#08306b" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of Filipino residents">
                                    <div class="card-body">
                                        <p class="admin-card-text" style="color: #f6f6f6;">Filipinos<i class="float-end fa-solid fa-id-card fa-2x" style="color: #f6f6f6;"></i></p>
                                        <h4 class="card-title fw-bold text-white">{{$civilStatusNationality['filipinos']}} </h4>
                                        <a href="{{route('filipinos')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card shadow-sm py-2 db-card" style="background-color:#08519c" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of non-Filipino residents">
                                    <div class="card-body">
                                        <p class="admin-card-text" style="color: #f6f6f6;">Non-Filipinos<i class="float-end fa-solid fa-user-xmark fa-2x" style="color: #f6f6f6;"></i></p>
                                        <h4 class="card-title fw-bold text-white">{{$civilStatusNationality['non_filipinos']}} </h4>
                                        <a href="{{route('nonfil')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="religion-tab-pane" role="tabpanel" aria-labelledby="religion-tab" tabindex="0">
        <h5 class="mt-3 mb-4">Religion</h5>
        <div id="others">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 mb-5">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="The religion of the residents">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <figure class="highcharts-figure">
                                        <div id="religion"></div>
                                        <p class="highcharts-description">

                                        </p>
                                    </figure>
                                    <a href="{{route('religion')}}" class="text-secondary float-end">View</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="formlog-tab-pane" role="tabpanel" aria-labelledby="formlog-tab" tabindex="0">
        <h5 class="mt-3 mb-4">Forms and Certificates requests</h5>
        <div id="form_log">
            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Number of forms requested per month">
                <div class="card-body">
                    <div class="container-fluid">
                        <p class="admin-card-text">{{ $form_chart->options['chart_title'] }}</p>
                        <div class="row text-center">
                            <canvas id="forms_requested_by_months"> </canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="backup-tab-pane" role="tabpanel" aria-labelledby="backup-tab" tabindex="0">
        <h5 class="mt-3 mb-4">Backup database</h5>
        <div class="row">
            <div class="col-sm-4">
                <div class="card shadow-sm py-1 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{route('backup')}}" title="Export the entire app and database to itsystem.385@gmail.com Google Drive"> Export database to Google Drive</a></li>
                            <li class="list-group-item"><a href="{{route('households.export')}}" title="Export all Households' data to an Excel file"> Export Households</a></li>
                            <li class="list-group-item"><a href="{{route('residents.export')}}" title="Export all Residents' data to an Excel file"> Export Residents</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="{{ asset('js/analytics.js') }}"></script>
{!! $form_chart->renderJs() !!}
<script>
    $(document).ready(function() {
        let streetNames = <?php echo json_encode($general['street_names']); ?>;
        let householdsPerStreet = <?php echo json_encode($general['household_per_street']); ?>;
        let familiesPerStreet = <?php echo json_encode($general['families_per_street']); ?>;
        let residentsPerStreet = <?php echo json_encode($general['residents_per_street']); ?>;
        let maleAgeArray = <?php echo json_encode($genderAge['male_age_array']); ?>;
        let femaleAgeArray = <?php echo json_encode($genderAge['female_age_array']); ?>;
        let malePercentage = <?php echo json_encode($genderAge['male_percentage']); ?>;
        let femalePercentage = <?php echo json_encode($genderAge['female_percentage']); ?>;
        let arrayEducationCategories = <?php echo json_encode($education['array_education_categories']); ?>;
        let arrayEducation = <?php echo json_encode($education['array_education']); ?>;
        let residentPoor = <?php echo json_encode($incomeClassesJob['resident_poor']) ?>;
        let residentLow = <?php echo json_encode($incomeClassesJob['resident_low_income']) ?>;
        let residentLowerMiddle = <?php echo json_encode($incomeClassesJob['resident_lower_middle']) ?>;
        let residentMiddle = <?php echo json_encode($incomeClassesJob['resident_middle']) ?>;
        let residentUpperMiddle = <?php echo json_encode($incomeClassesJob['resident_upper_middle']) ?>;
        let residentHigh = <?php echo json_encode($incomeClassesJob['resident_high_income']) ?>;
        let residentRich = <?php echo json_encode($incomeClassesJob['resident_rich']) ?>;
        let householdPoor = <?php echo json_encode($incomeClassesJob['household_poor']) ?>;
        let householdLow = <?php echo json_encode($incomeClassesJob['household_low_income']) ?>;
        let householdLowerMiddle = <?php echo json_encode($incomeClassesJob['household_lower_middle']) ?>;
        let householdMiddle = <?php echo json_encode($incomeClassesJob['household_middle']) ?>;
        let householdUpperMiddle = <?php echo json_encode($incomeClassesJob['household_upper_middle']) ?>;
        let householdHigh = <?php echo json_encode($incomeClassesJob['household_high_income']) ?>;
        let householdRich = <?php echo json_encode($incomeClassesJob['household_rich']) ?>;
        let arrayJobCategories = <?php echo json_encode($incomeClassesJob['array_job_categories']); ?>;
        let arrayJob = <?php echo json_encode($incomeClassesJob['array_job']); ?>;
        let civilStatusLabels = <?php echo json_encode($civilStatusNationality['civil_status_labels']); ?>;
        let civilStatus = <?php echo json_encode($civilStatusNationality['civil_status']); ?>;
        let filipinosPercentage = <?php echo json_encode($civilStatusNationality['filipinos_percentage']); ?>;
        let nonfilipinosPercentage = <?php echo json_encode($civilStatusNationality['non_filipinos_percentage']); ?>;
        let catholicPercentage = <?php echo json_encode($religion['catholic_percentage']); ?>;
        let incPercentage = <?php echo json_encode($religion['inc_percentage']); ?>;
        let othersPercentage = <?php echo json_encode($religion['other_religion_percentage']); ?>;
        let composting = <?php echo json_encode($householdInformation['composting']); ?>;
        let incineration = <?php echo json_encode($householdInformation['incineration']); ?>;
        let recycled = <?php echo json_encode($householdInformation['recycled']); ?>;
        let waste_others = <?php echo json_encode($householdInformation['waste_others']); ?>;
        let pail = <?php echo json_encode($householdInformation['pail']); ?>;
        let flushed = <?php echo json_encode($householdInformation['flushed']); ?>;
        let toilet_others = <?php echo json_encode($householdInformation['toilet_others']); ?>;
        let no_toilet = <?php echo json_encode($householdInformation['no_toilet']); ?>;
        let concrete = <?php echo json_encode($householdInformation['concrete']); ?>;
        let semiconcrete = <?php echo json_encode($householdInformation['semiconcrete']); ?>;
        let logwood = <?php echo json_encode($householdInformation['logwood']); ?>;
        let dwelling_others = <?php echo json_encode($householdInformation['dwelling_others']); ?>;
        let rented = <?php echo json_encode($householdInformation['rented']); ?>;
        let owned = <?php echo json_encode($householdInformation['owned']); ?>;
        let sharedowner = <?php echo json_encode($householdInformation['sharedowner']); ?>;
        let sharedrenter = <?php echo json_encode($householdInformation['sharedrenter']); ?>;
        let informalsettler = <?php echo json_encode($householdInformation['informalsettler']); ?>;
        renderHouseholdsPerStreet(streetNames, householdsPerStreet);
        renderFamiliesPerStreet(streetNames, familiesPerStreet);
        renderResidentsPerStreet(streetNames, residentsPerStreet);
        renderResidentAgePyramid(maleAgeArray, femaleAgeArray);
        renderGenderPieChart(malePercentage, femalePercentage);
        renderEducationalAttainment(arrayEducationCategories, arrayEducation);
        renderIncomeClassResidents(residentPoor, residentLow, residentLowerMiddle, residentMiddle, residentUpperMiddle, residentHigh, residentRich);
        renderIncomeClassHouseholds(householdPoor, householdLow, householdLowerMiddle, householdMiddle, householdUpperMiddle, householdHigh, householdRich);
        renderJobClassifications(arrayJobCategories, arrayJob);
        renderCivilStatus(civilStatusLabels, civilStatus);
        renderNationality(filipinosPercentage, nonfilipinosPercentage);
        renderReligion(catholicPercentage, incPercentage, othersPercentage);
        renderWasteManagement(composting, incineration, recycled, waste_others);
        renderToiletFacility(pail, flushed, toilet_others, no_toilet);
        renderDwellingType(concrete, semiconcrete, logwood, dwelling_others);
        renderOwnershipType(rented, owned, sharedowner, sharedrenter, informalsettler);
    });
</script>
@endsection
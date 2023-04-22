@extends('layouts.server_test')
@section('title', 'Barangay 385 System Dashboard')
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

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <!-- <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true"><i class="fa-solid fa-chart-line fa-2x" style="color:#414b62"></i></button>
    </li> -->
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="generalinfo-tab" data-bs-toggle="tab" data-bs-target="#generalinfo-tab-pane" type="button" role="tab" aria-controls="generalinfo-tab-pane" aria-selected="false"><i class="fa-solid fa-people-roof fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="General Household and Resident Information"></i></button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="genderage-tab" data-bs-toggle="tab" data-bs-target="#genderage-tab-pane" type="button" role="tab" aria-controls="genderage-tab-pane" aria-selected="false"><i class="fa-solid fa-children fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Gender and Age Distribution"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="education-tab" data-bs-toggle="tab" data-bs-target="#education-tab-pane" type="button" role="tab" aria-controls="education-tab-pane" aria-selected="false"><i class="fa-solid fa-book-open-reader fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Educational Attainment"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="income-tab" data-bs-toggle="tab" data-bs-target="#income-tab-pane" type="button" role="tab" aria-controls="income-tab-pane" aria-selected="false"><i class="fa-solid fa-money-bills fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Income Classes and Job Classification"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="civilnat-tab" data-bs-toggle="tab" data-bs-target="#civilnat-tab-pane" type="button" role="tab" aria-controls="civilnat-tab-pane" aria-selected="false"><i class="fa-solid fa-flag fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Civil Status and Nationality"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="religion-tab" data-bs-toggle="tab" data-bs-target="#religion-tab-pane" type="button" role="tab" aria-controls="religion-tab-pane" aria-selected="false"><i class="fa-solid fa-church fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Religion"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="others-tab" data-bs-toggle="tab" data-bs-target="#others-tab-pane" type="button" role="tab" aria-controls="others-tab-pane" aria-selected="false"><i class="fa-solid fa-house-circle-check fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Other Household Information"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="formlog-tab" data-bs-toggle="tab" data-bs-target="#formlog-tab-pane" type="button" role="tab" aria-controls="formlog-tab-pane" aria-selected="false"><i class="fa-solid fa-print fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Forms and Certificates requests"></i></button>
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
    <!-- <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">

    </div> -->
    <div class="tab-pane fade show active" id="generalinfo-tab-pane" role="tabpanel" aria-labelledby="generalinfo-tab" tabindex="0">
        <h5 class="mt-3 mb-4">General Household and Resident Information</h5>
        <div id="general_information">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of households">
                            <div class="card-body">
                                <p class="admin-card-text">Households<i class="float-end fa-solid fa-house fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color: #414b62;">{{$household_count}}</h4>
                                <a href="{{route('households.list')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card" id="tooltip-2" style="background-color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of population in the barangay">
                            <div class="card-body">
                                <p class="admin-card-text" style="color: #f6f6f6;">Total Population<i class="float-end fa-solid fa-users-line fa-2x" style="color: #f6f6f6;"></i></p>
                                <h4 class="card-title fw-bold text-white">{{$resident_count}} </h4>
                                <a href="{{route('residents.index')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of families. It is indicative of how many are the household heads">
                            <div class="card-body">
                                <p class="admin-card-text">Families <i class="float-end fa-solid fa-people-group fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color:#414b62;">{{$families}} </h4>
                                <a href="#" class="invisible">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" id="tooltip-2" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Number of residents that are born in this barangay">
                            <div class="card-body">
                                <p class="admin-card-text">Bona fide residents<i class="float-end fa-solid fa-user-check fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color: #414b62;">{{$bona_fide}} </h4>
                                <a href="{{route('bonafide')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of registered voters">
                            <div class="card-body">
                                <p class="admin-card-text">Registered Voters <i class="float-end fa-solid fa-check-to-slot fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color:#414b62;">{{$voters}} </h4>
                                <a href="{{route('voters')}}" class="text-secondary">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of person aged 60 and above">
                            <div class="card-body">
                                <p class="admin-card-text">Senior Citizens <i class="float-end fa-solid fa-person-cane fa-2x" style="color: #414b62;"></i></p>
                                <h4 class="card-title fw-bold" style="color:#414b62;">{{$senior_citizens}} </h4>
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
                                            <h4 class="card-title fw-bold text-white">{{$females}}</h4>
                                            <a href="{{route('women')}}" class="text-light">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="card shadow-sm db-card border-white" style="background-color:#3d8af7" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Percentage of men">
                                        <div class="card-body">
                                            <p class="admin-card-text" style="color: #f6f6f6;">Men<i class="float-end fa-solid fa-person fa-2x" style="color: #f6f6f6;"></i></p>
                                            <h4 class="card-title fw-bold text-white">{{$males}}</h4>
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
                                            <h4 class="card-title fw-bold" style="color: #414b62;">{{$women_children}}</h4>
                                            <a href="{{route('womenchildren')}}" class="text-secondary">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of pregnant women">
                                        <div class="card-body">
                                            <p class="admin-card-text">Pregnant Women<i class="float-end fa-solid fa-person-pregnant fa-2x" style="color: #414b62;"></i></p>
                                            <h4 class="card-title fw-bold" style="color: #414b62;">{{$pregnants}}</h4>
                                            <a href="{{route('pregnants')}}" class="text-secondary">View</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of people with disability">
                                        <div class="card-body">
                                            <p class="admin-card-text">PWDs<i class="float-end fa-solid fa-wheelchair fa-2x" style="color: #414b62;"></i></p>
                                            <h4 class="card-title fw-bold" style="color: #414b62;">{{$pwds}}</h4>
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
                                                        <td>{{$infants_male}} </td>
                                                        <td>{{$infants_female}}</td>
                                                        <td>{{$infants_percentage}}%</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td scope="row">1 to 17 years</td>
                                                        <td>{{$children_male}}</td>
                                                        <td>{{$children_female}}</td>
                                                        <td>{{$children_percentage}}%</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td scope="row">18 to 59 years</td>
                                                        <td>{{$adults_male}}</td>
                                                        <td>{{$adults_female}}</td>
                                                        <td>{{$adults_percentage}}%</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td scope="row">60+ years</td>
                                                        <td>{{$elderly_male}}</td>
                                                        <td>{{$elderly_female}}</td>
                                                        <td>{{$elderly_percentage}}%</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Total</td>
                                                        <td>{{$infants_male + $children_male + $adults_male + $elderly_male}} </td>
                                                        <td>{{$infants_female + $children_female + $adults_female + $elderly_female}} </td>
                                                        <td>{{$infants_percentage + $children_percentage + $adults_percentage + $elderly_percentage}}%</td>
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
                                        <h4 class="card-title fw-bold text-white">{{$in_school}}</h4>
                                        <a href="{{route('inschools')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of out of school youths">
                                    <div class="card-body">
                                        <p class="admin-card-text">Out of school youths<i class="float-end fa-solid fa-school-circle-xmark fa-2x" style="color: #414b62;"></i></p>
                                        <h4 class="card-title fw-bold" style="color: #414b62;">{{$outofschoolyouth}}</h4>
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
                                        <h4 class="card-title fw-bold text-white">{{$employed}} </h4>
                                        <a href="{{route('employed')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of unemployed residents">
                                    <div class="card-body">
                                        <p class="admin-card-text">Unemployed<i class="float-end fa-solid fa-user-xmark fa-2x" style="color: #414b62;"></i></p>
                                        <h4 class="card-title fw-bold" style="color:#414b62;">{{$unemployed}} </h4>
                                        <a href="{{route('unemployed')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <div class="card shadow-sm py-2 db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Average income of residents">
                                    <div class="card-body">
                                        <p class="admin-card-text">Average Income of Residents<i class="float-end fa-solid fa-money-bills fa-2x" style="color: #414b62;"></i></p>
                                        <h4 class="card-title fw-bold" style="color:#414b62;">Php {{$average_income}} </h4>
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
                                        <h4 class="card-title fw-bold text-white">{{$filipinos}} </h4>
                                        <a href="{{route('filipinos')}}" class="text-secondary">View</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card shadow-sm py-2 db-card" style="background-color:#08519c" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of non-Filipino residents">
                                    <div class="card-body">
                                        <p class="admin-card-text" style="color: #f6f6f6;">Non-Filipinos<i class="float-end fa-solid fa-user-xmark fa-2x" style="color: #f6f6f6;"></i></p>
                                        <h4 class="card-title fw-bold text-white">{{$non_filipinos}} </h4>
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
        var streetNames = <?php echo json_encode($street_names); ?>;
        var householdsPerStreet = <?php echo json_encode($household_per_street); ?>;
        var familiesPerStreet = <?php echo json_encode($families_per_street); ?>;
        var residentsPerStreet = <?php echo json_encode($residents_per_street); ?>;
        var maleAgeArray = <?php echo json_encode($male_age_array); ?>;
        var femaleAgeArray = <?php echo json_encode($female_age_array); ?>;
        var malePercentage = <?php echo json_encode($male_percentage); ?>;
        var femalePercentage = <?php echo json_encode($female_percentage); ?>;
        var arrayEducationCategories = <?php echo json_encode($array_education_categories); ?>;
        var arrayEducation = <?php echo json_encode($array_education); ?>;
        var residentPoor = <?php echo json_encode($resident_poor) ?>;
        var residentLow = <?php echo json_encode($resident_low_income) ?>;
        var residentLowerMiddle = <?php echo json_encode($resident_lower_middle) ?>;
        var residentMiddle = <?php echo json_encode($resident_middle) ?>;
        var residentUpperMiddle = <?php echo json_encode($resident_upper_middle) ?>;
        var residentHigh = <?php echo json_encode($resident_high_income) ?>;
        var residentRich = <?php echo json_encode($resident_rich) ?>;
        var householdPoor = <?php echo json_encode($household_poor) ?>;
        var householdLow = <?php echo json_encode($household_low_income) ?>;
        var householdLowerMiddle = <?php echo json_encode($household_lower_middle) ?>;
        var householdMiddle = <?php echo json_encode($household_middle) ?>;
        var householdUpperMiddle = <?php echo json_encode($household_upper_middle) ?>;
        var householdHigh = <?php echo json_encode($household_high_income) ?>;
        var householdRich = <?php echo json_encode($household_rich) ?>;
        var arrayJobCategories = <?php echo json_encode($array_job_categories); ?>;
        var arrayJob = <?php echo json_encode($array_job); ?>;


        renderHouseholdsPerStreet(streetNames, householdsPerStreet);
        renderFamiliesPerStreet(streetNames, familiesPerStreet);
        renderResidentsPerStreet(streetNames, residentsPerStreet);
        renderResidentAgePyramid(maleAgeArray, femaleAgeArray);
        renderGenderPieChart(malePercentage, femalePercentage);
        renderEducationalAttainment(arrayEducationCategories, arrayEducation);
        renderIncomeClassResidents(residentPoor, residentLow, residentLowerMiddle, residentMiddle, residentUpperMiddle, residentHigh, residentRich);
        renderIncomeClassHouseholds(householdPoor, householdLow, householdLowerMiddle, householdMiddle, householdUpperMiddle, householdHigh, householdRich);
        renderJobClassifications(arrayJobCategories, arrayJob);
    });
</script>

<script>
    Highcharts.chart('civil_status', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Civil Status of Residents',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        subtitle: {

        },
        xAxis: {
            categories: <?php echo json_encode($civil_status_labels); ?>,
            crosshair: true,
            labels: {
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.1em'
                }
            },
        },
        yAxis: {
            title: {
                useHTML: true,
                text: null

            },
            labels: {
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.1em'
                }
            },
        },
        tooltip: {
            formatter: function() {
                return this.point.category + '</b><br/>' +
                    'Number of residents: ' + this.point.y;
            },
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },
        plotOptions: {
            column: {
                pointWidth: 100,
                borderRadius: 1,
                borderWidth: 3,
                borderColor: '#deebf7',
                colorByPoint: true,
            }
        },
        series: [{
            name: "Civil Status",
            data: <?php echo json_encode($civil_status); ?>
        }],
        legend: {
            itemStyle: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em',
                "font-weight": "normal"
            }
        },
        colors: ['#08306b',
            '#08519c',
            '#2171b5',
            '#4292c6',
            '#6baed6',
            '#9ecae1',
            '#c6dbef',
            '#deebf7',
        ],
        credits: {
            enabled: false
        },
    });
</script>



<script>
    Highcharts.chart('nationality', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Nationality of Residents',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: ['#08306b',
                    '#08519c',
                    '#2171b5'
                ],
                dataLabels: {
                    enabled: true,
                    format: '{point.name}<br>{point.percentage:.1f} %',
                    distance: -50,
                    style: {
                        color: '#fff',
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    },
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Share',
            data: [{
                    name: 'Filipino',
                    y: <?php echo json_encode($filipinos_percentage); ?>
                },
                {
                    name: 'Non-Filipinos',
                    y: <?php echo json_encode($non_filipinos_percentage); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>



<script>
    Highcharts.chart('religion', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Religion',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: ['#08306b',
                    '#08519c',
                    '#2171b5'
                ],
                dataLabels: {
                    enabled: true,
                    format: '{point.name}<br>{point.percentage:.1f} %',
                    distance: -50,
                    style: {
                        color: '#fff',
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    },
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Percentage of residents',
            data: [{
                    name: 'Catholic',
                    y: <?php echo json_encode($catholic_percentage); ?>
                },
                {
                    name: 'INC',
                    y: <?php echo json_encode($inc_percentage); ?>
                },
                {
                    name: 'Others',
                    y: <?php echo json_encode($other_religion_percentage); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>


<script>
    Highcharts.chart('waste_management', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Waste Management',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: ['#08306b',
                    '#08519c',
                    '#2171b5',
                    '#4292c6',
                    '#6baed6',
                ],
                dataLabels: {
                    enabled: true,
                    format: '{point.name}<br>{point.percentage:.1f} %',
                    distance: -50,
                    style: {
                        color: '#fff',
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    },
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Percentage of households',
            data: [{
                    name: 'Composting',
                    y: <?php echo json_encode($composting); ?>
                },
                {
                    name: 'Incineration',
                    y: <?php echo json_encode($incineration); ?>
                },
                {
                    name: 'Recycled',
                    y: <?php echo json_encode($recycled); ?>
                },
                {
                    name: 'Others',
                    y: <?php echo json_encode($waste_others); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>

<script>
    Highcharts.chart('toilet_facility', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Toilet Facility',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: ['#08306b',
                    '#08519c',
                    '#2171b5',
                    '#4292c6',
                    '#6baed6',
                ],
                dataLabels: {
                    enabled: true,
                    format: '{point.name}<br>{point.percentage:.1f} %',
                    distance: -50,
                    style: {
                        color: '#fff',
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    },
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Percentage of households',
            data: [{
                    name: 'Pail type',
                    y: <?php echo json_encode($pail); ?>
                },
                {
                    name: 'Flushed',
                    y: <?php echo json_encode($flushed); ?>
                },
                {
                    name: 'Others',
                    y: <?php echo json_encode($toilet_others); ?>
                },
                {
                    name: 'No toilet facility',
                    y: <?php echo json_encode($no_toilet); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>

<script>
    Highcharts.chart('dwelling_type', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Type of Dwelling',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: ['#08306b',
                    '#08519c',
                    '#2171b5',
                    '#4292c6',
                    '#6baed6',
                ],
                dataLabels: {
                    enabled: true,
                    format: '{point.name}<br>{point.percentage:.1f} %',
                    distance: -50,
                    style: {
                        color: '#fff',
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    },
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Percentage of households',
            data: [{
                    name: 'Concrete',
                    y: <?php echo json_encode($concrete); ?>
                },
                {
                    name: 'Semi-concrete',
                    y: <?php echo json_encode($semiconcrete); ?>
                },
                {
                    name: 'Log/Wood',
                    y: <?php echo json_encode($logwood); ?>
                },
                {
                    name: 'Others',
                    y: <?php echo json_encode($dwelling_others); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>

<script>
    Highcharts.chart('ownership', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Type of Ownership',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                colors: ['#08306b',
                    '#08519c',
                    '#2171b5',
                    '#4292c6',
                    '#6baed6',
                ],
                dataLabels: {
                    enabled: true,
                    format: '{point.name}<br>{point.percentage:.1f} %',
                    distance: -50,
                    style: {
                        color: '#fff',
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    },
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                }
            }
        },
        series: [{
            name: 'Percentage of households',
            data: [{
                    name: 'Rented',
                    y: <?php echo json_encode($rented); ?>
                },
                {
                    name: 'Owned',
                    y: <?php echo json_encode($owned); ?>
                },
                {
                    name: 'Shared with owner',
                    y: <?php echo json_encode($sharedowner); ?>
                },
                {
                    name: 'Shared with renter',
                    y: <?php echo json_encode($sharedrenter); ?>
                },
                {
                    name: 'Informal settler',
                    y: <?php echo json_encode($informalsettler); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>

@endsection
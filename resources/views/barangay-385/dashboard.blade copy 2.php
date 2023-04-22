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
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-tab-pane" type="button" role="tab" aria-controls="all-tab-pane" aria-selected="true"><i class="fa-solid fa-chart-line fa-2x" style="color:#414b62"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="generalinfo-tab" data-bs-toggle="tab" data-bs-target="#generalinfo-tab-pane" type="button" role="tab" aria-controls="generalinfo-tab-pane" aria-selected="false"><i class="fa-solid fa-people-roof fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="General Household and Resident Information"></i></button>
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
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="all-tab-pane" role="tabpanel" aria-labelledby="all-tab" tabindex="0">

    </div>
    <div class="tab-pane fade show" id="generalinfo-tab-pane" role="tabpanel" aria-labelledby="generalinfo-tab" tabindex="0">
        <h5 class="mt-3 mb-4">General Household and Resident Information</h3>
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
                                    <a href="#" class="text-secondary">View</a>
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
                        <div class="col-sm-12 mb-5">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of households per street">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="household_per_street"> </div>
                                    </figure>
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

                                    <div class="row text-center">
                                        <canvas id="waste_management"> </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Toilet facilities of households">
                            <div class="card-body">
                                <div class="container-fluid">

                                    <div class="row text-center">
                                        <canvas id="toilet_facility"> </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Primary construction material used in households">
                            <div class="card-body">
                                <div class="container-fluid">

                                    <div class="row text-center">
                                        <canvas id="dwelling_type"> </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-3">
                        <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Total number of households per street">
                            <div class="card-body">
                                <div class="container-fluid">

                                    <div class="row text-center">
                                        <canvas id="type_of_ownership"> </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="genderage-tab-pane" role="tabpanel" aria-labelledby="genderage-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Gender and Age Distribution</h3>
            <div id="gender_age_distribution">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Gender distribution pie chart">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="gender"></div>

                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 mb-3">
                            <div class="card border-white shadow-sm db-card" id="tooltip-8" style="background-color:#414b62;" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Gender distribution in specified age range">
                                <div class="card-body">
                                    <div class="container-fluid">

                                        <div class="row justify-content-center text-center">
                                            <div class="col-sm-3 mb-3">
                                                <i class="fa-solid fa-baby fa-5x" style="color:#f6f6f6"></i>
                                                <span class="fw-bold text-white" style="font-size:2.5rem;">{{$infants_percentage}}%</span>
                                                <p class="mt-1 admin-card-text me-3 text-center" style="color:#f6f6f6">Infants</p>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <i class="fa-solid fa-children fa-5x" style="color:#f6f6f6"></i>
                                                <span class="fw-bold text-white" style="font-size:2.5rem;">{{$children_percentage}}%</span>
                                                <p class="mt-1 admin-card-text me-3 text-center" style="color:#f6f6f6">Children</p>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <i class="fa-solid fa-user-tie fa-5x" style="color:#f6f6f6"></i>
                                                <span class="fw-bold text-white" style="font-size:2.5rem;">{{$adults_percentage}}%</span>
                                                <p class="mt-1 admin-card-text me-3 text-center" style="color:#f6f6f6">Adults</p>
                                            </div>
                                            <div class="col-sm-3 mb-3">
                                                <i class="fa-solid fa-person-cane fa-5x" style="color:#f6f6f6"></i>
                                                <span class="fw-bold text-white" style="font-size:2.5rem;">{{$elderly_percentage}}%</span>
                                                <p class="mt-1 admin-card-text me-3 text-center" style="color:#f6f6f6">Elderly</p>
                                            </div>
                                            <hr style="height:0px; border:none; border-top:5px solid #f6f6f6;" class="mb-3">
                                            <div class="row mt-5 mb-2 text-start">
                                                <div class="col-sm-4 mb-2">
                                                    <i class="fa-solid fa-person" style="color:#3d8af7; font-size:14rem"></i>
                                                    <i class="fa-solid fa-person-dress" style="color:#f06e9c; font-size:14rem"></i>
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <h4 class="" style="color:#f6f6f6;">Infants (Less than 1yr)</h4>
                                                    <h4 class="fw-bold mb-5" style="color:#f6f6f6;"><span style="color:#3d8af7">{{$infants_male}}</span> & <span style="color:#f06e9c">{{$infants_female}}</span></h4>
                                                    <h4 class="" style="color:#f6f6f6;">Adults (18 - 59yrs)</h4>
                                                    <h4 class="fw-bold mb-5" style="color:#f6f6f6;"><span style="color:#3d8af7">{{$adults_male}}</span> & <span style="color:#f06e9c">{{$adults_female}}</span></h4>
                                                </div>
                                                <div class="col-sm-4 mb-2">
                                                    <h4 class="" style="color:#f6f6f6;">Children (1 - 17yrs)</h4>
                                                    <h4 class="fw-bold mb-5" style="color:#f6f6f6;"><span style="color:#3d8af7">{{$children_male}}</span> & <span style="color:#f06e9c">{{$children_female}}</span></h4>
                                                    <h4 class="" style="color:#f6f6f6;">Seniors (60+yrs)</h4>
                                                    <h4 class="fw-bold mb-5" style="color:#f6f6f6;"><span style="color:#3d8af7">{{$elderly_male}}</span> & <span style="color:#f06e9c">{{$elderly_female}}</span></h4>
                                                </div>
                                            </div>
                                        </div>
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
                            <div class="card shadow-sm db-card border-white" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Percentage of people in distinct age groups">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="age"> </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="tab-pane fade" id="education-tab-pane" role="tabpanel" aria-labelledby="education-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Educational Attainment</h3>
            <div id="educational_attainment">
                <div class="container-fluid">
                    <div class="row mb-5">
                        <div class="col-sm-9 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Bar chart for educational attainment of residents">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="education_attainment"> </div>
                                    </figure>
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
                                            <h4 class="card-title fw-bold" style="color: #414b62;">{{$pwds}}</h4>
                                            <a href="#" class="text-secondary">View</a>
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

        <h5 class="mt-3 mb-4">Income Classes and Job Classifications</h3>
            <div id="income_classes">
                <div class="container-fluid">
                    <div class="row mb-5">
                        <div class="col-sm-4 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Pie chart income classification of residents">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="resident_incomes"></div>
                                        <p class="highcharts-description">

                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Pie chart income classification by households">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="household_incomes"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
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
                        <!-- <div class="col-sm-12 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Bar chart job classifications">
                                <div class="card-body">
                                    <div class="container-fluid">
                               
                                        <div class="row text-center">
                                            <canvas id="job_classification"> </canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-12">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Bar chart job classifications">
                                <div class="card-body">

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
    <div class="tab-pane fade" id="civilnat-tab-pane" role="tabpanel" aria-labelledby="civilnat-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Civil Status and Nationality</h3>
            <div id="civil_nationality">
                <div class="container-fluid">
                    <div class="row mb-5">
                        <div class="col-sm-7 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Bar chart civil status of residents">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="civil_status"></div>
                                        <p class="highcharts-description">
                                        </p>
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 mb-3">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Pie chart nationality of residents">
                                <div class="card-body">
                                    <figure class="highcharts-figure">
                                        <div id="nationality"></div>
                                        <p class="highcharts-description">

                                        </p>
                                    </figure>
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
        <h5 class="mt-3 mb-4">Religion</h3>
            <div id="others">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4 mb-5">
                            <div class="card border-white shadow-sm db-card" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="The religion of the residents">
                                <div class="card-body">
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
    <div class="tab-pane fade show" id="formlog-tab-pane" role="tabpanel" aria-labelledby="formlog-tab" tabindex="0">

        <h5 class="mt-3 mb-4">Forms and Certificates requests</h3>
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
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>





{!! $form_chart->renderJs() !!}

<script>
    Highcharts.chart('household_per_street', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Household density per street',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        subtitle: {

        },
        xAxis: {
            categories: <?php echo json_encode($street_names); ?>,
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
                    'Number of households: ' + this.point.y;
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
            name: "Streets",
            data: <?php echo json_encode($household_per_street); ?>
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
    var categories = [
        '0-11 mos', '1-2 yrs', '3-5 yrs', '6-12 yrs', '13-17 yrs', '18-59 yrs', '60 above'
    ];

    Highcharts.chart('age', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Age of Residents',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        subtitle: {
            // text: 'Percentage of resident per age group'
        },
        accessibility: {
            point: {
                valueDescriptionFormat: '{index}. Age {xDescription}, {value}%.'
            }
        },
        xAxis: [{
            categories: categories,
            reversed: false,
            labels: {
                step: 1,
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.1em'
                }
            },

            accessibility: {
                description: 'Age (male)'
            }
        }, { // mirror axis on right side
            opposite: true,
            reversed: false,
            categories: categories,
            linkedTo: 0,
            labels: {
                step: 1,
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.1em'
                }
            },
            accessibility: {
                description: 'Age (female)'
            }
        }],
        yAxis: {
            title: {
                text: null
            },
            labels: {
                formatter: function() {
                    return Math.abs(this.value) + '%';
                },
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.1em'
                }
            },
            accessibility: {
                description: 'Percentage population',
                rangeDescription: 'Range: 0 to 5%'
            }
        },

        plotOptions: {
            series: {
                stacking: 'normal',
                pointWidth: 30,
                borderRadius: 1,
                borderWidth: 2,
                borderColor: '#deebf7',

            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' +
                    'Population: ' + Highcharts.numberFormat(Math.abs(this.point.y), 1) + '%';
            },
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
            }
        },

        series: [{
            name: 'Male',
            data: <?php echo json_encode($male_age_array); ?>

        }, {
            name: 'Female',
            data: <?php echo json_encode($female_age_array); ?>
        }],
        legend: {
            itemStyle: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em',
                "font-weight": "normal"
            }
        },
        colors: ['#3d8af7', '#f06e9c'],
        credits: {
            enabled: false
        },
    });
</script>
<script>
    Highcharts.chart('job', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Job Classification',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        xAxis: {
            categories: <?php echo json_encode($array_job_categories); ?>,
            title: {
                text: null
            },
            labels: {
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.1em'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Job Classification',
                align: 'high'
            },
            labels: {
                overflow: 'justify',
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
                    'Number of workers: ' + this.point.y;
            },
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
                "font-size": '1.1em'

            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    color: "#414b62",
                    style: {
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    }
                },
                colorByPoint: true,
                pointWidth: 20,
                borderRadius: 1,
                borderWidth: 2,
                borderColor: '#deebf7',
            }

        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            /* floating: true, */
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '',
            data: <?php echo json_encode($array_job); ?>,
        }],
        colors: ['#08306b',
            '#08519c',
            '#2171b5',
            '#4292c6',
            '#6baed6',
            '#9ecae1',
            '#c6dbef',
            '#deebf7',
        ]

    });
</script>

<script>
    Highcharts.chart('gender', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Gender Distribution',
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
                colors: ['#3d8af7', '#f06e9c'],
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
                    name: 'Male',
                    y: <?php echo json_encode($male_percentage); ?>
                },
                {
                    name: 'Female',
                    y: <?php echo json_encode($female_percentage); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>

<script>
    // Build the chart
    Highcharts.chart('resident_incomes', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Income Classification of Residents',
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
                    '#9ecae1',
                    '#c6dbef',
                    '#deebf7'
                ],
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -10,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                },
                showInLegend: true
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Income Classification',
            data: [{
                    name: <?php echo json_encode($resident_incomes[0]->name); ?>,
                    y: <?php echo json_encode($resident_incomes[0]->data); ?>
                }, {
                    name: <?php echo json_encode($resident_incomes[1]->name); ?>,
                    y: <?php echo json_encode($resident_incomes[1]->data); ?>
                },
                {
                    name: <?php echo json_encode($resident_incomes[2]->name); ?>,
                    y: <?php echo json_encode($resident_incomes[2]->data); ?>
                },
                {
                    name: <?php echo json_encode($resident_incomes[3]->name); ?>,
                    y: <?php echo json_encode($resident_incomes[3]->data); ?>
                },
                {
                    name: <?php echo json_encode($resident_incomes[4]->name); ?>,
                    y: <?php echo json_encode($resident_incomes[4]->data); ?>
                },
                {
                    name: <?php echo json_encode($resident_incomes[5]->name); ?>,
                    y: <?php echo json_encode($resident_incomes[5]->data); ?>
                },
                {
                    name: <?php echo json_encode($resident_incomes[6]->name); ?>,
                    y: <?php echo json_encode($resident_incomes[6]->data); ?>
                },
            ]
        }]

    });
</script>


<script>
    // Build the chart
    Highcharts.chart('household_incomes', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Income Classification of Households',
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
                    '#9ecae1',
                    '#c6dbef',
                    '#deebf7'
                ],
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                    distance: -10,
                    filter: {
                        property: 'percentage',
                        operator: '>',
                        value: 4
                    }
                },
                showInLegend: true
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Income Classification',
            data: [{
                    name: <?php echo json_encode($household_incomes[0]->name); ?>,
                    y: <?php echo json_encode($household_incomes[0]->data); ?>
                }, {
                    name: <?php echo json_encode($household_incomes[1]->name); ?>,
                    y: <?php echo json_encode($household_incomes[1]->data); ?>
                },
                {
                    name: <?php echo json_encode($household_incomes[2]->name); ?>,
                    y: <?php echo json_encode($household_incomes[2]->data); ?>
                },
                {
                    name: <?php echo json_encode($household_incomes[3]->name); ?>,
                    y: <?php echo json_encode($household_incomes[3]->data); ?>
                },
                {
                    name: <?php echo json_encode($household_incomes[4]->name); ?>,
                    y: <?php echo json_encode($household_incomes[4]->data); ?>
                },
                {
                    name: <?php echo json_encode($household_incomes[5]->name); ?>,
                    y: <?php echo json_encode($household_incomes[5]->data); ?>
                },
                {
                    name: <?php echo json_encode($household_incomes[6]->name); ?>,
                    y: <?php echo json_encode($household_incomes[6]->data); ?>
                },
            ]
        }]

    });
</script>

<script>
    Highcharts.chart('education_attainment', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Highest Educational Attainment',
            style: {
                "font-family": 'Roboto, sans-serif',
                "color": "#353c4e",
                "font-size": '1.2em'
            }
        },
        xAxis: {
            categories: <?php echo json_encode($array_education_categories); ?>,
            title: {
                text: null
            },
            labels: {
                style: {
                    "font-family": 'Roboto, sans-serif',
                    "color": "#353c4e",
                    "font-size": '1.1em'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Highest Educational Attainment',
                align: 'high'
            },
            labels: {
                overflow: 'justify',
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
                    'Number of attainees: ' + this.point.y;
            },
            backgroundColor: '#414b62',
            style: {
                color: '#fff',
                "font-family": 'Roboto, sans-serif',
                "font-size": '1.1em'

            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true,
                    color: "#414b62",
                    style: {
                        "font-family": 'Roboto, sans-serif',
                        "font-weight": 'normal'
                    }
                },
                colorByPoint: true,
                pointWidth: 20,
                borderRadius: 1,
                borderWidth: 2,
                borderColor: '#deebf7',
            }

        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            /* floating: true, */
            borderWidth: 1,
            backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '',
            data: <?php echo json_encode($array_education); ?>,
        }],
        colors: ['#08306b',
            '#08519c',
            '#2171b5',
            '#4292c6',
            '#6baed6',
            '#9ecae1',
            '#c6dbef',
            '#deebf7',
        ]

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
            name: 'Share',
            data: [{
                    name: 'Catholic',
                    y: <?php echo json_encode($catholic_percentage); ?>
                },
                {
                    name: 'INC',
                    y: <?php echo json_encode($inc_percentage); ?>
                },
                {
                    name: 'INC',
                    y: <?php echo json_encode($other_religion_percentage); ?>
                },
            ]
        }],
        credits: {
            enabled: false
        },
    });
</script>


@endsection
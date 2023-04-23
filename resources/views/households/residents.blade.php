@extends('layouts.server_test')
@section('title',"Residents in this household")
@section('content')

@if(session()->has('archived'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Resident archived',
        footer: '<a href="{{route("residents.archive_index")}}">Archived Residents</a>'
    })
</script>
@endif
<section class="mt-3 mb-5">
    <h4 class="">
    </h4>
    <div class="d-flex mb-3">

        <div class="me-auto p-2">
            <a class="btn btn-light" href="{{route('streets.households', $household->street_id)}}"><i class=" fa-solid fa-angles-left"></i> Households</a>
        </div>
        <div class="p-2">
        </div>
        <div>
            <a class="btn btn-dark btn-modern mb-3" href="{{route('residents.create', $household->id)}}"><i class="fa-solid fa-user-plus"></i> Add a resident</a>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-3" id="household-tab" data-bs-toggle="tab" data-bs-target="#household-tab-pane" type="button" role="tab" aria-controls="household-tab-pane" aria-selected="true"><i class="fa-solid fa-house-circle-check fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Household Information"></i></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-3" id="resident-tab" data-bs-toggle="tab" data-bs-target="#resident-tab-pane" type="button" role="tab" aria-controls="resident-tab-pane" aria-selected="false"><i class="fa-solid fa-users-line fa-2x" style="color:#414b62" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="bottom" data-bs-title="Residents that live in this household"></i></button>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="household-tab-pane" role="tabpanel" aria-labelledby="household-tab" tabindex="0">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="card border-white shadow-sm mb-3" style="border-radius:15px;">
                        <div class="card-body">
                            <h5 class="card-title mt-2">
                                ({{$residents->count()}}) Residents in #{{$household->edifice_number}} {{App\Http\Controllers\StreetController::street_name($household->street_id)}} St.
                            </h5>
                            <a class="float-end btn btn-sm btn-light" href="{{route('households.edit',$household->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit Household</a>
                            <div class="row">
                                <p class="text-secondary text-uppercase fw-bold mt-3">I. Residents</p>
                                <div class="col-sm-6">
                                    <p class="text-secondary">Number of Family </p>
                                    <p>{{$household->number_family}}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-secondary">Number of Residents </p>
                                    <p>{{$household->household_size}}</p>
                                </div>
                                <p class="text-secondary text-uppercase fw-bold mt-3">II. Economic Status</p>
                                <div class="col-sm-12">
                                    <p class="text-secondary">Total Income </p>
                                    <p>{{$household->income}} @if($household->income_classification == 'Poor')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Poor</span>
                                        @elseif($household->income_classification == 'Low income')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#08519c">Low income</span>
                                        @elseif($household->income_classification == 'Lower middle class')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">Lower middle class</span>
                                        @elseif($household->income_classification == 'Middle class')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Middle class</span>
                                        @elseif($household->income_classification == 'Upper middle class')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#6baed6">Upper middle class</span>
                                        @elseif($household->income_classification == 'High income')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#9ecae1">High income</span>
                                        @elseif($household->income_classification == 'Rich')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#c6dbef">Rich</span>
                                        @endif
                                    </p>
                                </div>
                                <p class="text-secondary text-uppercase fw-bold mt-3">III. Others</p>
                                <div class="col-sm-6 mb-4">
                                    <p class="text-secondary">Ownership </p>
                                    <p>{{$household->ownership}}</p>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <p class="text-secondary">Toilet Facility </p>
                                    <p>{{$household->toilet}}</p>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <p class="text-secondary">Type of Dwelling</p>
                                    <p>{{$household->dwelling_type}}</p>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <p class="text-secondary">Waste Management</p>
                                    <p>{{$household->waste_management}}</p>
                                </div>
                                <div class="col-sm-12">
                                    <p class="text-secondary">Last Updated</p>
                                    <p>{{$household->updated_at}} ({{ \Carbon\Carbon::parse($household->updated_at)->diffForHumans()}})</p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>





        </div>
        <div class="tab-pane fade" id="resident-tab-pane" role="tabpanel" aria-labelledby="resident-tab" tabindex="0">
            <div class="row mt-3">
                @foreach($residents as $resident)
                <div class="col-sm-4 mb-3">
                    <div class="card border-white shadow-sm mb-3" style="border-radius:15px;">
                        <div class="row g-0">
                            <div class="col-md-5">
                                @if($resident->sex=="Male")
                                <img src="https://thumbs.dreamstime.com/b/person-gray-photo-placeholder-man-t-shirt-white-background-147541161.jpg" class="img-fluid rounded-start h-100" alt="...">
                                @else
                                <img src="https://st4.depositphotos.com/9998432/27431/v/600/depositphotos_274313380-stock-illustration-person-gray-photo-placeholder-woman.jpg" class="img-fluid rounded-start h-100" alt="...">
                                @endif
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <span class="float-start small text-muted">Resident ID: #{{$resident->id}}</span>
                                    @if($resident->household_head == "Yes")


                                    <span class="float-end badge rounded-pill text-bg-primary fw-normal me-2" style="color:black; background-color:#90CAF9">Household head</span>
                                    @else
                                    <span class="float-end badge rounded-pill text-bg-light fw-normal">Family member</span>
                                    @endif
                                    <br><br>
                                    <span class="float-left text-secondary text-uppercase fw-bold" style="font-size:12px">Name </span>

                                    <p class="admin-card-text">{{$resident->surname}}, {{$resident->given_name}}@if($resident->middle_name == "") @else, @endif {{$resident->middle_name}}</p>


                                    <span class="float-left text-secondary text-uppercase fw-bold" style="font-size:12px">Age and birth date </span>
                                    <p class="admin-card-text mb-4">{{$resident->age}} yrs. old, {{$resident->birth_date}}</p>
                                    @if(Auth::user()->user_type == 0)
                                    <a class="btn btn-sm btn-danger float-end me-2 mb-3" href="{{route('residents.archive', $resident->id)}}" onclick="return confirm('Archive this resident data?')"><i class="fa-solid fa-box-archive"></i> Archive </a>
                                    @endif
                                    <a class="btn btn-sm btn-dark btn-modern float-end me-2" href="{{route('residents.edit',$resident->id)}}"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                                    <a class="btn btn-sm btn-light float-end me-3 mb-2" href="{{route('residents.view', $resident->id)}}">View</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</section>
@endsection
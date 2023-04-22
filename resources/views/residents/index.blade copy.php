@extends('layouts.server_test')
@section('title', 'Residents')
@section('content')




@if(session()->has('archived'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Resident archived',
        footer: '<a href="{{route("residents.archive_index")}}">Archived Residents</a>'

    })
</script>
@else
@endif


<section class="mt-3 mb-5">
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <h4 class="card-title">({{$residents->count()}}) Residents</h4>
        </div>
        <div class="p-2 bd-highlight">
        </div>
        <div class="p-2 bd-highlight">
            <form action="{{route('residents.index')}}" method="get">
                @csrf
                <div class="input-group">
                    <span class="input-group-text border-0 bg-white"><a href="{{route('residents.index')}}"><i class="fa-solid fa-arrows-rotate text-dark"></i></a></span>
                    <input type="text" class="form-control rounded-0 shadow-none border-0" name="search" id="search" placeholder="Search for name ...">
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="#">
            <caption>
                <a href="{{route('residents.simplified')}}" class="text-secondary float-end"> <i class="fa-solid fa-table-cells"></i> Show simplified view</a>
            </caption>
            <thead class="bg-modern text-light">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($residents as $key => $resident)
                <tr>
                    <td>
                        @if($resident->sex=="Male")
                        <img src="https://thumbs.dreamstime.com/b/person-gray-photo-placeholder-man-t-shirt-white-background-147541161.jpg" class="rounded-start" alt="..." height=40>
                        @else
                        <img src="https://st4.depositphotos.com/9998432/27431/v/600/depositphotos_274313380-stock-illustration-person-gray-photo-placeholder-woman.jpg" class="rounded-start" alt="..." height=40>
                        @endif
                    </td>
                    <td><span class="text-uppercase"> {{$resident->surname}}, {{$resident->given_name}}</span>
                        <div class="badges mt-1">

                            @if($resident->household_head == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Head</span>
                            @else
                            @endif
                            @if($resident->is_employed == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#08519c">Employed</span>
                            @else
                            @endif
                            @if($resident->is_studying == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">Enrolled</span>
                            @else
                            @endif
                            @if($resident->bona_fide == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Bona fide</span>
                            @else
                            @endif
                            @if($resident->resident_six_months == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#6baed6">Here for 6+months</span>
                            @else
                            @endif
                            @if($resident->solo_parent == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#9ecae1">Solo Parent</span>
                            @else
                            @endif
                            @if($resident->voter == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#c6dbef">Voter</span>
                            @else
                            @endif
                            @if($resident->pwd == 'Yes')
                            <span class="badge rounded-pill fw-normal" style="background-color:#deebf7">PWD</span>
                            @else
                            @endif
                        </div>
                    </td>
                    <td>{{$resident->age}}</td>
                    <td>{{$resident->contact}}</td>

                    <td>{{$resident->household_id}} {{App\Http\Controllers\StreetController::street_name($resident->household->street_id)}} St.</td>

                    <td>{{$resident->updated_at}} ({{ \Carbon\Carbon::parse($resident->updated_at)->diffForHumans()}})</td>

                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-light mb-2 me-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$resident->id}}">
                            View
                        </button>
                        <!-- Modal -->
                        <div class="modal" id="exampleModal{{$resident->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content rounded-4">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-5" id="exampleModalLabel{{$resident->id}}">{{$resident->surname}}, {{$resident->given_name}}</h5>
                                        <button type="button" class="btn-close btn-sm shadow-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        @if($resident->household_head == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Head</span>
                                        @else
                                        @endif
                                        @if($resident->is_employed == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#08519c">Employed</span>
                                        @else
                                        @endif
                                        @if($resident->is_studying == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">Enrolled</span>
                                        @else
                                        @endif
                                        @if($resident->bona_fide == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Bona fide</span>
                                        @else
                                        @endif
                                        @if($resident->resident_six_months == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#6baed6">Here for 6+months</span>
                                        @else
                                        @endif
                                        @if($resident->solo_parent == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#9ecae1">Solo Parent</span>
                                        @else
                                        @endif
                                        @if($resident->voter == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#c6dbef">Voter</span>
                                        @else
                                        @endif
                                        @if($resident->pwd == 'Yes')
                                        <span class="badge rounded-pill fw-normal" style="background-color:#deebf7">PWD</span>
                                        @else
                                        @endif
                                        <br>
                                        <br>

                                        <span class="mt-3 text-secondary text-uppercase  " style="font-size:12px">I. Resident Profile</span>
                                        <div class="row">
                                            <div class="col-sm-4 mb-2">
                                                <label for="surname" class="admin-card-text   form-label">Full Name</label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('surname') is-invalid @enderror" name="surname" id="surname" placeholder="Surname" value="{{$resident->surname}}" disabled></input>
                                            </div>
                                            <div class="col-sm-4 mb-2">
                                                <label for="given_name" class="admin-card-text   form-label invisible">Given Name</label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('given_name') is-invalid @enderror" name="given_name" id="given_name" placeholder="Given Name" value="{{$resident->given_name}}" disabled></input>
                                            </div>
                                            <div class="col-sm-4 mb-4">
                                                <label for="middle_name" class="admin-card-text   form-label invisible">Middle Name</label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" placeholder="Middle Name" value="{{$resident->middle_name}}" disabled></input>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 mb-2">
                                                <label for="birth_date" class="admin-card-text   form-label">Birth date </label>
                                                <input type="date" class="form-control shadow-none rounded-0 @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{$resident->birth_date}}" disabled></input>

                                            </div>
                                            <div class="col-sm-4 mb-2">
                                                <label for="age" class="admin-card-text   form-label">Age </label>
                                                <input type="number" min=0 max=120 class="form-control shadow-none rounded-0 @error('age') is-invalid @enderror" name="age" id="age" value="{{$resident->age}}" disabled></input>

                                            </div>
                                            <div class="col-sm-4 mb-4">
                                                <label for="sex" class="admin-card-text   form-label">Sex </label>
                                                <select class="form-select shadow-none rounded-0 @error('sex') is-invalid @enderror" name="sex" id="sex" disabled>
                                                    <option {{$resident->sex == "Male"  ? 'selected' : ''}}>Male</option>
                                                    <option {{$resident->sex == "Female"  ? 'selected' : ''}}>Female</option>
                                                </select>

                                            </div>
                                            <div class="col-sm-4">

                                            </div>
                                            <div class="col-sm-4">

                                            </div>
                                            <div class="col-sm-4" id="pregnant_field">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 mb-2">
                                                <label for="civil_status" class="form-label admin-card-text  ">Civil Status </label>
                                                <select class="form-select shadow-none rounded-0 @error('civil_status') is-invalid @enderror" name="civil_status" id="civil_status" disabled>
                                                    <option {{$resident->civil_status == "Single"  ? 'selected' : ''}}>Single</option>
                                                    <option {{$resident->civil_status == "Married"  ? 'selected' : ''}}>Married</option>
                                                    <option {{$resident->civil_status == "Divorced"  ? 'selected' : ''}}>Divorced</option>
                                                    <option {{$resident->civil_status == "Separated"  ? 'selected' : ''}}>Separated</option>
                                                    <option {{$resident->civil_status == "Widowed"  ? 'selected' : ''}}>Widowed</option>
                                                </select>

                                            </div>
                                            <div class="col-sm-4 mb-2">
                                                <label for="nationality" class="form-label admin-card-text  ">Nationality </label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('nationality') is-invalid @enderror" name="nationality" id="nationality" value="{{$resident->nationality}}" disabled></input>

                                            </div>
                                            <div class="col-sm-4 mb-4">
                                                <label for="contact" class="form-label admin-card-text">Contact Information</label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('contact') is-invalid @enderror" name="contact" id="contact" value="{{$resident->contact}}" disabled></input>

                                            </div>
                                        </div>
                                        <br>
                                        <span class="mt-3 text-secondary text-uppercase  " style="font-size:12px">II. Education Information</span>
                                        <!-- <p class="admin-card-text">Background data about the educational attainment of the resident</p> -->

                                        <div class="row">
                                            <div class="col-sm-4 mb-3">
                                                <label for="is_studying" class="form-label admin-card-text">Is studying?</label>
                                                <select class="form-select shadow-none rounded-0 @error('is_studying') is-invalid @enderror" name="is_studying" id="is_studying" disabled>
                                                    <option {{ $resident->is_studying == "Yes" ? 'selected' : '' }}>Yes</option>
                                                    <option {{ $resident->is_studying == "No" ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 mb-3">
                                                <label for="education" class="form-label admin-card-text  ">Educational Attainment</label>
                                                <select class="form-select shadow-none rounded-0 @error('education') is-invalid @enderror" name="education" id="education" disabled>
                                                    <option {{$resident->education == "No grade completed"  ? 'selected' : ''}}>No grade completed</option>
                                                    <option {{$resident->education == "Elementary undergraduate"  ? 'selected' : ''}}>Elementary undergraduate</option>
                                                    <option {{$resident->education == "Elementary graduate"  ? 'selected' : ''}}>Elementary graduate</option>
                                                    <option {{$resident->education == "High school undergraduate"  ? 'selected' : ''}}>High school undergraduate</option>
                                                    <option {{$resident->education == "High school graduate"  ? 'selected' : ''}}>High school graduate</option>
                                                    <option {{$resident->education == "Post secondary undergraduate"  ? 'selected' : ''}}>Post secondary undergraduate</option>
                                                    <option {{$resident->education == "Post secondary graduate"  ? 'selected' : ''}}>Post secondary graduate</option>
                                                    <option {{$resident->education == "College undergraduate"  ? 'selected' : ''}}>College undergraduate</option>
                                                    <option {{$resident->education == "College graduate"  ? 'selected' : ''}}>College graduate</option>
                                                    <option {{$resident->education == "Post baccalaureate"  ? 'selected' : ''}}>Post baccalaureate</option>
                                                </select>

                                            </div>
                                            <div class="col-sm-4 mb-4">
                                                <label for="institution" class="form-label admin-card-text">Institution</label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('institution') is-invalid @enderror" name="institution" id="institution" value="{{$resident->institution}}" disabled></input>

                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <label for="graduate_year" class="form-label admin-card-text ">Year of Graduation</label>
                                                <input type="month" class="form-control shadow-none rounded-0 @error('graduate_year') is-invalid @enderror" name="graduate_year" id="graduate_year" value="{{$resident->graduate_year}}" disabled> </input>

                                            </div>
                                            <div class="col-sm-6">
                                                <label for="specialization" class="form-label admin-card-text ">Specialization</label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('specialization') is-invalid @enderror" name="specialization" id="specialization" value="{{$resident->specialization}}" disabled></input>
                                            </div>
                                        </div>
                                        <br>
                                        <span class="mt-2 text-secondary text-uppercase  " style="font-size:12px">III. Employment Status</span>
                                        <!-- <p class="admin-card-text">Some information regarding income and employment status of the resident</p> -->
                                        <div class="row">
                                            <div class="col-sm-4">

                                                <label for="is_employed" class="form-label admin-card-text">Is employed?</label>
                                                <select class="form-select shadow-none rounded-0 @error('is_employed') is-invalid @enderror" name="is_employed" id="is_employed" disabled>
                                                    <option {{ $resident->is_employed == "Yes" ? 'selected' : '' }}>Yes</option>
                                                    <option {{ $resident->is_employed == "No" ? 'selected' : '' }}>No</option>
                                                </select>

                                            </div>
                                            <div class="col-sm-4">
                                                <label for="job_title" class="form-label admin-card-text">Job title</label>
                                                <input type="text" class="form-control shadow-none rounded-0 @error('job_title') is-invalid @enderror" name="job_title" id="job_title" value="{{$resident->job_title}}" disabled></input>
                                                <small class="text-muted">

                                                </small>
                                            </div>
                                            <div class="col-sm-4">

                                            </div>
                                        </div>
                                        <a class="btn btn-sm btn-dark btn-modern mt-4 mb-2 float-end" href="{{route('households.residents',$resident->household_id)}}"><i class="fa-solid fa-house-user"></i> View household profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-sm btn-dark btn-modern mb-2 me-2" href="/residents/edit/{{$resident->id}}"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
                        <a class="text-danger mb-2" href="/residents/archive/{{$resident->id}}" onclick="return confirm('Archive resident data?')">Archive</a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{$residents->appends(['search'=>request()->query('search')])->links() }}
    </div>
</section>

<script>
    function toggleBadges() {

        $(".badges").each(function() {
            if ($(this).css("display") == "none") {
                $(this).show();
                document.getElementById("toggleBtn").innerHTML = "<i class='fa-solid fa-eye-low-vision'></i> Hide status badges";

            } else {
                $(this).hide();
                document.getElementById("toggleBtn").innerHTML = "<i class='fa-solid fa-eye'></i> Show status badges";

            }
        });

    }
</script>
@endsection
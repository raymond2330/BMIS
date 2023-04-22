@extends('layouts.server_test')
@section('title', 'Archived Residents')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('created'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'User created successfully',
        })
    </script>
    @elseif(session()->has('archived'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Resident archived',
            footer: '<a href="{{route("residents.archive_index")}}">Archived Residents</a>'
        })
    </script>
    @elseif(session()->has('deleted'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Resident deleted permanently',
        })
    </script>
    @elseif(session()->has('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Invalid password',
        })
    </script>
    @elseif(session()->has('restored'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Resident restored',
            footer: '<a href="{{route("residents.index")}}">Return to residents list</a>'
        })
    </script>
    @endif
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <h4 class="card-title">
                ({{ $residents->count() }}) Archived Residents
            </h4>
        </div>
        <div class="p-2 bd-highlight">

        </div>
        <div class="p-2">

        </div>
    </div>
    <div class="table-responsive">
        <table class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="archiveTable">

            <thead class="bg-modern text-white">
                <tr>
                    <th></th>
                    <th>Address</th>
                    <th>Name</th>
                    <th>Archive date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($residents as $resident)
                <tr>
                    <td>
                        @if($resident->sex=="Male")
                        <img src="https://thumbs.dreamstime.com/b/person-gray-photo-placeholder-man-t-shirt-white-background-147541161.jpg" class="rounded-start" alt="..." height=40>
                        @else
                        <img src="https://st4.depositphotos.com/9998432/27431/v/600/depositphotos_274313380-stock-illustration-person-gray-photo-placeholder-woman.jpg" class="rounded-start" alt="..." height=40>
                        @endif
                    </td>
                    <td>{{$resident->household_id}} {{App\Http\Controllers\StreetController::street_name($resident->household->street_id)}} St.</td>
                    <td> {{$resident->surname}}, {{$resident->given_name}}</td>
                    <td> {{$resident->updated_at}} ({{ \Carbon\Carbon::parse($resident->updated_at)->diffForHumans()}})</td>
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
                                                <label for="income" class="form-label admin-card-text">({{$resident->income_range}})</label>
                                                <input type="number" class="form-control shadow-none rounded-0 @error('income') is-invalid @enderror" name="income" id="income" value="{{$resident->income}}" disabled></input>
                                                <small class="">
                                                    <span class="fw-bold">Income Classification:</span> {{$resident->income_classification}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('residents.restore',$resident->id)}}" class="btn btn-sm btn-dark btn-modern mb-2" onclick="return confirm('Restore this resident data?')"><i class="fa-solid fa-user-check"></i> Restore</a>
                        <!-- <a href="{{route('residents.destroy',$resident->id)}}" class="btn btn-sm btn-danger mb-2" onclick="return confirm('Delete this resident data?')"><i class="fa-solid fa-user-check"></i> Delete</a> -->
                        <button type="button" class="btn btn-sm btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{$resident->id}}">
                            <i class="fa-solid fa-trash"></i> Delete permanently
                        </button>
                        <!-- Modal -->
                        <div class="modal" id="deleteModal{{$resident->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content rounded-4 border-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-5 text-danger">Permanently delete this resident?</h5>
                                        <button type="button" class="btn-close btn-sm shadow-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">
                                        <form action="{{route('residents.destroy',$resident->id)}}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="password" class=" admin-card-text mb-2">We need to verify first that you are the currently logged in
                                                    <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Master</span>
                                                    account. Please enter your password.
                                                </label>
                                                <input type="password" class="form-control shadow-none rounded-0 @error('password') is-invalid @enderror" name="password" id="password" placeholder="" value="{{old('password')}}"></input>
                                                @error('password')
                                                <small class="text-danger">
                                                    {{$message}}
                                                </small>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete permanently</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
@extends('layouts.server_test')
@section('title','Resident Profile')
@section('content')
<section class="mt-3 mb-5">
    <div class="row">
        <div class="col-sm-9">
            <div class="card shadow rounded-4 border-white">
                <div class="card-body">
                    <a href="{{route('households.residents', $resident->household->id)}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Residents</a>
                    <h4 class="card-title">{{$resident->given_name}} {{$resident->middle_name}} {{$resident->surname}}</h4>
                    <p class="admin-card-text mb-5">All information about the household profile, resident profile, education information, and employment status of a resident</p>
                    <form>
                        <div class="row">
                            <div class="col-sm-3">
                                <span class="mt-2 text-secondary text-uppercase  " style="font-size:12px">I. Household Profile</span>
                                <p class="admin-card-text">The complete address of the resident as well as other household data</p>
                            </div>
                            <div class="col-sm-9 mb-5">
                                <label for="full_address" class="admin-card-text form-label  ">Address </label>
                                <input type="text" class="form-control shadow-none rounded-0" value="{{$resident->household->edifice_number}} {{$resident->household->street->street}} Street, Brgy. 385, 1001, Quiapo, Manila" disabled></input>
                                <div class="row">
                                    <div class="col-sm-6 mt-3">
                                        <label for="full_address" class="admin-card-text   form-label">Household income </label>
                                        <input type="text" class="form-control shadow-none rounded-0" value="P {{$resident->household->income}}" disabled></input>
                                        <small><span class="fw-bold">Income Classification: </span>{{$resident->household->income_classification}}</small>
                                    </div>
                                    <div class="col-sm-6 mt-3">
                                        <label for="full_address" class="admin-card-text form-label">Household Size</label>
                                        <input type="text" class="form-control shadow-none rounded-0" value="{{$resident->household->household_size}}" disabled></input>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <span class="mt-2 text-secondary text-uppercase  " style="font-size:12px">II. Resident Profile</span>
                                <p class="admin-card-text">Basic information about the resident</p>
                            </div>
                            <div class="col-sm-9 mb-5">
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
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text" for="" style="font-size:14px">Is the household head? </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="household_head" id="household_head" value="Yes" {{$resident->household_head == "Yes"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="household_head" id="household_head" value="No" {{$resident->household_head == "No"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text" for="" style="font-size:14px">Is a bona fide resident? </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bona_fide" id="bona_fide" value="Yes" {{$resident->bona_fide == "Yes"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bona_fide" id="bona_fide" value="No" {{$resident->bona_fide == "No"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="" style="font-size:14px">Here for more than 6 months? </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="resident_six_months" id="resident_six_months" value="Yes" {{$resident->resident_six_months == "Yes"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="resident_six_months" id="resident_six_months" value="No" {{$resident->resident_six_months == "No"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">No</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="" style="font-size:14px">Is a solo parent? </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="solo_parent" id="solo_parent" value="Yes" {{$resident->solo_parent == "Yes"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="solo_parent" id="solo_parent" value="No" {{$resident->solo_parent == "No"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">No</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="">Registered Voter? </label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="voter" id="voter" value="Yes" {{$resident->voter == "Yes"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="voter" id="voter" value="No" {{$resident->voter == "No"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">No</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label mt-3 admin-card-text  " for="">PWD? </label>({{$resident->disability}})<br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pwd" id="pwd" value="Yes" {{$resident->pwd == "Yes"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pwd" id="pwd" value="No" {{$resident->pwd == "No"  ? 'checked' : ''}} onclick="return false;">
                                            <label class="form-check-label" for="">No</label>
                                        </div>

                                    </div>
                                    <div class="col-sm-4">

                                    </div>
                                    <div class="col-sm-4">

                                    </div>
                                    <div class="col-sm-4" id="pwd_field">

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <span class="mt-2 text-secondary text-uppercase" style="font-size:12px">III. Education Information</span>
                                <p class="admin-card-text">Background data about the educational attainment of the resident</p>
                            </div>
                            <div class="col-sm-9 mb-5">
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
                            </div>
                            <div class="col-sm-3">
                                <span class="mt-2 text-secondary text-uppercase  " style="font-size:12px">IV. Employment Status</span>
                                <p class="admin-card-text">Some information regarding income and employment status of the resident</p>
                            </div>
                            <div class="col-sm-9">
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
                                            Leave blank if the resident is unemployed
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
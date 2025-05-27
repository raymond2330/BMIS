@extends('layouts.server_test')
@section('title', 'Add a resident in this household')
@section('content')
<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Resident added successfully',
            footer: '<a href="{{route("households.residents", $household->id)}}">Return to residents list</a>'
        })
    </script>
    @else
    @endif
    <div class="row">
        <div class="col-sm-9">
            <div class="card shadow-sm rounded-4 border-white">
                <div class="card-body">
                    <a href="{{route('households.residents', $household->id)}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Residents</a>
                    <h4 class="card-title">Add a resident in this household</h4>
                    <p class="admin-card-text mb-5">Fill all the required fields <span class="text-danger">( * )</span> in this form to add a resident in the selected household</p>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-dark btn-modern" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <u> Data Privacy Consent Form</u>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Privacy Consent Form</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="">
                                        Information Management System - Household Profiling Objectives:
                                    </p>
                                    <ul>
                                        <li> Implement a community-based monitoring program that generates aggregated data necessary in targeting beneficiaries</li>
                                        <li> To conduct an extensive poverty analysis and target individuals/areas that need prioritization</li>
                                        <li> To create appropriate policies, projects, and extension programs </li>
                                        <li> To establish a data collection and centralized information system that ensures human right to privacy, data quality, and uphold data collection principles of legitimate purpose, transparency, and proportionality</li>
                                    </ul>
                                    <hr>
                                    <p>Consent Form</p>
                                    <em>
                                        <p>
                                            The undersigned has given permission to the Barangay 386 staff, in charge of the household profiling; lawful use, and disclosure of my personal data which may include my name, contact information, age, birth date, civil status, and other personal details.
                                        </p>
                                        <p>
                                            I understand that Barangay 386 and related offices are authorized to process my personal and sensitive personal information without need of my consent pursuant to the relevant portions of Sections 4, 12, and 13 of the Philippine Data Privacy Act.
                                        </p>
                                        <p>
                                            I, further attest, that the Barangay 386 and other appropriate offices in the said Barangay are authorized to provide the above information to legitimate institutions/officers requesting specific information in relation to planning, impact monitoring, and projects or programs implementation within the Barangay.
                                        </p>
                                        <p>
                                            I consent to the processing of my personal and sensitive personal information contained in this form submitted for the purpose of enabling the Barangay 386 including all the relevant system and offices to verify my identity, prevent fraud, determine whether I am qualified to avail such program or other similar financial or other assistance, and conduct research using non-identifiable information in order to study the effectiveness of the Information Management System and assess how to improve it.
                                        </p>
                                        <p>
                                            This consent enables the Barangay 386 to comply with R.A. 10173, otherwise known as the Data Privacy Act of 2012
                                        </p>
                                    </em>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">I do not agree</button>
                                    <button type="button" class="btn btn-sm btn-dark btn-modern">Agree</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{route('residents.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <br>
                                <span class="mt-2 text-secondary text-uppercase" style="font-size:12px">I. Household Profile</span>
                                <p class="admin-card-text">The complete address of the resident</p>
                                <input type="hidden" name="household_id" value="{{Crypt::encryptString($household->id)}}">

                            </div>
                            <div class="col-sm-9 mb-5">
                                <label for="surname" class="admin-card-text form-label">Address</label>
                                <input type="text" class="form-control shadow-none rounded-0" value="{{$household->edifice_number}} {{App\Http\Controllers\StreetController::street_name($household->street_id)}} Street, Brgy. 385, 1001, Quiapo, Manila" disabled></input>

                            </div>
                            <div class="col-sm-3">
                                <span class="mt-2 text-secondary text-uppercase  " style="font-size:12px">II. Resident Profile</span>
                                <p class="admin-card-text">Basic information about the resident</p>
                            </div>
                            <div class="col-sm-9 mb-5">
                                <div class="row">
                                    <div class="col-sm-4 mb-2">
                                        <label for="surname" class="admin-card-text   form-label">Full Name</label><span class="text-danger">( * )</span>
                                        <input type="text" class="form-control shadow-none rounded-0 @error('surname') is-invalid @enderror" name="surname" id="surname" placeholder="Surname" value={{old('surname')}}></input>
                                        @error('surname')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="given_name" class="admin-card-text   form-label invisible">Given Name</label>
                                        <input type="text" class="form-control shadow-none rounded-0 @error('given_name') is-invalid @enderror" name="given_name" id="given_name" placeholder="Given Name" value={{old('given_name')}}></input>
                                        @error('given_name')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label for="middle_name" class="admin-card-text   form-label invisible">Middle Name</label>
                                        <input type="text" class="form-control shadow-none rounded-0 @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" placeholder="Middle Name" value={{old('middle_name')}}></input>
                                        @error('middle_name')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <label for="birth_date" class="admin-card-text   form-label">Birth date </label><span class="text-danger">( * )</span>
                                        <input type="date" class="form-control shadow-none rounded-0 @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value={{old('birth_date')}}></input>
                                        @error('birth_date')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-4">
                                        <label for="sex" class="admin-card-text   form-label">Sex </label><span class="text-danger">( * )</span>
                                        <select class="form-select @error('sex') is-invalid @enderror" name="sex" id="sex">
                                            <option {{ old('sex') == "Male" ? 'selected' : '' }}>Male</option>
                                            <option {{ old('sex') == "Female" ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('sex')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
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
                                        <label for="religion" class="form-label admin-card-text">Religion </label><span class="text-danger">( * )</span>
                                        <select class="form-select shadow-none rounded-0 @error('religion') is-invalid @enderror" name="religion" id="religion">
                                            <option {{ old('religion') == "Catholic" ? 'selected' : '' }}>Catholic</option>
                                            <option {{ old('religion') == "INC" ? 'selected' : '' }}>INC</option>
                                            <option {{ old('religion') == "Others" ? 'selected' : '' }}>Others</option>
                                        </select>
                                        @error('religion')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="civil_status" class="form-label admin-card-text  ">Civil Status </label>
                                        <select class="form-select shadow-none rounded-0 @error('civil_status') is-invalid @enderror" name="civil_status" id="civil_status">
                                            <option {{ old('civil_status') == "Single" ? 'selected' : '' }}>Single</option>
                                            <option {{ old('civil_status') == "Married" ? 'selected' : '' }}>Married</option>
                                            <option {{ old('civil_status') == "Annulled" ? 'selected' : '' }}>Annulled</option>
                                            <option {{ old('civil_status') == "Separated" ? 'selected' : '' }}>Separated</option>
                                            <option {{ old('civil_status') == "Widowed" ? 'selected' : '' }}>Widowed</option>
                                        </select>
                                        @error('civil_status')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label for="nationality" class="form-label admin-card-text  ">Nationality </label><span class="text-danger">( * )</span>
                                        <input type="text" class="form-control shadow-none rounded-0 @error('nationality') is-invalid @enderror" name="nationality" id="nationality" value="Filipino"></input>
                                        @error('nationality')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label for="contact" class="form-label admin-card-text">Contact Information</label>
                                        <input type="text" class="form-control shadow-none rounded-0 @error('contact') is-invalid @enderror" name="contact" id="contact" value={{old('contact')}}></input>
                                        @error('contact')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12"></div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="" style="font-size:14px">Is the household head? </label><span class="text-danger">( * )</span><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="household_head" id="household_head" value="Yes" {{ old('household_head') == "Yes" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="household_head" id="household_head" value="No" {{ old('household_head') == "No" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                        @error('household_head')
                                        <small class="text-danger">
                                            <br> {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="" style="font-size:14px">Is a bona fide resident? </label><span class="text-danger">( * )</span><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bona_fide" id="bona_fide" value="Yes" {{ old('bona_fide') == "Yes" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="bona_fide" id="bona_fide" value="No" {{ old('bona_fide') == "No" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                        @error('bona_fide')
                                        <small class="text-danger">
                                            <br> {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="" style="font-size:14px">Here for more than 6 months? </label><span class="text-danger">( * )</span><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="resident_six_months" id="resident_six_months" value="Yes" {{ old('resident_six_months') == "Yes" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="resident_six_months" id="resident_six_months" value="No" {{ old('resident_six_months') == "No" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                        @error('resident_six_months')
                                        <small class="text-danger">
                                            <br> {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="" style="font-size:14px">Is a solo parent? </label><span class="text-danger">( * )</span><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="solo_parent" id="solo_parent" value="Yes" {{ old('solo_parent') == "Yes" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="solo_parent" id="solo_parent" value="No" {{ old('solo_parent') == "No" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                        @error('solo_parent')
                                        <small class="text-danger">
                                            <br> {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-2">
                                        <label class="form-label mt-3 admin-card-text  " for="">Registered Voter? </label><span class="text-danger">( * )</span><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="voter" id="voter" value="Yes" {{ old('voter') == "Yes" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="voter" id="voter" value="No" {{ old('voter') == "No" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                        @error('voter')
                                        <small class="text-danger">
                                            <br> {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label mt-3 admin-card-text  " for="">PWD? </label><span class="text-danger">( * )</span><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pwd" id="pwd" value="Yes" {{ old('pwd') == "Yes" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pwd" id="pwd" value="No" {{ old('pwd') == "No" ? 'checked' : '' }}>
                                            <label class="form-check-label" for="">No</label>
                                        </div>
                                        @error('pwd')
                                        <small class="text-danger">
                                            <br> {{$message}}
                                        </small>
                                        @enderror
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
                                <span class="mt-2 text-secondary text-uppercase  " style="font-size:12px">III. Education Information</span>
                                <p class="admin-card-text">Background data about the educational attainment of the resident</p>
                            </div>
                            <div class="col-sm-9 mb-5">
                                <div class="row">
                                    <div class="col-sm-4 mb-3">
                                        <label for="is_studying" class="form-label admin-card-text  ">Is studying?</label><span class="text-danger">( * )</span>
                                        <select class="form-select shadow-none rounded-0 @error('is_studying') is-invalid @enderror" name="is_studying" id="is_studying">
                                            <option {{ old('is_studying') == "Yes" ? 'selected' : '' }}>Yes</option>
                                            <option {{ old('is_studying') == "No" ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('is_studying')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label for="education" class="form-label admin-card-text  ">Educational Attainment</label><span class="text-danger">( * )</span>
                                        <select class="form-select shadow-none rounded-0 @error('education') is-invalid @enderror" name="education" id="education">
                                            <option {{ old('education') == "No grade completed" ? 'selected' : '' }}>No grade completed</option>
                                            <option {{ old('education') == "Elementary undergraduate" ? 'selected' : '' }}>Elementary undergraduate</option>
                                            <option {{ old('education') == "Elementary graduate" ? 'selected' : '' }}>Elementary graduate</option>
                                            <option {{ old('education') == "High school undergraduate" ? 'selected' : '' }}>High school undergraduate</option>
                                            <option {{ old('education') == "High school graduate" ? 'selected' : '' }}>High school graduate</option>
                                            <option {{ old('education') == "Post secondary undergraduate" ? 'selected' : '' }}>Post secondary undergraduate</option>
                                            <option {{ old('education') == "Post secondary graduate" ? 'selected' : '' }}>Post secondary graduate</option>
                                            <option {{ old('education') == "College undergraduate" ? 'selected' : '' }}>College undergraduate</option>
                                            <option {{ old('education') == "College graduate" ? 'selected' : '' }}>College graduate</option>
                                            <option {{ old('education') == "Post baccalaureate" ? 'selected' : '' }}>Post baccalaureate</option>
                                        </select>
                                        @error('education')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-4">
                                        <label for="institution" class="form-label admin-card-text">Institution</label>
                                        <input type="text" class="form-control shadow-none rounded-0 @error('institution') is-invalid @enderror" name="institution" id="institution" value={{old('institution')}}></input>
                                        @error('institution')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label for="graduate_year" class="form-label admin-card-text ">Year of Graduation</label>
                                        <input type="month" class="form-control shadow-none rounded-0 @error('graduate_year') is-invalid @enderror" name="graduate_year" id="graduate_year" value={{old('graduate_year')}}></input>
                                        @error('graduate_year')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="specialization" class="form-label admin-card-text ">Specialization</label>
                                        <input type="text" class="form-control shadow-none rounded-0 @error('specialization') is-invalid @enderror" name="specialization" id="specialization" value={{old('specialization')}}></input>
                                        @error('specialization')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <span class="mt-2 text-secondary text-uppercase  " style="font-size:12px">IV. Employment Status</span>
                                <p class="admin-card-text">Some information regarding income and employment status of the resident</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-4 mb-3">
                                        <label for="is_studying" class="form-label admin-card-text  ">Is employed?</label><span class="text-danger">( * )</span>
                                        <select class="form-select shadow-none rounded-0 @error('is_employed') is-invalid @enderror" name="is_employed" id="is_employed">
                                            <option {{ old('is_employed') == "Yes" ? 'selected' : '' }}>Yes</option>
                                            <option {{ old('is_employed') == "No" ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('is_employed')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <label for="job_title" class="admin-card-text form-label">Job title classification</label>
                                        <input class="form-control shadow-none rounded-0 @error('job_title') is-invalid @enderror" list="datalistOptions" id="job_title" name="job_title" placeholder="Type to search...">
                                        <datalist id="datalistOptions">
                                            <option value="Manual Laborer">
                                            <option value="Doctor/Lawyer/Professionals">
                                            <option value="Government employee">
                                            <option value="Private employee">
                                            <option value="Pro-driver">
                                            <option value="Non pro-driver">
                                            <option value="Househelper">
                                            <option value="Lending">
                                            <option value="Vendor/Sales worker">
                                            <option value="Skilled agricultural forestry and fishery workers">
                                            <option value="Others">
                                        </datalist>
                                        @error('job_title')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                        <small class="text-muted">
                                            Leave blank if the resident is unemployed
                                        </small>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="income" class="form-label admin-card-text">Income</label>
                                        <input type="number" class="form-control shadow-none rounded-0 @error('income') is-invalid @enderror" name="income" id="income" value={{old('income')}}></input>
                                        @error('income')
                                        <small class="text-danger">
                                            {{$message}}
                                        </small>
                                        @enderror
                                </div>
                                <button type="submit" class="btn btn-dark btn-modern float-end shadow-none" onclick="return confirm('Save this resident data?')">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.server_test')
@section('title', 'Good Moral')
@section('content')
<section class="mt-3 mb-5">
    <a class="btn btn-light mb-3" href="{{route('certificates.forms')}}"><i class=" fa-solid fa-angles-left"></i> Forms</a>

    <div class="row">
        <div class="col-sm-7">
            <div class="card shadow-sm rounded-0 border-white">
                <div class="card-body">
                    @if($errors->any())
                    <div class="bg-light">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-danger">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @include('includes.form-header')
                    <h4 class="mt-5 text-center fw-bold tnr text-uppercase">Certificate of Good Moral Character</h4>
                    <div class="container mt-5">
                        <form action="{{route('pdf.goodmoral')}}" method="post">
                            @csrf
                            <span class="p-form"> &emsp; &emsp;This is to certify that, <input class="@error('resident_id') error-form @enderror" list="datalistOptions" id="resident_id" name="resident_id" placeholder="Select resident">
                                <datalist id="datalistOptions">
                                    @foreach($residents as $resident)
                                    <option value="{{$resident->id}}">
                                        {{ ($resident->sex === "Male")? "Mr." : "Ms." }} {{$resident->given_name}} {{$resident->surname}} 
                                    </option>
                                    @endforeach
                                </datalist> is a resident of this Barangay.</span>
                            <p class="p-form">&emsp; &emsp; He/she is of good moral character and has no derogatory record on file in this Barangay.</p>
                            <p class="p-form">&emsp; &emsp; This certification is being issued for
                                <input type="text" id="purpose" name="purpose" placeholder="Purpose" class="@error('purpose') error-form @enderror">

                                requirement.
                            </p>

                            <p class="p-form">&emsp; &emsp; Issued this {{now()->isoFormat('Do \of MMM YYYY');}}, City of Manila</p>
                            <div class="float-end mt-5">
                                <p class="fw-bold p-form text-uppercase"><input type="text" name="punong_barangay" id="punong_barangay" class="@error('punong_barangay') error-form @enderror"></p>
                                <p class="p-form">Punong Barangay</p>
                                <p class="text-small text-muted">(not valid without seal)</p>
                            </div>

                    </div>
                </div>
            </div>
            <button type="submit" class="mt-3 btn btn-dark btn-modern"><i class="fa-solid fa-print"></i> Print Good Moral Form</button>
            </form>
        </div>
        <div class="col-sm-5">
            <div class="card shadow-sm rounded-0 border-white">
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed admin-card-text shadow-none bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    How to print Good Moral form?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ol class="admin-card-text">
                                        <li>Bona fide residents of Barangay 386 can be selected in the dropdown menu. His/her address is also generated accordingly.</li>
                                        <!-- <li>Under specific circumstances, the resident's name and address can also be typewritten.</li>
                                        <li>Follow the format <em>Mr/Ms. Firstname Surname at House number, Street, Quiapo, Manila</em>
                                            <br>
                                            <strong>eg.</strong> Mr. Juan Cruz at 21 Castillejos Street, Quiapo, Manila
                                        </li> -->
                                        <li>Enter the name of the requester.</li>
                                        <li>Enter the purpose of the certification.</li>
                                        <li>Enter the name of the punong barangay.</li>
                                        <li>Click the <button class="btn btn-dark btn-modern btn-sm"><i class="fa-solid fa-print"></i> Print Good Moral Form</button> button.</li>
                                        <li>The form will be downloaded to the computer and is ready to be printed.</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
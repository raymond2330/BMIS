@extends('layouts.server_test')
@section('title', 'Certification of Legal Guardian')
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
                    <h4 class="mt-5 text-center fw-bold tnr text-uppercase">Certification of Legal Guardian</h4>
                    <div class="container mt-5">
                        <form action="{{route('pdf.legalGuardian')}}" method="post">
                            @csrf
                            <span class="p-form"> &emsp; &emsp;To the best knowledge of this Barangay, <input class="@error('guardian_id') error-form @enderror" list="guardianOptions" id="guardian_id" name="guardian_id" placeholder="Select the guardian">
                                <datalist id="guardianOptions">
                                    @foreach($residents as $resident)
                                    <option value="{{$resident->id}}">
                                        {{ ($resident->sex === "Male")? "Mr." : "Ms." }} {{$resident->given_name}} {{$resident->surname}}
                                    </option>
                                    @endforeach
                                </datalist> is the
                                <select id="type" name="type" class="@error('type') error-form @enderror">
                                    <option value="">Select type of relationship</option>
                                    <option>mother</option>
                                    <option>father</option>
                                    <option>legal guardian</option>
                                </select>
                                of <input class="@error('ward_id') error-form @enderror" list="wardOptions" id="ward_id" name="ward_id" placeholder="Select the ward">
                                <datalist id="wardOptions">
                                    @foreach($residents as $resident)
                                    <option value="{{$resident->id}}">
                                        {{$resident->given_name}} {{$resident->surname}}
                                    </option>
                                    @endforeach
                                </datalist> residing at same address of this Barangay. </span>
                            <p class="p-form">&emsp; &emsp; This certification is being issued for whatever legal purpose it may serve.
                            </p>
                            <p class="p-form">&emsp; &emsp; Issued this {{now()->isoFormat('Do \of MMM YYYY');}} in Manila, Philippines.</p>
                            <div class="float-end mt-5">
                                <p class="fw-bold p-form text-uppercase"><input type="text" name="punong_barangay" id="punong_barangay" class="@error('punong_barangay') error-form @enderror"></p>
                                <p class="p-form">Punong Barangay</p>
                                <p class="text-small text-muted">(not valid without seal)</p>
                            </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="mt-3 btn btn-dark btn-modern"><i class="fa-solid fa-print"></i> Print Legal Guardian Form</button>
            </form>
        </div>
        <div class="col-sm-5">
            <div class="card shadow-sm rounded-0 border-white">
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed admin-card-text shadow-none bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    How to print Certification of Legal Guardian form?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ol class="admin-card-text">
                                        <li>Select the name of the guardian in the dropdown menu. His/her address is also generated accordingly.</li>
                                        <!-- <li>Under specific circumstances, the guardian's name and address can also be typewritten.</li>
                                        <li>Follow the format <em>Mr/Ms. Firstname Surname at House number, Street, Quiapo, Manila</em>
                                            <br>
                                            <strong>eg.</strong> Mr. Juan Cruz at 21 Castillejos Street, Quiapo, Manila
                                        </li> -->
                                        <li>Select the relationship of the guardian to the ward.</li>
                                        <li>Select or type the name of the ward.</li>
                                        <li>Enter the name of the punong barangay.</li>
                                        <li>Click the <button class="btn btn-dark btn-modern btn-sm"><i class="fa-solid fa-print"></i> Print Legal Guardian Form</button> button.</li>
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
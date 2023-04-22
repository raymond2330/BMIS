@extends('layouts.server_test')
@section('title', 'Edit Household Data')
@section('content')
<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Household updated successfully',
            footer: '<a href="{{route("streets.households", $household->street_id)}}">Return to households list</a>'
        })
    </script>
    @else
    @endif
    <div class="row">
        <div class="col-sm-9">
            <div class="card shadow-sm rounded-4 border-white">
                <div class="card-body">
                    <a href="{{route('households.residents', $household->id)}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Back</a>
                    <h4 class="card-title">Edit #{{$household->edifice_number}} {{App\Http\Controllers\StreetController::street_name($household->street_id)}} St. </h4>
                    <p class="card-text">Modify household information by selecting the appropriate data</p>
                    <hr>
                    <form action="{{route('households.update',$household->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="street_id" id="street_id" value="{{Crypt::encryptString($household->street_id)}}">
                        <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:12px">Address</span>
                        <div class="mb-3">
                            <label for="title" class="form-label">House number</label>
                            <input type="text" class="form-control shadow-none rounded-0 @error('edifice_number') is-invalid @enderror" name="edifice_number" id="edifice_number" placeholder="House or building number" value="{{$household->edifice_number}}"></input>
                            @error('edifice_number')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:12px">Household Profile</span>
                        <div class="mb-3">
                            <label for="waste_management" class="admin-card-text form-label">Waste Management </label>
                            <select class="form-select shadow-none rounded-0 @error('waste_management') is-invalid @enderror" name="waste_management" id="waste_management">
                                <option {{ $household->waste_management == "Incineration" ? 'selected' : '' }}>Incineration</option>
                                <option {{ $household->waste_management == "Composting" ? 'selected' : '' }}>Composting</option>
                                <option {{ $household->waste_management == "Recycled" ? 'selected' : '' }}>Recycled</option>
                                <option {{ $household->waste_management == "Others" ? 'selected' : '' }}>Others</option>
                            </select>
                            @error('waste_management')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="toilet" class="form-label admin-card-text  ">Toilet Facility </label>
                            <select class="form-select shadow-none rounded-0 @error('toilet') is-invalid @enderror" name="toilet" id="toilet">
                                <option {{ $household->toilet == "Pail type" ? 'selected' : '' }}>Pail type</option>
                                <option {{ $household->toilet == "Water-sealed/Flushed" ? 'selected' : '' }}>Water-sealed/Flushed</option>
                                <option {{ $household->toilet == "Others" ? 'selected' : '' }}>Others</option>
                                <option {{ $household->toilet == "No toilet facility" ? 'selected' : '' }}>No toilet facility</option>
                            </select>
                            @error('toilet')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="dwelling_type" class="form-label admin-card-text  ">Type of Dwelling </label>
                            <select class="form-select shadow-none rounded-0 @error('dwelling_type') is-invalid @enderror" name="dwelling_type" id="dwelling_type">
                                <option {{ $household->dwelling_type == "Concrete" ? 'selected' : '' }}>Concrete</option>
                                <option {{ $household->dwelling_type == "Semi-concrete" ? 'selected' : '' }}>Semi-concrete</option>
                                <option {{ $household->dwelling_type == "Log/Wood" ? 'selected' : '' }}>Log/Wood</option>
                                <option {{ $household->dwelling_type == "Others" ? 'selected' : '' }}>Others</option>
                            </select>
                            @error('dwelling_type')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ownership" class="form-label admin-card-text">Type of ownership</label>
                            <select class="form-select shadow-none rounded-0 @error('ownership') is-invalid @enderror" name="ownership" id="ownership">
                                <option {{ $household->ownership == "Rented" ? 'selected' : '' }}>Rented</option>
                                <option {{ $household->ownership == "Owned" ? 'selected' : '' }}>Owned</option>
                                <option {{ $household->ownership == "Shared with owner" ? 'selected' : '' }}>Shared with owner</option>
                                <option {{ $household->ownership == "Shared with renter" ? 'selected' : '' }}>Shared with renter</option>
                                <option {{ $household->ownership == "Informal settler" ? 'selected' : '' }}>Informal settler</option>
                            </select>
                            @error('ownership')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark btn-modern float-end shadow-none" onclick="return confirm('Save changes on this household data?')">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
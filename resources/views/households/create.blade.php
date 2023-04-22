@extends('layouts.server_test')
@section('title', 'Add a new household')
@section('content')
<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Household created successfully',
            footer: '<a href="{{route("streets.households", $street->id)}}">Return to households list</a>'
        })
    </script>
    @else
    @endif
    <div class="row">
        <div class="col-sm-9">
            <div class="card shadow-sm rounded-4 border-white">
                <div class="card-body">
                    <a href="{{route('streets.households' , $street->id)}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Households</a>
                    <h4 class="card-title">Add a new household in {{$street->street}} Street</h4>
                    <p class="admin-card-text">This is the form for inputting general information about a household</p>
                    <hr>
                    <form action="{{route('households.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="street_id" id="street_id" value="{{Crypt::encryptString($id)}}">
                        <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:12px">Address</span>
                        <div class="mb-3">
                            <label for="title" class="admin-card-text form-label">House number</label>
                            <input type="text" class="form-control shadow-none rounded-0 @error('edifice_number') is-invalid @enderror" name="edifice_number" id="edifice_number" placeholder="House or building number"></input>
                            @error('edifice_number')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <span class="mt-2 text-secondary text-uppercase fw-bold" style="font-size:12px">Household Profile</span>
                        <div class="mb-3">
                            <label for="waste_management" class="form-label admin-card-text  ">Waste Management </label>
                            <select class="form-select shadow-none rounded-0 @error('waste_management') is-invalid @enderror" name="waste_management" id="waste_management">
                                <option {{ old('waste_management') == "Incineration" ? 'selected' : '' }}>Incineration</option>
                                <option {{ old('waste_management') == "Composting" ? 'selected' : '' }}>Composting</option>
                                <option {{ old('waste_management') == "Recycled" ? 'selected' : '' }}>Recycled</option>
                                <option {{ old('waste_management') == "Others" ? 'selected' : '' }}>Others</option>
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
                                <option {{ old('toilet') == "Pail type" ? 'selected' : '' }}>Pail type</option>
                                <option {{ old('toilet') == "Water-sealed/Flushed" ? 'selected' : '' }}>Water-sealed/Flushed</option>
                                <option {{ old('toilet') == "Others" ? 'selected' : '' }}>Others</option>
                                <option {{ old('toilet') == "No toilet facility" ? 'selected' : '' }}>No toilet facility</option>
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
                                <option {{ old('dwelling_type') == "Concrete" ? 'selected' : '' }}>Concrete</option>
                                <option {{ old('dwelling_type') == "Semi-concrete" ? 'selected' : '' }}>Semi-concrete</option>
                                <option {{ old('dwelling_type') == "Log/Wood" ? 'selected' : '' }}>Log/Wood</option>
                                <option {{ old('dwelling_type') == "Others" ? 'selected' : '' }}>Others</option>
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
                                <option {{ old('ownership') == "Rented" ? 'selected' : '' }}>Rented</option>
                                <option {{ old('ownership') == "Owned" ? 'selected' : '' }}>Owned</option>
                                <option {{ old('ownership') == "Shared with owner" ? 'selected' : '' }}>Shared with owner</option>
                                <option {{ old('ownership') == "Shared with renter" ? 'selected' : '' }}>Shared with renter</option>
                                <option {{ old('ownership') == "Informal settler" ? 'selected' : '' }}>Informal settler</option>
                            </select>
                            @error('ownership')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark btn-modern float-end shadow-none" onclick="return confirm('Save household data?')">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
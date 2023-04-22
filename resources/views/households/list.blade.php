@extends('layouts.server_test')
@section('title', 'Households')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('deleted'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Household profile deleted successfully',
        })
    </script>
    @else
    @endif

    <div class="d-flex mb-3">
        <div class="me-auto p-2">
            <h4 class="">
                ({{$households->count()}}) Households
            </h4>
        </div>

        <div class="p-2">
            <div id="outside">

            </div>
        </div>
    </div>

    <div class="table-responsive">

        <table class="table table-bordered shadow-sm bg-white caption-top admin-card-text rounded-3 overflow-hidden" id="householdTable">
            <thead class="bg-modern text-light">
                <tr>
                    <th></th>
                    <th scope="col">House number</th>
                    <th scope="col">Street</th>
                    <th scope="col">Ownership</th>
                    <th scope="col">Number of Families</th>
                    <th scope="col">Household Size</th>
                    <th scope="col">Total Household Income</th>
                    <th scope="col">Income Classification</th>
                    <th scope="col">Waste Management</th>
                    <th scope="col">Toilet Facility</th>
                    <th scope="col">Dwelling Type</th>
                    <th scope="col">Last Updated</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach($households as $key => $household)

                <tr>
                    <td>
                        <img class="" src="https://savannahquarters.com/wp-content/uploads/2020/12/placeholder-home.png" alt="{{$household->full_address}}" height=50>
                    </td>
                    <td data-order="{{$household->edifice_number}}"> {{$household->edifice_number}}</td>
                    <td> {{$household->street->street}}</td>
                    <td>{{$household->ownership}}</td>
                    <td data-order="{{$household->number_family}}">{{$household->number_family}} families</td>
                    <td data-order="{{$household->household_size}}">{{$household->household_size}} residents</td>
                    <td data-order="{{$household->income}}">P {{$household->income}}</td>
                    <td>
                        @if($household->income_classification == 'Poor')
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

                    </td>
                    <td>{{$household->waste_management}}</td>
                    <td>{{$household->toilet}}</td>
                    <td>{{$household->dwelling_type}}</td>



                    <td>
                        {{$household->updated_at}} ({{ \Carbon\Carbon::parse($household->updated_at)->diffForHumans()}})
                    </td>

                    <td>
                        <a class="btn btn-sm btn-light" href="{{route('households.residents', $household->id)}}">View </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>





</section>

@endsection
@extends('layouts.server_test')
@section('title', 'Women')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('created'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'User created successfully',
        })
    </script>
    @elseif(session()->has('deleted'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'User deleted',
        })
    </script>
    @elseif(session()->has('failed'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Invalid password',
        })
    </script>
    @endif
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <h4 class="card-title">
                ({{ $women->count() }}) Women
            </h4>
        </div>
        <div class="p-2 bd-highlight">

        </div>
        <div class="p-2">
            <div id="outside">

            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="womenTable">
            <caption> <a class="btn btn-light btn-sm" href="{{route('dashboard')}}"> <i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <a href="{{route('residents.index')}}" class="text-secondary float-end"> <i class="fa-solid fa-table-cells"></i> Show Resident Masterlist</a>
            </caption>
            <thead class="bg-modern text-white">
                <tr>
                    <th></th>
                    <th>Address</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Age group</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($women as $woman)
                <tr>
                    <td>
                        @if($woman->sex=="Male")
                        <img src="https://thumbs.dreamstime.com/b/person-gray-photo-placeholder-man-t-shirt-white-background-147541161.jpg" class="rounded-start" alt="..." height=40>
                        @else
                        <img src="https://st4.depositphotos.com/9998432/27431/v/600/depositphotos_274313380-stock-illustration-person-gray-photo-placeholder-woman.jpg" class="rounded-start" alt="..." height=40>
                        @endif
                    </td>
                    <td> {{$woman->household_id}} {{App\Http\Controllers\StreetController::street_name($woman->household->street_id)}} St. </td>
                    <td> {{$woman->surname}}, {{$woman->given_name}}</td>
                    <td data-order="{{$woman->age}}">
                        {{$woman->age}}
                    </td>
                    <td>
                        @if($woman->age < 1) <span class="ms-2 badge rounded-pill fw-normal" style="background-color:#08306b">Infant</span>
                            @elseif($woman->age >= 1 && $woman->age <= 17) <span class="ms-2 badge rounded-pill fw-normal" style="background-color:#08519c">Child</span>
                                @elseif($woman->age >= 18 && $woman->age <= 59) <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">Adult</span>
                                    @elseif($woman->age >= 60)
                                    <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Senior</span>
                                    @endif
                    </td>
                    <td><a class="btn btn-sm btn-light" href="{{route('residents.view',$woman->id)}}">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
@endsection
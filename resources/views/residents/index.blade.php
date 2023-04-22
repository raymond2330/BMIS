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
            <div id="outside">

            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-sm shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="residentTable">
            @if(Auth::user()->user_type == 0)
            <caption>
                <a href="{{route('residents.simplified')}}" class="text-secondary float-end"> <i class="fa-solid fa-table-cells"></i> Show simplified view</a>
            </caption>
            @endif
            <thead class="bg-modern text-light">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Status</th>
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
                    <td><span class="text-uppercase"> {{$resident->surname}}, {{$resident->given_name}}</span></td>
                    <td>
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
                    </td>
                    <td>{{$resident->age}}</td>
                    <td>{{$resident->contact}}</td>
                    <td>{{$resident->household_id}} {{App\Http\Controllers\StreetController::street_name($resident->household->street_id)}} St.</td>
                    <td>{{$resident->updated_at}} ({{ \Carbon\Carbon::parse($resident->updated_at)->diffForHumans()}})</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-dark btn-modern dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Show
                            </button>
                            <ul class="dropdown-menu border-light shadow-sm">
                                <li><a class="dropdown-item" href="/residents/view/{{$resident->id}}"><i class="fa-solid fa-user"></i> View Resident Information</a></li>
                                <li><a class="dropdown-item" href="/residents/edit/{{$resident->id}}"><i class="fa-regular fa-pen-to-square"></i> Edit</a></li>
                                @if(Auth::user()->user_type == 0)
                                <li><a class="dropdown-item" href="/residents/archive/{{$resident->id}}" onclick="return confirm('Archive resident data?')"><i class="fa-solid fa-box-archive text-danger"></i> Archive</a></li>
                                @endif
                            </ul>
                        </div>


                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

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
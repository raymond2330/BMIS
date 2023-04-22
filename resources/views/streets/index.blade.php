@extends('layouts.server_test')
@section('title', 'Streets')
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
                ({{$streets->count()}}) Streets in Barangay 385
            </h4>
        </div>

        <div class="p-2">

        </div>
    </div>
    <div class="row">
        {{$streets->appends(['search'=>request()->query('search')])->links() }}
        @foreach($streets as $key => $street)
        <div class="col-sm-3">
            <div class="card text-center border-white shadow-sm mb-3" style="min-height:12.5rem; border-radius:15px;">
                <div class="overlay_container">
                    <a href="{{route('streets.households', $street->id)}}"><img class="card-img-top blur" src="{{asset('img/streets')}}/{{$street->street_image}}" alt="{{$street->street}} Street"></a>
                    <div class="overlay">
                        <div class="text"><a class="text-light text-decoration-none" href="{{route('streets.households', $street->id)}}">
                                {{$street->household_count}} households </a> </div>
                    </div>
                </div>
                <div class="card-body">
                    <br>
                    <p class="admin-card-text">{{$street->street}}</p>
                    <div class="accordion accordion-flush" id="accordionFlushExample{{$key}}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne{{$key}}">
                                <button class="accordion-button collapsed shadow-none bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$key}}" aria-expanded="false" aria-controls="flush-collapseOne{{$key}}">
                                </button>
                            </h2>
                            <div id="flush-collapseOne{{$key}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne{{$key}}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush text-start">
                                        <li class="list-group-item"><a class="text-decoration-none" href="{{route('households.create', $street->id)}}" style="color: #414b62; font-family: 'Roboto', sans-serif;"><i class="fa-solid fa-house-chimney-medical me-3 "></i> Add a new household</a></li>
                                        <li class="list-group-item"><a class="text-decoration-none" href="{{route('streets.households', $street->id)}}" style="color: #353c4e; font-family: 'Roboto', sans-serif;"><i class="fa-solid fa-house-circle-check me-3 "></i> View households</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$streets->appends(['search'=>request()->query('search')])->links() }}


</section>

@endsection
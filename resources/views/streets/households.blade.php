@extends('layouts.server_test')
@section('title',"Households")
@section('content')
<section class="mt-3 mb-5">
    <div class="d-flex mb-3">
        <div class="me-auto p-2">
            <h4 class="">
                ({{$households->total()}}) Households in {{App\Http\Controllers\StreetController::street_name($id)}} St.
            </h4>
            <a class="mt-3 btn btn-light" href="/streets/index"><i class="fa-solid fa-angles-left"></i> Streets</a>
        </div>

        <div class="p-2"> <a href="{{route('households.create', $id)}}" class="btn btn-dark btn-modern"><i class="fa-solid fa-house-chimney-medical"></i> Add a new household</a></div>
        <div class="p-2">
            <form action="{{route('streets.households', $id)}}" method="get">
                @csrf
                <div class="input-group">
                    <span class="input-group-text border-0 bg-white"><a href="{{route('streets.households', $id)}}"><i class="fa-solid fa-arrows-rotate text-dark"></i></a></span>
                    <input type="text" class="form-control rounded-0 shadow-none border-0" name="search" id="search" placeholder="Search for house number...">
                </div>
            </form>
        </div>
    </div>
    <div class="row">

        @foreach($households as $household)
        <div class="col-sm-3 mb-3">
            <div class="card border-white shadow-sm mb-3" style="min-height:12.5rem; border-radius:15px;">
                <div class="overlay_container">
                    <a href="{{route('households.edit', $household->id)}}"><img class="card-img-top" src="https://savannahquarters.com/wp-content/uploads/2020/12/placeholder-home.png" alt="{{$household->full_address}}"></a>
                    <div class="overlay">
                        <div class="text"><a class="text-light text-decoration-none" href="{{route('households.residents',$household->id)}}"> {{$household->household_size}} residents</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <span class="float-end small text-muted">Household ID: #{{$household->id}}</span>
                    <br>
                    <p class="admin-card-text text-center mt-2">#{{$household->edifice_number}} {{App\Http\Controllers\StreetController::street_name($id)}}</p>
                    <div class="accordion accordion-flush" id="accordionFlushExample{{$household->id}}">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne{{$household->id}}">
                                <button class="accordion-button collapsed shadow-none bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$household->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$household->id}}">
                                </button>
                            </h2>
                            <div id="flush-collapseOne{{$household->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne{{$household->id}}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush text-start">
                                        <li class="list-group-item"> <a style="color: #414b62; font-family: 'Roboto', sans-serif;" class="text-decoration-none" href="{{route('residents.create', $household->id)}}"><i class="fa-solid fa-user-plus"></i> Add a resident</a> </li>
                                        <li class="list-group-item"> <a style="color: #414b62; font-family: 'Roboto', sans-serif;" class="text-decoration-none" href="{{route('households.residents',$household->id)}}"><i class="fa-solid fa-users-viewfinder"></i> Household Information</a></li>
                                        <li class="list-group-item"> <a style="color: #414b62; font-family: 'Roboto', sans-serif;" class="text-decoration-none" href="{{route('households.edit', $household->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit household</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{$households->appends(['search'=>request()->query('search')])->links() }}
    </div>


</section>
@endsection
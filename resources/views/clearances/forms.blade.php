@extends('layouts.server_test')
@section('title', 'Forms')
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


    <div class="row">
        <div class="col-sm-6">
            <div class="card shadow rounded-4 border-white">
                <div class="card-body">
                    <h4 class="admin-card-text">Forms</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="{{route('certificates.indigency')}}"> Indigency</a></li>
                        <li class="list-group-item"><a href="{{route('certificates.certification')}}"> Certification</a></li>
                        <li class="list-group-item"><a href="{{route('certificates.legal_guardian')}}"> Legal Guardian</a></li>
                        <li class="list-group-item"><a href="{{route('certificates.goodmoral')}}"> Good Moral</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>







</section>
@endsection
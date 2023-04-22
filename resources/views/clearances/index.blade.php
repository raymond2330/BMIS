@extends('layouts.server_test')
@section('title', 'Form Log')
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
                ({{ $forms->count() }}) Form Log
            </h4>
        </div>
        <div class="p-2 bd-highlight">

        </div>
        <div class="p-2">

        </div>
    </div>
    <div class="table-responsive">
        <table id="formTable" class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%">
            <thead class="bg-modern text-white">
                <tr>
                    <th>Type of Form</th>
                    <th>Requester</th>
                    <th>Requested At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $form)
                <tr>
                    <td>
                        {{$form->form}}
                    </td>
                    <td>{{$form->requester}} </td>

                    <td>{{$form->created_at}} ({{ \Carbon\Carbon::parse($form->created_at)->diffForHumans()}}) </td>


                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</section>



@endsection
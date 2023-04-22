@extends('layouts.server_test')
@section('title', 'System Users')
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
                ({{ $users->count() }}) System Users
            </h4>
        </div>
        <div class="p-2 bd-highlight">
        </div>
        <div class="p-2">
            <a href="{{route('users.create')}}" class="btn btn-dark btn-modern mb-3 float-end"><i class="fa-solid fa-plus"></i> Create a user</a>
        </div>
    </div>
    <a type="button" class="text-secondary fw-bold mb-2" style="font-size:14px" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Roles
    </a>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:14px;">Roles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>
                            <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Master</span> has complete access to the functions of the system.
                        </li>
                        <li>
                            <span class="badge rounded-pill fw-normal" style="background-color:#08519c">Profiling</span> are accounts that are in charge of household and resident profiling
                        </li>
                        <li>
                            <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">E-journalist</span> can manage website content such as links, videos, and announcements
                        </li>
                        <li>
                            <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Forms</span> can issue certificates and forms requested by the residents
                        </li>
                    </ul>
                    <button type="button" class="btn btn-sm btn-light float-end" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="userTable">

            <thead class="bg-modern text-white">
                <tr>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Two-factor authentication</th>

                    <th>Created at</th>
                    <th>Last updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($users as $user)
                <tr>
                    <td>
                        @if($user->user_type == 0)
                        <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Master</span>
                        @elseif($user->user_type == 1)
                        <span class="badge rounded-pill fw-normal" style="background-color:#08519c">Profiling</span>
                        @elseif($user->user_type == 2)
                        <span class="badge rounded-pill fw-normal" style="background-color:#2171b5">E-journalist</span>
                        @elseif($user->user_type == 3)
                        <span class="badge rounded-pill fw-normal" style="background-color:#4292c6">Forms</span>
                        @endif
                    </td>
                    <td>{{$user->name}} </td>
                    <td>{{$user->email}} </td>
                    <td> @if ($user->two_factor_confirmed_at != NULL) <span class="badge rounded-pill fw-normal" style="background-color:green">Confirmed</span> @else <span class="badge rounded-pill fw-normal" style="background-color:RED">Unconfirmed</span> @endif </td>

                    <td>{{$user->created_at}} ({{ \Carbon\Carbon::parse($user->created_at)->diffForHumans()}})</td>
                    <td>{{$user->updated_at}} ({{ \Carbon\Carbon::parse($user->updated_at)->diffForHumans()}})</td>
                    <td>
                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-light mb-2 me-2">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        <!-- <a href="{{route('users.destroy',$user->id)}}" class="btn btn-sm btn-danger mb-2 me-2" onclick="return confirm('Are you sure you want to delete this user?')">
                            Delete
                        </a> -->
                        <button type="button" class="btn btn-sm btn-danger mb-2 me-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}">
                            Delete
                        </button>
                        <!-- Modal -->
                        <div class="modal" id="exampleModal{{$user->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content rounded-4 border-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title fs-5">Delete user</h5>
                                        <button type="button" class="btn-close btn-sm shadow-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-start">

                                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="password" class=" admin-card-text mb-2">We need to verify first that you are the currently logged in
                                                    <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Master</span>
                                                    account. Please enter your password.
                                                </label>
                                                <input type="password" class="form-control shadow-none rounded-0 @error('password') is-invalid @enderror" name="password" id="password" placeholder="" value="{{old('password')}}"></input>
                                                @error('password')
                                                <small class="text-danger">
                                                    {{$message}}
                                                </small>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
 

</section>



@endsection
@extends('layouts.server_test')
@section('title', 'Create a user')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '<span style="font-family:Roboto,sans-serif; font-weight:normal; font-size:0.8em">User created successfully. </span>',
            html: '<b>Important:</b> Log in the newly created user and enable their two-factor authentication by clicking on their underlined profile setting on the top right.',
            confirmButtonColor: "#414b62",
            iconColor: '#414b62',
            footer: '<a href="/users/index">Return to users list</a>'
        })
    </script>
    @else
    @endif

    <div id='loader'></div>
    <div class="card shadow rounded-4 border-white">
        <div class="card-body">
            <a href="{{route('users.index')}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Users</a>
            <h4 class="card-title">Create a user</h4>
            <p class="admin-card-text">Complete the form and assign a role to a newly created user of the system.</p>
            <a type="button" class="text-secondary fw-bold" style="font-size:14px" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
            <hr>
            <form action="{{route('users.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="user_type" class="admin-card-text   form-label">Role </label>
                    <select class="form-select shadow-none rounded-0 @error('user_type') is-invalid @enderror" name="user_type" id="user_type">
                        <option value="0" {{ old('user_type') == "0" ? 'selected' : '' }}>Master</option>
                        <option value="1" {{ old('user_type') == "1" ? 'selected' : '' }}>Profiling</option>
                        <option value="2" {{ old('user_type') == "2" ? 'selected' : '' }}>E-journalist</option>
                        <option value="3" {{ old('user_type') == "3" ? 'selected' : '' }}>Forms</option>
                    </select>
                    @error('user_type')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class=" admin-card-text">Name</label>
                    <input type="text" class="form-control shadow-none rounded-0 @error('name') is-invalid @enderror" name="name" id="name" placeholder="" value="{{old('name')}}"></input>
                    @error('name')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class=" admin-card-text">Email</label>
                    <input type="email" class="form-control shadow-none rounded-0 @error('email') is-invalid @enderror" name="email" id="email" placeholder="" value="{{old('email')}}"></input>
                    @error('email')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class=" admin-card-text">User's Password</label>
                    <input type="password" class="form-control shadow-none rounded-0 @error('password') is-invalid @enderror" name="password" id="password" placeholder="" value="{{old('password')}}"></input>
                    <small class="text-muted">
                        Password must have at least 8 characters and is a combination of letters, numbers, symbols, lowercase, and uppercase.
                    </small>
                    @error('password')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="admin_password" class=" admin-card-text mb-2"> We need to verify first that you are the currently logged in
                        <span class="badge rounded-pill fw-normal" style="background-color:#08306b">Master</span>
                        account. Please enter your password.</label>
                    <input type="password" class="form-control shadow-none rounded-0 @error('admin_password') is-invalid @enderror" name="admin_password" id="admin_password" placeholder=""></input>
                    @error('admin_password')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark btn-modern float-end shadow-none">Save</button>
            </form>

        </div>
    </div>

</section>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay 386 Information Management System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    @include('includes.head')

</head>

<body class="bg-light">

    <section style="margin-top:100px; margin-bottom:50px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-5">
                    <div class="card shadow border-white mb-5">
                        <div class="card-body">
                            <center>
                                <img src="{{asset('img/logo_385.png')}}" width="200" alt="">
                            </center>
                            <h4 class="admin-card-text text-uppercase text-center fw-bold mt-3">Barangay 386 Information Management System</h4>
                            <p class="admin-card-text mt-5 text-center">Please login your administrative account to access the system</p>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control py-3 shadow-none @error('email') is-invalid @enderror" placeholder="Email" name="email" id="email" value="{{old('email')}}">
                                    @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control py-3 shadow-none  @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password" value="{{old('password')}}">
                                    @error('password')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark btn-modern py-3 text-uppercase">Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




</body>

</html>
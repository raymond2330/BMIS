@extends('layouts.server_test')
@section('title', 'User Manual')
@section('content')

@if(session()->has('unauthorized'))
<script>
    Swal.fire({
        icon: 'error',
        title: '<span style="font-family:Roboto,sans-serif; font-weight:normal; font-size:0.8em">You are not authorized to access that page.</span>',
        confirmButtonColor: "#414b62",
        iconColor: '#414b62',
    })
</script>
@elseif(session()->has('text'))
<script>
    Swal.fire({
        icon: 'info',
        title: '<span style="font-family:Roboto,sans-serif; font-weight:normal; font-size:0.5em"><h5>Personal Data</h5><p>While using Our Information Management System, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to: email, name, and your <strong> usage data.</strong><h5>Usage Data</h5><p>Usage Data is collected automatically when using the Service. Usage Data may include information such as Your Device\'s Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that You visit, the time and date of Your visit, the time spent on those pages, unique device identifiers and other diagnostic data.</p> <h5>Purpose of your Usage Data</h5><p>The management may analyze your Usage Data for the following purposes: <strong>To provide and maintain our Information System,</strong> including to monitor the usage of our system. <strong>To contact you:</strong> regarding updates, or informative communications related to the functionalities, including security updates, when necessary or reasonable for the implementation, and <strong>For security purposes:</strong> to identify database transactions and for the purpose of non-repudiation. </p> </span>',
        confirmButtonColor: "#414b62",
        iconColor: '#414b62',
    })
</script>
@endif

<section class="mt-3 mb-5">
    <div class="container-fluid">
        @if(Auth::user()->user_type == 1)
        <h2 style="color:#414b62;"> How do I perform Household Profiling? </h2>
        @elseif(Auth::user()->user_type == 2)
        <h2 style="color:#414b62;"> How do I publish Announcements? </h2>
        @elseif(Auth::user()->user_type == 3)
        <h2 style="color:#414b62;"> How do I generate Forms or Certificates? </h2>
        @elseif(Auth::user()->user_type == 0)
        <h2 style="color:#414b62;"> How do I manage User Accounts ? </h2>
        @endif
        <div class="row">
            @if(Auth::user()->user_type == 1)
            <div class="col-sm-12 mt-4 mb-5">
                <img src="{{asset('img/manual/15.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/16.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/17.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/18.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/19.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/20.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/21.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/22.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/23.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/24.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/25.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/26.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/27.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/28.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            @elseif(Auth::user()->user_type == 2)
            <div class="col-sm-12 mt-4 mb-5">
                <img src="{{asset('img/manual/29.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/30.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/31.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/32.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            @elseif(Auth::user()->user_type == 3)
            <div class="col-sm-12 mt-4 mb-5">
                <img src="{{asset('img/manual/9.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/10.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/11.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/12.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/13.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/14.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            @elseif(Auth::user()->user_type == 0)
            <div class="col-sm-12 mt-4 mb-5">
                <img src="{{asset('img/manual/1.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/2.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/3.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/4.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/5.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/6.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/7.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/8.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <hr>
            <h2 style="color:#414b62;" class="mt-3"> How do I navigate the Dashboard? </h2>
            <div class="col-sm-12 mt-4 mb-5">
                <img src="{{asset('img/manual/33.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/34.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            <div class="col-sm-12 mb-5">
                <img src="{{asset('img/manual/35.png')}}" class="img-fluid img-thumbnail" width="960" alt="">
            </div>
            @endif
        </div>

    </div>


</section>
@endsection
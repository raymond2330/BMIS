@extends('layouts.master')
@section('title', 'Logo')

@section('content')
<section class="mt-5">
    <h2 class="fw-bold text-center text-uppercase mb-4">
        Our Logo
    </h2>
    <img width="315" class="img-fluid mx-auto d-block" src="{{asset('img/logo-png.png')}}" alt="Logo">
    <p class="paragraph mt-3"> &emsp;&emsp; Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur unde id repellat, modi eius dolor dolores consequuntur? Voluptates voluptatem deleniti minima ad numquam laudantium harum ut dolorem accusamus! Ad aperiam maiores enim, itaque doloremque ratione quibusdam libero ullam officia possimus dolorem aut eaque at mollitia pariatur totam beatae excepturi eligendi.</p>
</section>
@endsection
@extends('layouts.master')
@section('title', 'Home')
@section('content')

<section class="mt-5">
    <!-- announcements -->
    @foreach ($announcements as $announcement )
    <h1 class=" announcement-title text-uppercase fw-bold"> {{$announcement->title}}</h1>
    <p class="text-muted" style="font-size:13px">Published: {{$announcement->created_at->format('j F Y')}}</p>
    {!! Str::limit($announcement->announcement, 500, '...') !!}
    <br>
    <div class="mt-3">
        <a href="{{route('announcements.view', $announcement->id)}}" class="text-dark fw-bold">Read more:&emsp;{{$announcement->title}}</a>
        <hr>
        @endforeach
        <!-- announcements -->
    </div>
    <div>
        {{$announcements->appends(['search'=>request()->query('search')])->links() }}
    </div>
</section>

@endsection
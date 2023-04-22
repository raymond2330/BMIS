@extends('layouts.master')
@section('title', 'Announcement')
@section('content')
<section class="mt-5">
    <h2 class="fw-bold text-left text-uppercase">
        {{$announcement->title}}
    </h2>
    <p class="text-muted" style="font-size:13px">Published: {{$announcement->created_at->format('j F Y')}}</p>
    <hr>
    <p class="paragraph">{!!$announcement->announcement!!}</p>
</section>
@endsection
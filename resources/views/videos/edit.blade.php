@extends('layouts.server_test')
@section('title', 'Edit a featured video')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Featured video updated successfully',
            footer: '<a href="/videos/index">Return to featured videos list</a>'
        })
    </script>
    @else
    @endif
    <div class="card shadow-sm rounded-4 border-white">
        <div class="card-body">
            <a href="{{route('videos.index')}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Featured Videos</a>
            <h4 class="card-title">Edit a featured video</h4>
            <p class="admin-card-text">The featured video entered here will be displayed on the right section of the barangay website.</p>
            <hr>
            <form action="{{route('videos.update', $video->id)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="admin-card-text form-label">Title</label>
                    <input type="text" class="form-control shadow-none rounded-0 @error('title') is-invalid @enderror" value="{{$video->title}}" name="title" id="title" placeholder="The iframe of the video"></input>
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark btn-modern float-end shadow-none">Save changes</button>
            </form>
        </div>
    </div>
</section>
@endsection
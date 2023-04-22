@extends('layouts.server_test')
@section('title', 'Edit an announcement')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Announcement updated successfully',
            footer: '<a href="/announcements/index">Return to announcement list</a>'
        })
    </script>
    @else
    @endif
    <div class="card shadow-sm rounded-4 border-white">
        <div class="card-body">
            <a href="/announcements/index" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Announcements</a>
            <h4 class="card-title">Edit an Announcement</h4>
            <p class="admin-card-text">Use the text editor below to make changes to an announcement.</p>
            <hr>
            <form action="{{route('announcements.update', $announcement->id)}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="admin-card-text form-label">Title</label>
                    <input type="text" value="{{$announcement->title}}" class="form-control shadow-none rounded-0 @error('title') is-invalid @enderror" name="title" id="title" placeholder="The title of the announcement"></input>
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="announcement" class="admin-card-text form-label"></label>
                    <textarea name="announcement" name="announcement" id="announcement">
                    {{$announcement->announcement}}
                    </textarea>
                </div>
                <button type="submit" class="btn btn-dark btn-modern float-end shadow-none">Save changes</button>
            </form>
        </div>
    </div>

</section>
@endsection
@extends('layouts.server_test')
@section('title', 'Create an announcement')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Announcement created successfully',
            footer: '<a href="/announcements/index">Return to announcement list</a>'
        })
    </script>
    @else
    @endif
    <div class="card shadow-sm rounded-4 border-white">
        <div class="card-body">
            <a href="/announcements/index" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Announcements</a>
            <h4 class="card-title">Create an announcement</h4>
            <p class="admin-card-text">Use the text editor below to create an announcement.</p>
            <hr>
            <form action="{{route('announcements.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="admin-card-text form-label">Title</label>
                    <input type="text" class="form-control shadow-none rounded-0 @error('title') is-invalid @enderror" name="title" id="title" placeholder="The title of the announcement" value="{{old('title')}}"></input>
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="announcement" class="admin-card-text form-label"></label>
                    <textarea name="announcement" name="announcement" id="announcement">{{old('announcement')}}</textarea>
                </div>
                <button type="submit" class="btn btn-dark btn-modern float-end shadow-none">Save</button>
            </form>
        </div>
    </div>

</section>
@endsection
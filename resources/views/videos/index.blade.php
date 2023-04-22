@extends('layouts.server_test')
@section('title', 'Featured Videos')
@section('content')
<section class="mt-3 mb-5">
    @if(session()->has('deleted'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Featured video deleted successfully',
        })
    </script>
    @else
    @endif
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <h4 class="card-title">({{$videos_count}}) Featured Videos</h4>
        </div>
        <div class="p-2 bd-highlight"><a href="{{route('videos.create')}}" class="btn btn-dark btn-modern mb-3 float-end"><i class="fa-solid fa-plus"></i> Create a featured video</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-center shadow-sm bg-white caption-top admin-card-text rounded-3 overflow-hidden">
            <thead class="bg-modern text-white">
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($videos as $video)
                <tr>

                    <td>
                        {!! @html_entity_decode($video->title) !!}</td>
                    <td> <a href="{{route('videos.edit', $video->id)}}" class="btn btn-light text-uppercase me-3 mb-3"><i class="fa-solid fa-pen"></i></a>
                        <a href="{{route('videos.destroy', $video->id)}}" class="btn btn-danger text-uppercase me-3 mb-3" onclick="return confirm('Are you sure you want to delete this featured video?')"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<p class="py-1 px-3 bg-light fw-bold text-dark text-uppercase">
    <i class="fa-solid fa-circle-question me-2"></i>These are the featured videos that are currently displayed on the right side of the barangay website.
</p>
@endsection
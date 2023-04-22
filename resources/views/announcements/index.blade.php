@extends('layouts.server_test')
@section('title', 'Announcements')
@section('content')
<section class="mt-3 mb-5">
    @if(session()->has('deleted'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Announcement deleted successfully',
        })
    </script>
    @else
    @endif

    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <h4 class="card-title">({{$announcements->count()}}) Announcements</h4>
        </div>
        <div class="p-2 bd-highlight"><a href="{{route('announcements.create')}}" class="btn btn-dark btn-modern mb-3 float-end"><i class="fa-solid fa-plus"></i> Create an announcement</a>
        </div>
        <div class="p-2 bd-highlight">

        </div>
    </div>
    <div class="table-responsive">
        <table class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="announcementTable">
            <thead class="bg-modern text-light">
                <tr>
                    <th>Title</th>
                    <th>Announcement</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($announcements as $announcement)
                <tr>

                    <td>{{$announcement->title}} </td>
                    <td> {!! Str::limit($announcement->announcement, 200, '...') !!}</td>
                    <td>{{$announcement->updated_at}} ({{ \Carbon\Carbon::parse($announcement->updated_at)->diffForHumans()}})</td>
                    <td> <a href="{{route('announcements.edit', $announcement->id)}}" class="btn btn-light text-uppercase me-3 mb-3"><i class="fa-solid fa-pen"></i></a>
                        <a href="{{route('announcements.destroy', $announcement->id)}}" class="btn btn-danger text-uppercase me-3 mb-3" onclick="return confirm('Are you sure you want to delete this announcement?')"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</section>
<p class="py-1 px-3 bg-light fw-bold text-dark text-uppercase">
    <i class="fa-solid fa-circle-question me-2"></i>These are the announcements that are currently displayed on the center of the barangay website.
</p>
@endsection
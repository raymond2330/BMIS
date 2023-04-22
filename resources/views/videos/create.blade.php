@extends('layouts.server_test')
@section('title', 'Create a featured video')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Featured video created successfully',
            footer: '<a href="/videos/index">Return to featured videos list</a>'
        })
    </script>
    @else
    @endif
    <div class="card shadow-sm rounded-4 border-white">
        <div class="card-body">
            <a href="{{route('videos.index')}}" class="btn btn-light mb-3"><i class="fa-solid fa-angles-left"></i> Featured Videos</a>
            <h4 class="card-title">Create a featured video</h4>
            <p class="admin-card-text">The featured video entered here will be displayed on the right section of the barangay website.</p>

            <!-- Button trigger modal -->
            <a type="button" class="text-secondary fw-bold" style="font-size:14px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Click me: How can I get the <em>iframe</em> of the video?
            </a>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="font-size:14px;">How can I get the <em>iframe</em> of the video?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ol>
                                <li>
                                    Go to <i class="fa-brands fa-youtube me-2 text-danger"></i><a href="https://www.youtube.com/" class="text-danger " target="_blank">youtube.com</a>
                                </li>
                                <li>
                                    Select the video uploaded.
                                </li>
                                <li>
                                    Click on the <i class="fa-solid fa-share me-2"></i>Share icon
                                </li>
                                <li>
                                    Select the <i class="fa-solid fa-code me-2"></i>Embed button
                                </li>
                                <li>Click on the Copy button</li>
                                <li>Paste it in the <em>title</em> field</li>
                                <li>Change the <em>width</em> to "315"</li>

                            </ol>
                            <button type="button" class="btn btn-sm btn-light float-end" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <form action="{{route('videos.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="admin-card-text form-label">Title</label>
                    <input type="text" class="form-control shadow-none rounded-0 @error('title') is-invalid @enderror" name="title" id="title" placeholder="The iframe of the video" value="{{old('title')}}"></input>
                    @error('title')
                    <small class="text-danger">
                        {{$message}}
                    </small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark btn-modern float-end shadow-none">Save</button>
            </form>
        </div>
    </div>
</section>
@endsection
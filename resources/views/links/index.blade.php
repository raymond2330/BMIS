@extends('layouts.server_test')
@section('title', 'Quick Links')
@section('content')

<section class="mt-3 mb-5">
    @if(session()->has('deleted'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Link deleted successfully',
        })
    </script>
    @else
    @endif
    <div class="d-flex bd-highlight mb-3">
        <div class="me-auto p-2 bd-highlight">
            <h4 class="card-title">
                ({{ $links->count() }}) Quick Links
            </h4>
        </div>
        <div class="p-2 bd-highlight"><a href="{{route('links.create')}}" class="btn btn-dark btn-modern mb-3 float-end"><i class="fa-solid fa-plus"></i> Create a quick link</a>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table shadow-sm bg-white caption-top admin-card-text rounded-3" style="width:100%" id="linkTable">
            <thead class="bg-modern text-white">
                <tr>
                    <th>Image</th>
                    <th>Link title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @foreach($links as $link)
                <tr>
                    <td> <img src="{{asset('img')}}/{{$link->image}}" height="75" width="75"></td>
                    <td>{{$link->title}} </td>
                    <td> <a href="{{route('links.edit', $link->id)}}" class="btn btn-light text-uppercase me-3 mb-3"><i class="fa-solid fa-pen"></i></a>
                        <a href="{{route('links.destroy', $link->id)}}" class="btn btn-danger text-uppercase me-3 mb-3" onclick="return confirm('Are you sure you want to delete this link?')"><i class="fa-solid fa-trash-can"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
<p class="py-1 px-3 bg-light fw-bold text-dark text-uppercase">
    <i class="fa-solid fa-circle-question me-2"></i>Note: <em>These are the links that are currently displayed on the left side of the barangay website.</em>
</p>
@endsection
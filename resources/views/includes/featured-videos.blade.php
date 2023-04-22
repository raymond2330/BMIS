<section class="mt-5">
    <h2 class="fw-bold text-center text-uppercase mb-4">Featured Videos</h2>
    @foreach ($videos as $video)
    <div class="mb-3 mx-auto">
        {!! @html_entity_decode($video->title) !!}
    </div>
    @endforeach
</section>
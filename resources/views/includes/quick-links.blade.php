<!-- quick links -->
<section class="mt-5">
    <h2 class="fw-bold text-center text-uppercase mb-4">Quick Links</h2>
    <table class="table text-center table-striped table-inverse table-responsive">
        <tbody>
            @foreach($links as $link)
            <tr>
                <td> <img src="{{asset('img')}}/{{$link->image}}" height="100" width="100"></td>
                <td>
                    <a href="" class="fw-bold text-decoration-none text-uppercase text-info">{{$link->title}}</a>
                    <p> {{$link->subtitle}}</p>
                </td>
            </tr>
            @endforeach

            <!-- <tr>
                <td> <img src="{{asset('/img/charter.jpg')}}" height="100" width="100"></td>
                <td>
                    <a href="" class="fw-bold text-decoration-none text-uppercase text-info">Citizen's Charter </a>
                </td>
            </tr>
            <tr>
                <td> <img src="{{asset('/img/services.jpg')}}" height="100" width="100"></td>
                <td>
                    <a href="" class="fw-bold text-decoration-none text-uppercase text-info">Services </a>
                </td>
            </tr>
            <tr>
                <td> <img src="{{asset('/img/faqs.jpg')}}" height="100" width="100"></td>
                <td>
                    <a href="" class="fw-bold text-decoration-none text-uppercase text-info">Frequently Asked Questions </a>
                    <p> List of questions and answers for your questions</p>
                </td>
            </tr> -->
        </tbody>
    </table>
</section>
<!-- quick links -->
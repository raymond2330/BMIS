<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        th {
            font-weight: 500;
        }
    </style>
</head>

<body class="bg-light">
    <section class="mt-3">
        <div class="container-fluid">
            <a href="{{route('residents.index')}}" class="text-secondary">Back</a>
            <h4 class="mt-3">Residents ({{$residents->total()}})</h4>
            <form action="{{route('residents.simplified')}}" method="get">
                @csrf
                <div class="input-group">
                    <span class="input-group-text border-0 bg-white"><a href="{{route('residents.simplified')}}">Refresh</a></span>
                    <input type="text" class="form-control rounded-0 shadow-none border-0" name="search" id="search" placeholder="Search for address, name, age, sex, birth date, education, income class, job classification">
                </div>
            </form>
            <div class="table-responsive-md">
                <table class="table table-striped table-bordered bg-white mt-3 table-sm">
                    <thead class="bg-warning">
                        <tr>
                            <th>#</th>
                            <th>Address</th>
                            <th>Full Name (LN,FN,MN)</th>
                            <th>Sex</th>
                            <th>Age</th>
                            <th>Birth date</th>
                            <th>Contact</th>
                            <th>Civil Status</th>
                            <th>Nationality</th>
                            <th>Household Head</th>
                            <th>Bona fide</th>
                            <th>6+ months here</th>
                            <th>Is pregnant</th>
                            <th>Solo parent</th>
                            <th>Voter</th>
                            <th>PWD</th>
                            <th>Is studying</th>
                            <th>Education</th>
                            <th>Institution</th>
                            <th>Grad Year</th>
                            <th>Specialization</th>
                            <th>Income</th>
                            <th>Income Classification</th>
                            <th>Is employed</th>
                            <th>Job Classification</th>
                            <th>Created at</th>
                            <th>Last updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $key => $resident)
                        <tr>
                            <td>{{$resident->id}}</td>
                            <td> {{$resident->household_id}} {{App\Http\Controllers\StreetController::street_name($resident->household->street_id)}} St. </td>
                            <td>{{$resident->surname}}, {{$resident->given_name}}, {{$resident->middle_name}}</td>
                            <td>{{$resident->sex}}</td>
                            <td>{{$resident->age}}</td>
                            <td>{{$resident->birth_date}}</td>
                            <td>{{$resident->contact}}</td>
                            <td>{{$resident->civil_status}}</td>
                            <td>{{$resident->nationality}}</td>
                            <td>{{$resident->household_head}}</td>
                            <td>{{$resident->bona_fide}}</td>
                            <td>{{$resident->resident_six_months}}</td>
                            <td>{{$resident->pregnant}}</td>
                            <td>{{$resident->solo_parent}}</td>
                            <td>{{$resident->voter}}</td>
                            <td>{{$resident->pwd}} ({{$resident->disability}})</td>
                            <td>{{$resident->is_studying}}</td>
                            <td>{{$resident->education}}</td>
                            <td>{{$resident->institution}}</td>
                            <td>{{$resident->graduate_year}}</td>
                            <td>{{$resident->specialization}}</td>
                            <td>{{$resident->income}}</td>
                            <td>{{$resident->income_classification}}</td>
                            <td>{{$resident->is_employed}}</td>
                            <td>{{$resident->job_title}}</td>
                            <td>{{ \Carbon\Carbon::parse($resident->created_at)->diffForHumans()}}</td>
                            <td>{{ \Carbon\Carbon::parse($resident->updated_at)->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$residents->appends(['search'=>request()->query('search')])->links() }}

            </div>

        </div>
    </section>

</body>

</html>
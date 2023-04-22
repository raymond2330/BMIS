<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Indigency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="{{public_path('/css/style.css')}}">
    <style>
        .brgy {
            float: left;
        }

        .mnl {
            float: right;
        }
    </style>
</head>

<body>
    @include('includes.pdf-header')

    <h2 class="mt-5 text-center fw-bold tnr text-uppercase">Certificate of Good Moral Character</h2>

    <div class="container mt-5" style="text-align:justify">


        <p class="mt-4">
            <span class="indention p-form">This is to certify that <span class="fw-bold text-uppercase"> <em> {{ ($resident->sex === "Male")? "Mr." : "Ms." }} {{$resident->given_name}} {{$resident->surname}} </em></span>
                of legal age, is a resident of this Barangay with postal address at
                {{$resident->household->edifice_number}} {{$resident->household->street->street}} St., Quiapo, Manila.
            </span>
        </p>

        <p class="mt-4"><span class="indention p-form"> <span class="fw-bold"> <em> {{ ($resident->sex === "Male")? "Mr." : "Ms." }} {{$resident->surname}} </em></span> is of good moral character and has no derogatory record on file in this Barangay.</span></p>

        <p class="mt-4"><span class="indention p-form">This certification is being issued for <em class="fw-bold">{{$purpose}}</em> requirement.</span></p>

        <p class="mt-4"><span class="indention p-form">Issued this {{now()->isoFormat('Do \of MMM YYYY');}}, City of Manila.</span></p>

        <div class="float-end mt-5">
            <p class="fw-bold p-form text-uppercase">{{$punong_barangay}}</p>
            <p class="p-form">Punong Barangay</p>
            <p class="text-small text-muted">(not valid without seal)</p>
        </div>
    </div>


</body>

</html>
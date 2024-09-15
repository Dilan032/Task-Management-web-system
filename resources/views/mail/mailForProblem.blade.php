<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .BackGround{
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);
        }
        .BgInset{
            border-style: inset;
        }
    </style>

    <title>{{ $subject }}</title>
</head>
<body>
    <div class="container-fluid">

       <div class="text-center mt-3">
            <img src="{{ $message->embed('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}">
            <h2 class="pb-4" style="color: rgb(48, 2, 255)">NanoSoft Solutions Bank Complaning WebApplication</h2>
        </div>

        <div class="row mb-5">
            <div class="col-md-8 p-2 rounded">
                <p class="bg-primary-subtle text-dark p-2 rounded">
                    subject : <b>{{ $subject }}</b>
                </p>
                <p class="p-2"><b>messages :</b> <br> {{ $messageDetails }} </p> 
            </div>
            <div class="col-md-4">
                <div class="p-2 mt-2">
                    <p> <span class="fw-bold">Bank Details</span> <br>
                        Bank Name : {{ $bankName }} <br>
                        Bank Address : {{ $bankAddress }} <br>
                        Bank Contact Number : {{ $bankContactNumber }}
                    </p>
                </div>
                
                <hr>

                <div class="p-2">
                    <p>
                        <span class="fw-bold">Message Accept by,</span>
                        <br> Administrator : {{ $administratorName }} <br> 
                        Contact Number : {{ $administratorContactNumber }}
                    </p>
                </div>

                <hr>

                <div class="p-2">
                    <p>
                        <span class="fw-bold">Message Send by,</span>
                        @foreach ($user as $userDetails )
                            {{ $userDetails->name }}
                        @endforeach
                    </p>

                    {{-- <br> Administrator : {{ $user->name }} <br> 
                        Contact Number : {{ $user->user_contact_num }} --}}


                </div>
            </div>
        </div>

    </div>
</body>
</html>
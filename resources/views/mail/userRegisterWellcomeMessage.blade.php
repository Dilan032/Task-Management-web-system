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

    <title>Welcome</title>
</head>
<body>
    <div class="container-fluid">

       <div class="text-center mt-3">
            <img src="{{ $message->embed('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}">
            <h2 style="color: rgb(48, 2, 255)">Welcome to NanoSoft Solutions Institute Complaning WebApplication</h2>
        </div>

        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-10 BackGround rounded">
                <p class="bg-primary-subtle p-2 text-dark rounded">
                    <span class="text-center p-2">
                        Hi {{ $userType }}, Welcome to Nanosoft Solution Institute Complaint Web App.
                        By using this web application, you can solve any computer related problem in your Institute.
                        After submitting your question, your Institute's administrator will check the problem and forward the message to Nanosoft Solution (Pvt)Ltd
                        Nanosoft Solution (Pvt)Ltd is here to solve your problem.
                    </span>
                <p>
                    <b>Your account details are below,</b> <br>
                    User Name : {{ $userType }} <br> 
                    User Type : {{ $userName }} <br>
                    User Email : {{ $userEmail }} <br>
                    User Contact Number : {{ $userContactNumber }} <br>
                    User Password :  {{ $userPassword }}

                    <br><br>

                    <p class="d-md-flex justify-content-md-end">
                        <b>Your Registration Done By,</b><br>
                        {{ $RegisterUserType }} : {{ $RegisterAdminName }}<br>
                        Contact Details, <br>
                        {{ $RegisterAadminEmail }} <br>
                        {{ $RegisterAdminContactNumber }}
                    </p>
                    
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-5">
                        <a href="#" class="me-md-2 px-5">Visit to Bank Complaint Web Application</a>
                    </div>
            </div>
        </div>

    </div>
</body>
</html>
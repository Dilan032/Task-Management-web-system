<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/superAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" type="image/x-icon">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <style>
        .row {
            margin-right: 0;
            margin-left: 0;
        }

        .col-md-2, .col-md-10 {
            padding-right: 0;
            padding-left: 0;
        }
    </style>

    <title>Nanosoft Solutions</title>
</head>

<body class="bg-light text-dark">

    <x-navbar />

    <div class="row">
        <div class="col-md-12">
            @yield('SuperAdminContent')
        </div>
    </div>

    <x-footer />

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/1hbK99w1Z9rBfbZ3Tsw1Axu+Z2t7lVE5EZ2qpp" crossorigin="anonymous">
    </script>

</body>

</html>

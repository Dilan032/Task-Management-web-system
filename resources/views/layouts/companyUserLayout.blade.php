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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/administrator.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" type="image/x-icon">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="shortcut icon" href="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" type="image/x-icon">
    <title>Nanosoft Solutions</title>

    <style>
        .dropdown-item.in-queue { background-color: #ebe700; }
        .dropdown-item.in-progress { background-color: #ff0000; }
        .dropdown-item.document-pending { background-color: #357402; }
        .dropdown-item.postponed { background-color: #ff00b3; }
        .dropdown-item.move-next-day { background-color: #995e05; }
        .dropdown-item.complete-next-day { background-color: #ff7300; }
        .dropdown-item.completed { background-color: #001aff; }
        .dropdown-item.top-urgent { background-color: #995e05; }
        .dropdown-item.urgent { background-color: #ff0000; }
        .dropdown-item.medium { background-color: #357402; }
        .dropdown-item.low { background-color: #ebe700; }

        .time-buttons-container {
            display: flex;
        }

        .time-info {
            margin-right: 5px;
        }

        .time-info div {
            margin-bottom: 5px;
        }
    </style>

</head>
<body class="bg-light text-dark">


    {{-- navBar --}}
    <x-navbar />

    <div class="container">
        @yield('companyEmployeeContent')
    </div>


    <x-footer />

    <!-- jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/1hbK99w1Z9rBfbZ3Tsw1Axu+Z2t7lVE5EZ2qpp" crossorigin="anonymous"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/user.js') }}"></script>

</body>
</html>


@extends('layouts.superAdminLayout')

<!-- Font Awesome Free 6.x CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>


@section('SuperAdminContent')

    <!-- Display validation errors -->
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "{{ $error }}",
                });
            </script>
        @endforeach
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    @endif

    <div class="d-flex flex-wrap align-items-center mt-3">
        <span class="badge text-bg-secondary fs-6 p-2 me-3">
            Total Company Employees: {{ $totalEmployees }}
        </span>
        <span class="badge text-bg-secondary fs-6 p-2 me-3">
            Total Registered Institutes: {{ $totalInstitutes }}
        </span>

        <span class="badge text-bg-secondary fs-6 p-2 me-3">
            Issues received today: {{ $issuesInToday }}
        </span>

        <button type="button" class="btn btn-warning ms-auto position-relative me-3" id="importantButton">
            <i class="fa-solid fa-triangle-exclamation fa-beat"></i>

            Important

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                99+
                <span class="visually-hidden">unread messages</span>
            </span>
        </button>
    </div>

    <div class="d-flex flex-wrap align-items-center mt-3">
        {{-- @include('components.superAdmin.dashboard.charts') --}}
    </div>


@endsection
<!-- Font Awesome Free 6.x JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<!-- Font Awesome SVG Framework -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



{{-- --}}

{{-- <div class="d-flex-container flex-wrap mt-3" id="importantIssuesSection">
        @include('components.superAdmin.imporatanIssues')
    </div> --}}

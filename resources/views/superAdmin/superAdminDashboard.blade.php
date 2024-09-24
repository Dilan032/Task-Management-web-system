@extends('layouts.superAdminLayout')

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
    </div>


    <div style="margin-top:50px; margin-left:40px">
        @include('components.superAdmin.dashboard.activity-feed')
    </div>

@endsection



@extends('layouts.superAdminLayout')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

        @if (auth()->user() && auth()->user()->id === 1)
            <a href="{{ route('superAdmin.important.issue', $issues->first()->id) }}"
                class="btn btn-warning ms-auto position-relative">
                <i class="fas fa-triangle-exclamation fa-beat"></i>
                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger">
                    {{ $issues->total() }}
                    <span class="visually-hidden">important messages</span>
                </span>
                Action Required
            </a>
        @endif


        {{-- @include('components.superAdmin.dashboard.imporatanIssues') --}}
    </div>

    <div style="margin-top:50px; margin-left:40px">
        @include('components.superAdmin.dashboard.activity-feed')
    </div>

@endsection

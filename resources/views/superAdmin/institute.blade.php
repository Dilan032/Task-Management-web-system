@extends('layouts.superAdminLayout')

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

@section('SuperAdminContent')

    <div class="container-fluid">
        <div class="row align-items-center mt-3">
            <!-- Badge on the left, takes full width on small screens -->
            <div class="col-sm-12 col-md-auto mb-3 mb-md-0">
                <span class="badge text-bg-secondary fs-6 p-2">
                    Total Registered Institutes: {{ $instituteCount }}
                </span>
            </div>

            <!-- Buttons on the right, align to right on larger screens -->
            <div class="col-sm-12 col-md d-flex gap-2 justify-content-sm-start justify-content-md-end flex-wrap">
                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                    data-bs-target="#registerInstituteModal">Register Institute</button>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                    data-bs-target="#addInstituteTypeModal">Add Institute Type</button>
            </div>
        </div>

        <!-- Modals for Register Institute and Add Institute Type -->
        <div class="row">
            <div class="col-md-12 col-sm-4 mx-auto">
                {{-- Include the Register Institute modal --}}
                @include('components.superAdmin.institute.registerInstitute')
            </div>
            <div class="col-md-12 col-sm-4 mx-auto">
                {{-- Include the Add Institute Type modal --}}
                @include('components.superAdmin.institute.addInstituteType')
            </div>
        </div>

        <br />
        @include('superAdmin.instituteManagement.overview')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection

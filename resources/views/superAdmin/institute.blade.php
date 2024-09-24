@extends('layouts.superAdminLayout')

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
@endsection

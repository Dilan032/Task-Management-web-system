@extends('layouts.superAdminLayout')

@section('SuperAdminContent')

    <div class="container-fluid">
        <div class="row align-items-center mt-3">
            <!-- Badge on the left, takes the full width on smaller screens -->
            <div class="col-sm-12 col-md-auto mb-3 mb-md-0">
                <span class="badge text-bg-secondary fs-6 p-2">
                    Total Registered Employees: {{ $employeeCount }}
                </span>
            </div>

            <!-- Buttons on the right, align to the right on larger screens -->
            <div class="col-sm-12 col-md d-flex gap-2 justify-content-sm-start justify-content-md-end flex-wrap">
                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                    data-bs-target="#registerCompanyEmpModal">Register Company Users</button>

                <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                    data-bs-target="#deleteAllCompanyEmpModal">Remove All Employees</button>
            </div>
        </div>
        {{-- include model --}}
        @include('components.superAdmin.users.registerSuperAdmin')

        @include('superAdmin.companyEmpManagement.removeAllEmps')
    </div>

    <br />
    @include('superAdmin.companyEmpManagement.overview')
@endsection


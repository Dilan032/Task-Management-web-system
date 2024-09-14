@extends('layouts.superAdminLayout')

@section('SuperAdminContent')
    <!-- Page Heading -->
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">Company User Management</h3>
        </div>
    </div>

    <hr class="me-3">

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Badge on the left -->
            <span class="badge text-bg-secondary fs-6 p-2" style="margin-left:15px">
                Total Employees: {{ $employeeCount }}
            </span>

            <!-- Buttons on the right -->
            {{-- Buttons for Registe company employees and Remove all employees --}}
            <div class="d-flex gap-2">
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


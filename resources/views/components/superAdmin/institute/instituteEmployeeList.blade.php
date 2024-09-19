@extends('layouts.superAdminLayout')

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

    <!-- Page Heading -->
    <div class="container-fluid mt-3 mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.institute.view') }}">Institue Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Institue Employee Management</li>
            </ol>
        </nav>
    </div>

    <div class="container-fluid">
        <div class="table-responsive">
            <div class="table-wrapper">

                <!-- Add new institute employee row -->
                <div class="d-flex justify-content-between mb-4">
                    <!-- Total Employees -->
                    <span class="badge text-bg-secondary fs-6 p-2" style="margin-left:15px">
                        Total Employees in {{ $institute->institute_name }} : {{ $employees->total() }}
                    </span>

                    <!-- Add new institute employee button -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addInstituteEmpModal">
                        Add New Employee
                    </button>
                </div>

                <!-- Filter and Search Section -->
                <form action="{{ route('institute.employees.view', ['id' => $institute->id]) }}" method="GET">
                    <div class="row mb-3 align-items-end">
                        <!-- Search by Employee Name -->
                        <div class="col-md-3">
                            <input type="text" name="search_employee_name" class="form-control"
                                placeholder="Search Employee Name" value="{{ request('search_employee_name') }}">
                        </div>

                        <!-- Filter by Employee Type: Administrator and User -->
                        <div class="col-md-3">
                            <select name="filter_employee_type" class="form-select">
                                <option value="" selected>Filter by Employee Type</option>
                                <option value="administrator"
                                    {{ request('filter_employee_type') == 'administrator' ? 'selected' : '' }}>
                                    Administrator
                                </option>
                                <option value="user" {{ request('filter_employee_type') == 'user' ? 'selected' : '' }}>
                                    Institute Employee
                                </option>
                            </select>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="col-md-2 d-flex justify-content-between">
                            <div class="d-flex w-75">
                                <button type="submit" class="btn btn-primary w-50 me-2">Apply</button>
                                <a href="{{ route('institute.employees.view', ['id' => $institute->id]) }}"
                                    class="btn btn-warning w-50">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Table Section -->
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr style="text-align:center">
                            <th style="height: 60px; vertical-align: middle;">
                                Employee Name
                            </th>
                            <th style="height: 60px; vertical-align: middle;">
                                Employee Type
                                @if (request('filter_employee_type'))
                                    <span class="position-relative">
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $employees->total() }}
                                            <span class="visually-hidden">filtered employees</span>
                                        </span>
                                    </span>
                                @endif
                            </th>
                            <th style="height: 60px; vertical-align: middle;">Mobile Number</th>
                            <th style="height: 60px; vertical-align: middle; width: 20%;">Email</th>
                            <th style="height: 60px; vertical-align: middle;">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center">
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>
                                    <!-- Display Employee Type with condition -->
                                    @if ($employee->user_type == 'administrator')
                                        Administrator
                                    @elseif ($employee->user_type == 'user')
                                        Institute Employee
                                    @endif
                                </td>
                                <td>{{ $employee->user_contact_num }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    <!-- Edit Modal Trigger -->
                                    <a href="#editInstituteEmpModal{{ $employee->id }}" class="edit" title="Edit"
                                        data-bs-toggle="modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange"
                                            class="bi bi-pencil-fill" viewBox="0 0 16 16"
                                            style="margin-left: 5px; margin-right: 10px;">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </a>

                                    <!-- Delete Modal Trigger -->
                                    <a href="#deleteInstituteEmpModal{{ $employee->id }}" class="remove" title="Remove"
                                        data-bs-toggle="modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                            class="bi bi-trash-fill" viewBox="0 0 16 16"
                                            style="margin-left: 5px; margin-right: 10px;">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>

                            <!-- Modal for Adding Employees for Institute -->
                            <div class="modal fade" id="addInstituteEmpModal" tabindex="-1"
                                aria-labelledby="addInstituteEmpModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addInstituteEmpModalLabel">Add Institute
                                                Employee
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('RegisterUser.save') }}" method="POST"
                                                class="mx-auto px-2">
                                                @csrf

                                                <!-- Institute Info Group -->
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Institute Info</span>

                                                    <!-- Hidden Institute ID Field -->
                                                    <input type="hidden" name="institute_id"
                                                        value="{{ $institute->id }}">

                                                    <!-- Institute Name -->
                                                    <input type="text" class="form-control"
                                                        value="{{ $institute->institute_name }}" readonly>

                                                    <!-- User Name -->
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" placeholder="User Name" required>

                                                    <!-- User Type -->
                                                    <select name="user_type" class="form-select" required>
                                                        <option selected>Select User Type</option>
                                                        <option value="administrator"
                                                            {{ old('user_type') == 'administrator' ? 'selected' : '' }}>
                                                            Administrator</option>
                                                        <option value="user"
                                                            {{ old('user_type') == 'user' ? 'selected' : '' }}>User
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Contact Info Group -->
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Email & Contact Number</span>
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        class="form-control" placeholder="Email" required>
                                                    <input type="text" name="user_contact_num"
                                                        value="{{ old('user_contact_num') }}" class="form-control"
                                                        placeholder="Contact Number" required>
                                                </div>

                                                <!-- Security Group -->
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Password & Confirm Password</span>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Password" required>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control" placeholder="Confirm Password" required>
                                                </div>

                                                <!-- Form Buttons: Register and Clear -->
                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="submit" class="btn btn-primary">Register
                                                        Now</button>
                                                    <button type="reset" class="btn btn-warning">Clear</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Editing Employees for Institute -->
                            <div class="modal fade" id="editInstituteEmpModal{{ $employee->id }}" tabindex="-1"
                                aria-labelledby="editInstituteEmpModalLabel{{ $employee->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editInstituteEmpModalLabel{{ $employee->id }}">
                                                Update
                                                Employee Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('companyEmp.details.update', $employee->id) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')

                                                <!-- Employee Name and Status Group -->
                                                <div class="input-group mb-3" style="padding-bottom:15px">
                                                    <span class="input-group-text">Employee Name & Status</span>
                                                    <input type="text" name="name" aria-label="Employee Name"
                                                        class="form-control" placeholder="Employee Name"
                                                        value="{{ old('name', $employee->name) }}" required>
                                                    <select name="status" aria-label="Status" class="form-select">
                                                        <option value="active"
                                                            {{ $employee->status == 'active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="inactive"
                                                            {{ $employee->status == 'inactive' ? 'selected' : '' }}>
                                                            Inactive</option>
                                                    </select>
                                                </div>

                                                <!-- Email and Mobile Number Group -->
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Email & Mobile</span>
                                                    <input type="email" name="email" aria-label="Email"
                                                        class="form-control" placeholder="Email"
                                                        value="{{ old('email', $employee->email) }}" required>
                                                    <input type="text" name="user_contact_num"
                                                        aria-label="Mobile Number" class="form-control"
                                                        placeholder="Mobile Number"
                                                        value="{{ old('user_contact_num', $employee->user_contact_num) }}"
                                                        required>
                                                </div>

                                                <!-- Password and Confirm Password Group -->
                                                <div class="input-group mb-3" style="padding-bottom:15px">
                                                    <span class="input-group-text">Password & Confirm Password</span>
                                                    <input type="password" name="password" aria-label="Password"
                                                        class="form-control" placeholder="Password">
                                                    <input type="password" name="password_confirmation"
                                                        aria-label="Confirm Password" class="form-control"
                                                        placeholder="Confirm Password">
                                                </div>

                                                <!-- Form Buttons -->
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary me-2" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Deleting Employees for Institute -->
                            <div class="modal fade" id="deleteInstituteEmpModal{{ $employee->id }}" tabindex="-1"
                                aria-labelledby="deleteInstituteEmpModalLabel{{ $employee->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="color:red" class="modal-title"
                                                id="deleteInstituteEmpModalLabel{{ $employee->id }}">
                                                Delete Employee
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete the following employee?</p>
                                            <ul>
                                                <li><strong>Name:</strong> {{ $employee->name }}</li>
                                                <li><strong>User Type:</strong>
                                                    <!-- Display Employee Type with condition -->
                                                    @if ($employee->user_type == 'administrator')
                                                        Administrator
                                                    @elseif ($employee->user_type == 'user')
                                                        Institute Employee
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('institute.employee.delete', $employee->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </tbody>
                </table>

                {{-- Pagination section --}}
                <div style="margin-top:30px">
                    {{ $employees->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@endsection

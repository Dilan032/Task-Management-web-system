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

<!-- Filter Section -->
<form action="{{ route('administrator.users') }}" method="GET" class="mt-4">
    <div class="row mb-3 align-items-end">

        <!-- Search by Employee Name -->
        <div class="col-md-3 mb-2 mb-md-0">
            <input type="text" name="search_employee_name" class="form-control" placeholder="Search Employee Name"
                value="{{ request('search_employee_name') }}">
        </div>

        <!-- Filter by Employee Type: Administrator and User -->
        <div class="col-md-3 mb-2 mb-md-0">
            <select name="filter_employee_type" class="form-select">
                <option value="" selected>Filter by Employee Type</option>
                <option value="administrator"
                    {{ request('filter_employee_type') == 'administrator' ? 'selected' : '' }}>
                    Administrator
                </option>
                <option value="user" {{ request('filter_employee_type') == 'user' ? 'selected' : '' }}>
                    Company Employee
                </option>
            </select>
        </div>

        <!-- Filter by institute employee Status (active or not) -->
        <div class="col-md-3 mb-2 mb-md-0">
            <select name="filter_employee_status" class="form-select">
                <option value="" selected>Filter by Status</option>
                <option value="active" {{ request('filter_employee_status') == 'active' ? 'selected' : '' }}>
                    Active</option>
                <option value="inactive" {{ request('filter_employee_status') == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        <!-- Buttons Section -->
        <div class="col-md-3 d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-primary me-2">Apply</button>
            <a href="{{ route('administrator.users') }}" class="btn btn-warning me-2">Reset</a>
            <button class="btn btn-success" type="button" data-bs-toggle="modal"
                data-bs-target="#addInstituteEmployeeModal" style="margin-left:10px">
                New user
            </button>
        </div>
    </div>
</form>

@include('components.superAdmin.users.registerUsers')

<div class="table-responsive">
    <div class="table-wrapper">
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
                    <th style="height: 60px; vertical-align: middle;">
                        Status
                        @if (request('filter_employee_status'))
                            <span class="position-relative">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $employees->total() }}
                                    <span class="visually-hidden">filtered employees</span>
                                </span>
                            </span>
                        @endif
                    </th>
                    <th style="height: 60px; vertical-align: middle;">Actions</th>
                </tr>
            </thead>
            <tbody style="text-align:center">
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->user_type }}</td>
                        <td>{{ $employee->user_contact_num }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            @php
                                $statusClasses = [
                                    'active' => 'text-bg-success',
                                    'inactive' => 'text-bg-warning',
                                ];
                                $statusClass = $statusClasses[$employee->status] ?? 'text-bg-info';
                            @endphp
                            <span class="badge rounded-pill {{ $statusClass }} py-1 px-4">
                                {{ $employee->status }}
                            </span>
                        </td>
                        <td>
                            <!-- Edit Modal Trigger -->
                            <button type="button" class="btn btn-warning btn-sm" title="Edit Employee Details"
                                data-bs-toggle="modal" data-bs-target="#editInstituteEmpModal{{ $employee->id }}">
                                Edit
                            </button>

                            <!-- Delete Modal Trigger -->
                            <button type="button" class="btn btn-danger btn-sm" title="Remove Employee"
                                data-bs-toggle="modal" style="margin-left: 10px"
                                data-bs-target="#deleteCompanyEmpModal{{ $employee->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    {{-- Institute employee data edit details model form --}}
                    @include('administrator.userEdit')

                    <!-- Modal for Deleting Company Employee -->
                    <div class="modal fade" id="deleteCompanyEmpModal{{ $employee->id }}" tabindex="-1"
                        aria-labelledby="deleteCompanyEmpModalLabel{{ $employee->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="color:red" class="modal-title"
                                        id="deleteCompanyEmpModalLabel{{ $employee->id }}">
                                        Delete Employee
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete the following employee?</p>
                                    <ul>
                                        <li><strong>Name:</strong> {{ $employee->name }}</li>
                                        <li><strong>User Type:</strong> {{ $employee->user_type }}</li>
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

        <!-- Pagination Links -->
        <div style="margin-top:30px">
            {{ $employees->links() }}
        </div>
    </div>
</div>

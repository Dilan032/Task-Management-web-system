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

<div class="container-fluid">
    <div class="table-responsive">
        <div class="table-wrapper">

            <!-- Filter Section -->
            <form action="{{ route('administrator.users') }}" method="GET">
                <div class="row mb-3 align-items-end">

                    <!-- Search by Employee Name -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <input type="text" name="search_employee_name" class="form-control"
                            placeholder="Search Employee Name" value="{{ request('search_employee_name') }}">
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
                            <option value="active"
                                {{ request('filter_employee_status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive"
                                {{ request('filter_employee_status') == 'inactive' ? 'selected' : '' }}>Inactive
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

            <!-- Table Section -->
            <table class="table table-bordered" style="width: 100%;">
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
                                <a href="#editCompanyEmpModal{{ $employee->id }}" class="edit" title="Edit"
                                    data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange"
                                        class="bi bi-pencil-fill" viewBox="0 0 16 16"
                                        style="margin-left: 5px; margin-right: 10px;">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>
                                </a>

                                <!-- Delete Modal Trigger -->
                                <a href="#deleteCompanyEmpModal{{ $employee->id }}" class="remove" title="Remove"
                                    data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16"
                                        style="margin-left: 5px; margin-right: 10px;">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4v8h1V5h-1zm3 0v8h1V5h-1zm2 0v8h1V5h-1z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div style="margin-top:30px">
                {{ $employees->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>

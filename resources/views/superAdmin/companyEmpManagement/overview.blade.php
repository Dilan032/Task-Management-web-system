<div class="container-fluid">
    <div class="table-responsive">
        <div class="table-wrapper">

            <!-- Filter and Search Section -->
            <form action="{{ route('superAdmin.users.view') }}" method="GET">
                <div class="row mb-3">
                    <!-- Search by Employee Name -->
                    <div class="col-md-4">
                        <input type="text" name="search_employee_name" class="form-control"
                            placeholder="Search Employee Name" value="{{ request('search_employee_name') }}">
                    </div>

                    <!-- Filter by Employee Type: Super Admin and Company Employee -->
                    <div class="col-md-3">
                        <select name="filter_employee_type" class="form-select">
                            <option value="" selected>Filter by Employee Type</option>
                            <option value="super admin"
                                {{ request('filter_employee_type') == 'super admin' ? 'selected' : '' }}>
                                Super Admin
                            </option>
                            <option value="company employee"
                                {{ request('filter_employee_type') == 'company employee' ? 'selected' : '' }}>
                                Company Employee
                            </option>
                        </select>
                    </div>

                    <!-- Filter by Employee Status: Online/Offline -->
                    <div class="col-md-3">
                        <select name="filter_employee_status" class="form-select">
                            <option value="" selected>Filter by Employee Status</option>
                            <option value="online"
                                {{ request('filter_employee_status') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline"
                                {{ request('filter_employee_status') == 'offline' ? 'selected' : '' }}>Offline</option>
                        </select>
                    </div>

                    <!-- Submit and Reset Buttons -->
                    <div class="col-md-2 d-flex justify-content-between">
                        <!-- Apply Button -->
                        <button type="submit" class="btn btn-primary w-50">Apply</button>

                        <!-- Reset Button -->
                        <a href="{{ route('superAdmin.users.view') }}" class="btn btn-warning w-50 ms-2">Reset</a>
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
                        </th>
                        <th style="height: 60px; vertical-align: middle;">Mobile Number</th>
                        <th style="height: 60px; vertical-align: middle; width: 20%;">Email</th>
                        {{-- <th style="height: 60px; vertical-align: middle;">Last Seen</th> --}}
                        <th style="height: 60px; vertical-align: middle;">Status</th>
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
                            <td class="py-2 text-center">
                                @if (Cache::has('user-online' . $employee->id))
                                    <span class="text-green-500">Online</span>
                                @else
                                    <span class="text-gray-500">Offline</span>
                                @endif
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
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                    </svg>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal for Editing Company Employee -->
                        <div class="modal fade" id="editCompanyEmpModal{{ $employee->id }}" tabindex="-1"
                            aria-labelledby="editCompanyEmpModalLabel{{ $employee->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCompanyEmpModalLabel{{ $employee->id }}">Update
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
                                        <form action="{{ route('company.employee.delete', $employee->id) }}"
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

<div class="container-fluid">
    <div class="table-responsive">
        <div class="table-wrapper">
            <!-- Filter and Search Section -->
            <form action="{{ route('superAdmin.institute.view') }}" method="GET">
                <div class="row mb-3">
                    <!-- Search by Institute Name -->
                    <div class="col-md-4">
                        <input type="text" name="search_institute_name" class="form-control"
                            placeholder="Search Institute Name" value="{{ request('search_institute_name') }}">
                    </div>

                    <!-- Filter by Institute Type -->
                    <div class="col-md-3">
                        <select name="filter_institute_type" class="form-select">
                            <option value="" selected>Filter by Institute Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->institute_type }}"
                                    {{ request('filter_institute_type') == $type->institute_type ? 'selected' : '' }}>
                                    {{ $type->institute_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Assigned Employee -->
                    <div class="col-md-3">
                        <select name="filter_assigned_employee" class="form-select">
                            <option value="" selected>Filter by Assigned Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->name }}"
                                    {{ request('filter_assigned_employee') == $employee->name ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit and Reset Buttons -->
                    <div class="col-md-2 d-flex justify-content-between">
                        <!-- Apply Button -->
                        <button type="submit" class="btn btn-primary w-50">Apply</button>

                        <!-- Reset Button -->
                        <a href="{{ route('superAdmin.institute.view') }}" class="btn btn-warning w-50 ms-2">Reset</a>
                    </div>
                </div>
            </form>

            <!-- Table Section -->
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr style="text-align:center">
                        <th style="height: 60px; vertical-align: middle;">
                            Institute Name
                        </th>
                        <th style="height: 60px; vertical-align: middle;">
                            <!-- Institute Type with Badge -->
                            Institute Type
                            @if (request('filter_institute_type'))
                                <span class="position-relative">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $institute->total() }}
                                        <span class="visually-hidden">filtered institutes</span>
                                    </span>
                                </span>
                            @endif
                        </th>
                        <th style="height: 60px; vertical-align: middle;">Institute Address</th>
                        <th style="height: 60px; vertical-align: middle;">Institute Contact</th>
                        <th style="height: 60px; vertical-align: middle; width: 20%;">Email</th>
                        <th style="height: 60px; vertical-align: middle;">Assigned Employee</th>
                        <th style="height: 60px; vertical-align: middle;">Actions</th>
                    </tr>
                </thead>
                <tbody style="text-align:center">
                    @foreach ($institute as $item)
                        <tr>
                            <td>{{ $item->institute_name }}</td>
                            <td>{{ $item->institute_type }}</td>
                            <td>{{ $item->institute_address }}</td>
                            <td>{{ $item->institute_contact_num }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->assigned_employee }}</td>
                            <td>
                                <!-- Edit Modal Trigger -->
                                <a href="#editInstituteModal{{ $item->id }}" class="edit" title="Edit"
                                    data-bs-toggle="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="orange"
                                        class="bi bi-pencil-fill" viewBox="0 0 16 16"
                                        style="margin-left: 5px; margin-right: 10px;">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>
                                </a>

                                <!-- Institue Employee Add Modal Trigger -->
                                <a href="#addInstituteEmpModal{{ $item->id }}" class="add" title="Add Employee"
                                    data-bs-toggle="modal" data-institute-id="{{ $item->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                        <path fill-rule="evenodd"
                                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal for Editing Institute -->
                        <div class="modal fade" id="editInstituteModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editInstituteModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editInstituteModalLabel{{ $item->id }}">Edit
                                            Institute</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for editing the institute -->
                                        <form action="{{ route('superAdmin.institute.update.view', $item->id) }}"
                                            method="post">
                                            @csrf
                                            @method('PUT')

                                            <!-- Institute Info: Name, Type, and Assigned Employee -->
                                            <div class="input-group mb-3" style="padding-bottom:15px">
                                                <span class="input-group-text">Institute Info</span>
                                                <input type="text" name="institute_name"
                                                    value="{{ old('institute_name', $item->institute_name) }}"
                                                    class="form-control" placeholder="Institute Name" required>

                                                <!-- Institute Type -->
                                                <select name="institute_type" class="form-select" required>
                                                    <option selected disabled>Institute Type...</option>
                                                    @foreach ($types as $institute_type)
                                                        <option value="{{ $institute_type->institute_type }}"
                                                            {{ $institute_type->institute_type == $item->institute_type ? 'selected' : '' }}>
                                                            {{ $institute_type->institute_type }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <!-- Assigned Employee -->
                                                <select name="assigned_employee" class="form-select" required>
                                                    <option selected disabled>Assigned Employee...</option>
                                                    @foreach ($employees as $assigned_employee)
                                                        <option value="{{ $assigned_employee->name }}"
                                                            {{ $assigned_employee->name == $item->assigned_employee ? 'selected' : '' }}>
                                                            {{ $assigned_employee->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Contact Info: Number and Email -->
                                            <div class="input-group mb-3" style="padding-bottom:15px">
                                                <span class="input-group-text">Contact Info</span>
                                                <input type="text" name="institute_contact_num"
                                                    value="{{ old('institute_contact_num', $item->institute_contact_num) }}"
                                                    class="form-control" placeholder="Institute Contact Number"
                                                    required>
                                                <input type="email" name="email"
                                                    value="{{ old('email', $item->email) }}" class="form-control"
                                                    placeholder="Email" required>
                                            </div>

                                            <!-- Address Field -->
                                            <div class="form-floating mb-3">
                                                <input type="text" name="institute_address"
                                                    value="{{ old('institute_address', $item->institute_address) }}"
                                                    class="form-control" id="floatingInput2"
                                                    placeholder="Institute Address">
                                                <label for="floatingInput2">Address</label>
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

                        <!-- Modal for Add Employees for institute -->
                        <div class="modal fade" id="addInstituteEmpModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="addInstituteModalEmpLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editInstituteModalLabel{{ $item->id }}">Add
                                            Institute Employees</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('RegisterUser.save') }}" method="POST"
                                            class="mx-auto px-2">
                                            @csrf

                                            <!-- Institute Info Group -->
                                            <div class="input-group mb-3" style="padding-bottom:15px">
                                                <span class="input-group-text">Institute Info</span>

                                                <!-- Hidden Institute ID Field -->
                                                <input type="hidden" name="institute_id"
                                                    value="{{ $item->id }}">

                                                <!-- Institute Name -->
                                                <input type="text" class="form-control"
                                                    value="{{ $item->institute_name }}" readonly>

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
                                            <div class="input-group mb-3" style="padding-bottom:15px">
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
                                                <button type="submit" class="btn btn-primary">Register Now</button>
                                                <button type="reset" class="btn btn-warning">Clear</button>
                                            </div>

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
                {{ $institute->links() }}
            </div>
        </div>
    </div>
</div>

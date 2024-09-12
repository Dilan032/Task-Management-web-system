<div class="container-fluid">
    <div class="table-responsive">
        <div class="table-wrapper">
            <!-- Filter and Search Section -->
            <form action="{{ route('superAdmin.institute.view') }}" method="GET">
                <div class="row mb-3">
                    <!-- Search by Institute Name -->
                    <div class="col-md-4">
                        <input type="text" name="search_institute_name" class="form-control" placeholder="Search Institute Name" value="{{ request('search_institute_name') }}">
                    </div>

                    <!-- Filter by Institute Type -->
                    <div class="col-md-3">
                        <select name="filter_institute_type" class="form-select">
                            <option value="" selected>Filter by Institute Type</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->institute_type }}" {{ request('filter_institute_type') == $type->institute_type ? 'selected' : '' }}>
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
                                <option value="{{ $employee->name }}" {{ request('filter_assigned_employee') == $employee->name ? 'selected' : '' }}>
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
                        <th>Institute Name</th>
                        <th>Institute Type</th>
                        <th>Institute Address</th>
                        <th>Institute Contact</th>
                        <th style="width: 20%;">Email</th>
                        <th>Assigned Employee</th>
                        <th>Actions</th>
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
                                    <i class="material-icons" style="color: orange; margin-left:5px">&#xE254;</i>
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
                                            <div class="input-group mb-3">
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
                                            <div class="input-group mb-3">
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

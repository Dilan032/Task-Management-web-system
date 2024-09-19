<!-- Modal for Editing Company Employee -->
<div class="modal fade" id="editInstituteEmpModal{{ $employee->id }}" tabindex="-1"
    aria-labelledby="editInstituteEmpModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInstituteEmpModalLabel{{ $employee->id }}">Update
                    Employee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('instituteEmp.details.update', $employee->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')

                    <!-- Employee Name and Status Group -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Employee Name & Status</span>
                        <input type="text" name="name" class="form-control"
                            placeholder="Employee Name" value="{{ old('name', $employee->name) }}"
                            required>
                        <select name="status" class="form-select">
                            <option value="active"
                                {{ $employee->status == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive"
                                {{ $employee->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Email and Mobile Number Group -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Email & Mobile</span>
                        <input type="email" name="email" class="form-control"
                            placeholder="Email" value="{{ old('email', $employee->email) }}"
                            required>
                        <input type="text" name="user_contact_num" class="form-control"
                            placeholder="Mobile Number"
                            value="{{ old('user_contact_num', $employee->user_contact_num) }}"
                            required>
                    </div>

                    <!-- Password and Confirm Password Group -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password & Confirm Password</span>
                        <input type="password" name="password" class="form-control"
                            placeholder="Password">
                        <input type="password" name="password_confirmation" class="form-control"
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

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

<!-- Modal for Add Employees for institute -->
<div class="modal fade" id="addInstituteEmpModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="addInstituteModalEmpLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInstituteModalLabel{{ $item->id }}">Add
                    Institute Employees</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('RegisterUser.save') }}" method="POST" class="mx-auto px-2">
                    @csrf

                    <!-- Institute Info Group -->
                    <div class="input-group mb-3" style="padding-bottom:15px">
                        <span class="input-group-text">Institute Info</span>

                        <!-- Institute Name -->
                        <select name="institute_id" class="form-select" required>
                            @foreach ($institute as $instituteDetails)
                                <option value="{{ $instituteDetails->id }}"
                                    {{ $instituteDetails->id == $item->id ? 'selected' : '' }}>
                                    {{ $instituteDetails->institute_name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- User Name -->
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="User Name" required>

                        <!-- User Type -->
                        <select name="user_type" class="form-select" required>
                            <option selected>Select User Type</option>
                            <option value="administrator" {{ old('user_type') == 'administrator' ? 'selected' : '' }}>
                                Administrator</option>
                            <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>User
                            </option>
                        </select>
                    </div>

                    <!-- Contact Info Group -->
                    <div class="input-group mb-3" style="padding-bottom:15px">
                        <span class="input-group-text">Email & Contact Number</span>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="Email" required>
                        <input type="text" name="user_contact_num" value="{{ old('user_contact_num') }}"
                            class="form-control" placeholder="Contact Number" required>
                    </div>

                    <!-- Security Group -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password & Confirm Password</span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm Password" required>
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

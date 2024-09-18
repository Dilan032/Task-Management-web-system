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

<!-- Modal for Company Users Registration -->
<div class="modal fade" id="registerCompanyEmpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="registerCompanyEmpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Company Employee Registration</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('RegisterSuperAdmin.save') }}" method="POST" class="mx-auto px-2"
                    id="registerForm">
                    @csrf
                    <div class="input-group mb-3" style="padding-bottom:15px">
                        <span class="input-group-text">User Info</span>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="User Name">
                        <select name="user_type" class="form-select" required>
                            <option selected>Select User Type</option>
                            <option value="super admin" {{ old('user_type') == 'super admin' ? 'selected' : '' }}>Super
                                Admin</option>
                            <option value="company employee"
                                {{ old('user_type') == 'company employee' ? 'selected' : '' }}>Company Employee</option>
                        </select>
                    </div>

                    <div class="input-group mb-3" style="padding-bottom:15px">
                        <span class="input-group-text">User Contact Info</span>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="Email">
                        <input type="text" name="user_contact_num" value="{{ old('user_contact_num') }}"
                            class="form-control" placeholder="User Contact Number">
                    </div>

                    <div class="input-group mb-3" style="padding-bottom:15px">
                        <span class="input-group-text">Password Info</span>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password">
                        <input type="password" name="password_confirmation" class="form-control"
                            id="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success me-2" type="submit">Register Now</button>
                        <button id="clearButton" class="btn btn-warning" type="button">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle form clearing -->
<script>
    document.getElementById('clearButton').addEventListener('click', function() {
        document.getElementById('instituteForm').reset();
    });
</script>

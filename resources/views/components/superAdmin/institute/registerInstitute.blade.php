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


<!-- Modal for Institute Registration -->
<div class="modal fade" id="registerInstituteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="registerInstituteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="registerInstituteModalLabel">Institute Registration</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="instituteForm" action="{{ route('RegisterInstitute.save') }}" method="POST"
                    class="mx-auto px-2">
                    @csrf

                    <!-- Input Group with Institute Name, Type, and Assigned Employee -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Institute Info</span>

                        <!-- Institute Name -->
                        <input type="text" name="institute_name" value="{{ old('institute_name') }}"
                            class="form-control" placeholder="Institute Name" required>

                        <!-- Institute Type -->
                        <select name="institute_type" class="form-select" required>
                            <option selected disabled>Institute Type...</option>
                            @foreach ($types as $institute_type)
                                <option value="{{ $institute_type->institute_type }}">
                                    {{ $institute_type->institute_type }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Assigned Employee -->
                        <select name="assigned_employee" class="form-select" required>
                            <option selected disabled>Assigned Employee...</option>
                            @foreach ($employees as $assigned_employee)
                                <option value="{{ $assigned_employee->name }}">
                                    {{ $assigned_employee->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <br />

                    <!-- Input Group with Institute Contact Number and Email -->
                    <div class="input-group mb-3">
                        <span class="input-group-text">Contact Info</span>

                        <!-- Contact Number -->
                        <input type="text" name="institute_contact_num" value="{{ old('institute_contact_num') }}"
                            class="form-control" placeholder="Institute Contact Number" required>

                        <!-- Email -->
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                            placeholder="Email" required>
                    </div>

                    <!-- Address Field -->
                    <div class="form-floating mb-3">
                        <input type="text" name="institute_address" value="{{ old('institute_address') }}"
                            class="form-control" id="floatingInput2" placeholder="Institute Address">
                        <label for="floatingInput2">Address</label>
                    </div>

                    <!-- Form Buttons -->
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

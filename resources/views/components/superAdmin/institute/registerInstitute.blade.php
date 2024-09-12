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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="registerInstituteModalLabel">Institute Registration</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="instituteForm" action="{{ route('RegisterInstitute.save') }}" method="POST" class="mx-auto px-2">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 col-sm-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="institute_name" value="{{ old('institute_name') }}"
                                    class="form-control" id="floatingInput1" placeholder="Institute name">
                                <label for="floatingInput1">Institute Name</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <select id="institute_type" class="form-select" name="institute_type" required>
                                <option selected disabled>Institute Type...</option>
                                @foreach ($types as $institute_type)
                                    <option value="{{ $institute_type->institute_type }}">
                                        {{ $institute_type->institute_type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="institute_address" value="{{ old('institute_address') }}"
                                    class="form-control" id="floatingInput2" placeholder="Institute address">
                                <label for="floatingInput2">Address</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-4">
                            <div class="form-floating mb-3">
                                <input type="text" name="institute_contact_num"
                                    value="{{ old('institute_contact_num') }}" class="form-control" id="floatingInput3"
                                    placeholder="Institute contact number">
                                <label for="floatingInput3">Contact Number</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-4">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    id="floatingInput4" placeholder="Email">
                                <label for="floatingInput4">Email</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary me-2" type="submit">Register Now</button>
                        <button id="clearButton" class="btn btn-warning" type="button">Clear</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to handle form clearing -->
<script>
    document.getElementById('clearButton').addEventListener('click', function () {
        document.getElementById('instituteForm').reset();
    });
</script>

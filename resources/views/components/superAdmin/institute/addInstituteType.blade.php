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

<!-- Modal for Adding/Editing Institute Type -->
<div class="modal fade" id="addInstituteTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="addInstituteTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addInstituteTypeModalLabel">Add/Update Institute Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Form for selecting existing institute type for editing -->
                <div class="row mb-3">
                    <div class="col">
                        <select id="instituteTypeSelect" class="form-select" required>
                            <option selected disabled>Select Type For Modify</option>
                            @foreach ($types as $institute_type)
                                <option value="{{ $institute_type->id }}"
                                    data-name="{{ $institute_type->institute_type }}">
                                    {{ $institute_type->institute_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Form for adding or editing institute type -->
                <div class="row">
                    <form id="instituteTypeForm" method="POST" class="mx-auto px-2">
                        @csrf
                        <input type="hidden" id="institute_type_id" name="institute_type_id" value="">
                        <div class="col">
                            <div class="form-floating mb-3" style="padding-left:3px; padding-right:3px;">
                                <input type="text" name="institute_type" value="{{ old('institute_type') }}"
                                    class="form-control" id="addNew" placeholder="Add New Institute Type">
                                <label id="formLabel" for="addNew">Add New Institute Type</label>
                            </div>
                        </div>

                        <!-- Buttons for adding, updating, and canceling -->
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-success" id="saveButton" type="submit">Add</button>
                            <button class="btn btn-primary" id="updateButton" type="submit"
                                style="display: none;">Update</button>
                            <button class="btn btn-secondary" id="cancelButton" type="button" style="display: none;"
                                onclick="resetForm()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Function to reset the form to "Add" mode
    function resetForm() {
        document.getElementById('instituteTypeForm').reset(); // Reset form fields
        document.getElementById('institute_type_id').value = ''; // Clear hidden input
        document.getElementById('instituteTypeForm').action =
        "{{ route('AddInstituteType.save') }}"; // Set form to Add action

        // Show Add button, hide Update and Cancel buttons
        document.getElementById('saveButton').style.display = 'inline-block';
        document.getElementById('updateButton').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';

        // Change the label back to "Add New Institute Type"
        document.getElementById('formLabel').textContent = 'Add New Institute Type';
    }

    // Handle dropdown change event to switch to "Update" mode
    document.getElementById('instituteTypeSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const instituteTypeName = selectedOption.getAttribute('data-name');
        const instituteTypeId = selectedOption.value;

        // Set form values for editing
        document.getElementById('addNew').value = instituteTypeName;
        document.getElementById('institute_type_id').value = instituteTypeId;

        // Set form action to Update
        document.getElementById('instituteTypeForm').action = "{{ route('UpdateInstituteType') }}";

        // Switch to "Update" mode: show Update and Cancel buttons, hide Add button
        document.getElementById('saveButton').style.display = 'none';
        document.getElementById('updateButton').style.display = 'inline-block';
        document.getElementById('cancelButton').style.display = 'inline-block';

        // Change the label to "Update Selected Institute Type"
        document.getElementById('formLabel').textContent = 'Update Selected Institute Type';
    });

    // Reset the form when the modal is closed
    document.getElementById('addInstituteTypeModal').addEventListener('hidden.bs.modal', function() {
        resetForm(); // Reset the form when the modal is closed
    });
</script>

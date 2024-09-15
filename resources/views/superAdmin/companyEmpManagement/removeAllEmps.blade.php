@if (session('success'))
    <div class="alert alert-success" id="success-message">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" id="error-message">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<!-- JavaScript to hide messages after 3 seconds -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hide success message after 3 seconds
        setTimeout(function() {
            let successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000);

        // Hide error message after 3 seconds
        setTimeout(function() {
            let errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 3000);
    });
</script>


<!-- First Modal: Enter User ID -->
<div class="modal fade" id="deleteAllCompanyEmpModal" tabindex="-1" aria-labelledby="deleteAllCompanyEmpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:red" class="modal-title" id="deleteAllCompanyEmpModalLabel">Warning: Delete All Employees
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>This action will remove all employees. Please enter your user ID to proceed.</p>
                <form id="deleteAllStepOneForm">
                    <div class="mb-3">
                        <label for="userId" class="form-label">Enter Your User ID</label>
                        <input type="text" class="form-control" id="userId" name="user_id" required>
                        <div class="text-danger mt-2" id="userIdError" style="display:none;">Please enter your User ID.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="continueButton">Continue</button>
            </div>
        </div>
    </div>
</div>

<!-- Second Modal: Confirmation to Delete All Employees -->
<div class="modal fade" id="deleteAllConfirmModal" tabindex="-1" aria-labelledby="deleteAllConfirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:red" class="modal-title" id="deleteAllConfirmModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete all employees? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <form id="deleteAllForm" action="{{ route('company.employees.deleteAll') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="hiddenUserId" name="user_id">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete All</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('#continueButton').addEventListener('click', function () {
        // Get the user ID entered in the first modal
        const userId = document.querySelector('#userId').value;

        // Check if user ID is empty
        if (userId.trim() === '') {
            // Show an error message if User ID is not entered
            document.getElementById('userIdError').style.display = 'block';
        } else {
            // Hide the error message
            document.getElementById('userIdError').style.display = 'none';

            // Pass the user ID to the hidden input field in the second modal form
            document.querySelector('#hiddenUserId').value = userId;

            // Open the second modal and close the first one
            var deleteAllConfirmModal = new bootstrap.Modal(document.getElementById('deleteAllConfirmModal'));
            deleteAllConfirmModal.show();
            var deleteAllCompanyEmpModal = bootstrap.Modal.getInstance(document.getElementById('deleteAllCompanyEmpModal'));
            deleteAllCompanyEmpModal.hide();
        }
    });
</script>

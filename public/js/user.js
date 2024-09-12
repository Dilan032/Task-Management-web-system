/* this JS for when image file uploaded show that file uploaded or not */
document.querySelectorAll('input[type="file"]').forEach((input) => {
    input.addEventListener('change', (event) => {
        const fileInput = event.target;
        const fileId = fileInput.id;
        const spinner = document.getElementById(`spinner_${fileId.split('_')[1]}`);
        const checkmark = document.getElementById(`checkmark_${fileId.split('_')[1]}`);

        // Show spinner
        spinner.style.display = 'inline-block';
        checkmark.style.display = 'none';

        // Simulate file upload (You can use FormData and AJAX here)
        setTimeout(() => {
            // Hide spinner
            spinner.style.display = 'none';
            // Show checkmark
            checkmark.style.display = 'inline-block';
        }, 2000); // Simulate 2 seconds upload time
    });
});
    
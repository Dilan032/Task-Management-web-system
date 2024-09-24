<div class="d-flex flex-wrap align-items-center">
    <span class="badge text-bg-secondary fs-6 p-2 me-3">
        Total Company Employees: {{ $totalEmployees }}
    </span>
    <span class="badge text-bg-secondary fs-6 p-2 me-3">
        Total Registered Institutes: {{ $totalInstitutes }}
    </span>
    <span class="badge text-bg-secondary fs-6 p-2 me-3">
        Issues received today: {{ $issuesInToday }}
    </span>
    <button type="button" class="btn btn-warning ms-auto">
        <i class="fa-solid fa-triangle-exclamation fa-beat"></i>
        <span class="badge rounded-pill bg-danger">{{ $importantIssues->count() }}</span>
        Important
    </button>
</div>

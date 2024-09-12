@extends('layouts.superAdminLayout')

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('SuperAdminContent')

<div class="fs-3 ms-4">Institute Management</div>
<hr class="me-3">

<div class="container-fluid">

    {{-- Buttons for opening modals --}}
    <div class="d-grid gap-2 mb-4 d-md-flex justify-content-md-end">
        <button class="btn btn-success me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#registerInstituteModal">Register Institute</button>
        <button class="btn btn-primary me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#addInstituteTypeModal">Add Institute Type</button>
    </div>

    {{-- Modals --}}
    <div class="row">
        <div class="col-md-12 col-sm-4 mx-auto">
            {{-- Include the Register Institute modal --}}
            @include('components.superAdmin.institute.registerInstitute')
        </div>
        <div class="col-md-12 col-sm-4 mx-auto">
            {{-- Include the Add Institute Type modal --}}
            @include('components.superAdmin.institute.addInstituteType')
        </div>
    </div>

    @include('superAdmin.instituteManagement.overview')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection

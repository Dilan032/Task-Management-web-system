@extends('layouts.superAdminLayout')

@section('SuperAdminContent')

<div class="fs-3 ms-4">Institute</div>
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

</div>

@endsection

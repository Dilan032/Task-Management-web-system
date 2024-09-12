@extends('layouts.superAdminLayout')
@section('SuperAdminContent')

<div class="container d-flex justify-content-between">
    <div class="fs-4">edit Institute</div>
</div>

<hr class="me-3">

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



@endsection

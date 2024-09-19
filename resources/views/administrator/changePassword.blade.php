@extends('layouts.administratorLayout')
@section('administratorContent')

    <!-- Display validation errors -->
    @if ($errors->updatePassword->any())
        @foreach ($errors->updatePassword->all() as $error)
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "{{ $error }}",
                });
            </script>
        @endforeach
    @endif

    @if (session('status'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('status') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <div class="container mt-5">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-8 bg-primary-subtle messageBG rounded py-4 px-4">
                {{-- <p class="fs-3 mb-4">Profile</p> --}}
                <div class="bg-white py-3 px-5 messageBG rounded">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>

@endsection

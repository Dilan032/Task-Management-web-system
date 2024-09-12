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

<div class="row px-4 justify-content-around my-5">
    <div class="col-md-6 bg-primary-subtle text-dark rounded p-4 messageBG">
        <form action="{{ route('superAdmin.institute.update.view', $institute->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label"><small>Institute Name</small></label>
                <input type="text" name="institute_name" class="form-control" id="name" value="{{ old('name', $institute->institute_name) }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label"><small>Institute Address</small></label>
                <input type="text" name="institute_address" class="form-control" id="name" value="{{ old('name', $institute->institute_address) }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label"><small>Contact Number</small></label>
                <input type="text" name="institute_contact_num" class="form-control" id="name" value="{{ old('name', $institute->institute_contact_num) }}">
            </div>

            {{-- <label for="user_type" class="form-label">user_type</label>
            <select name="user_type" class="form-select mb-3" aria-label="Default select example">
                <option value="administrator" {{ old('user_type', $user->user_type) == 'administrator' ? 'selected' : '' }}>administrator</option>
                <option value="user" {{ old('status', $user->user_type) == 'user' ? 'selected' : '' }}>user</option>  
            </select> --}}

            <div class="mb-3">
                <label for="email" class="form-label"><small>Email</small></label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $institute->email) }}">
            </div>

        <div class="d-flex justify-content-end">
            <section>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary btn-sm me-md-2 m-1 px-3" type="submit">Update</button>
                </div>
        </form>
            </section>

            {{-- <section>
                <form action="{{ route('user.delete.for.admin', $user->id ) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-danger btn-sm m-1 px-3" onclick="return confirm('Are you sure you want to delete this user?');">
                            Remove
                        </button>
                    </div>
                </form>
            </section> --}}
        </div>

</div>


    @endsection
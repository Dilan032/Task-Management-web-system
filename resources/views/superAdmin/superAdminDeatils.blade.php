@extends('layouts.superAdminLayout')
@section('SuperAdminContent')

    <span class="fs-1">Super Admin Deails</span>

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
    

    <div class="row d-flex justify-content-center mt-4">
        {{-- @foreach ($superAdmin as $admin ) --}}
        <div class="col-md-6">
            <form action="{{route('superAdmin.details.update',$superAdmin->id )}}" method="POST" class="mx-auto px-2">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="user_type" value="super admin">
                <div class="row">
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" value="{{ old('name', $superAdmin->name) }}" class="form-control" id="floatingInput2" placeholder="User Name">
                            <label for="floatingInput2">User Name</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="{{ old('email', $superAdmin->email) }}" class="form-control" id="floatingInput3" placeholder="Email">
                            <label for="floatingInput3">Email</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="user_contact_num" value="{{ old('user_contact_num', $superAdmin->user_contact_num) }}"  class="form-control" id="floatingInput3" placeholder="User Contact Number">
                            <label for="floatingInput3">Contact Number</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" id="floatingInput2" placeholder="password" >
                            <label for="floatingInput2">Password</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" id="floatingInput2" placeholder="Confirm password" >
                            <label for="floatingInput2">Confirm Password</label>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                    
                </div>
            </form>
        </div>
        {{-- @endforeach --}}

    </div>

@endsection
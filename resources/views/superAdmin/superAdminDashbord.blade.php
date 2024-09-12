@extends('layouts.superAdminLayout')
@section('SuperAdminContent')

{{-- <div class="container d-flex justify-content-between"> --}}
    <div class="fs-3 ms-4">Dashbord</div>
{{-- </div> --}}

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

<div class="row">
    <div class="col-md-8">
        
        <div class="row bg-primary-subtle border-bottom border-black border-5 rounded shado">
            <p class="fs-5 p-1">Registered Institute <span class="badge text-bg-light px-4 problemImageMainBG">{{ $Numusers }}</span></p>
        </div>
        {{-- start new row --}}
        <div class="row mt-3 bg-primary-subtle border-bottom border-black border-5 rounded shado">
            <div class="col-md-6">
                <div class="p-2">
                    <p class="fs-5">All Messages <span class="badge text-bg-light px-4 problemImageMainBG">{{ $NumMsg }}</span></p>
                    <div class="p-3 bg-white text-dark  rounded shado">
                        <div class="d-flex justify-content-between px-4 mt-2">
                            ✔solved
                            <span class="badge text-bg-success px-5">{{ $NumMsgSolved }}</span>
                        </div>
                        <div class="d-flex justify-content-between px-4 mt-2">
                            ❌not solved
                            <span class="badge text-bg-warning px-5">{{ $NumMsgNotSolved }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-2">
                    <p class="fs-5"><span class="badge text-warning">.</span></p>
                    <div class="p-3 bg-white text-dark  rounded shado">
                        <div class="d-flex justify-content-between px-4 mt-2">
                            ⚙ Processing
                            <span class="badge text-bg-dark px-5">{{ $NumMsgProcessing }}</span>
                        </div>
                        <div class="d-flex justify-content-between px-4 mt-2">
                            👁 Viewed 
                            <span class="badge text-bg-info px-5">{{ $NumMsgViewed }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end new row --}}

        {{-- new row --}}
        <div class="p-2 mt-4 bg-primary-subtle border-bottom border-black border-5 rounded shado">
            <p class="fs-5">Registered users <span class="badge text-bg-light px-4 problemImageMainBG">{{ $Numusers }}</span></p>
            <div class="d-flex flex-column flex-sm-row gap-4">
                <div class="p-3 w-100 w-sm-50 bg-white text-dark rounded rounded shado">
                    <b>Administrators</b>
                    <div class="d-flex justify-content-between px-4 mt-2">
                        🙋‍♂️Active
                        <span class="badge text-bg-primary px-5 shado">{{ $NumActiveAdministrators }}</span>
                    </div>
                    <div class="d-flex justify-content-between px-4 mt-2">
                        🙇‍♂️Inactive
                        <span class="badge text-bg-secondary px-5 shado">{{ $NumAdministrators - $NumActiveAdministrators }}</span>
                    </div>
                </div>

                <div class="p-3 w-100 w-sm-50 bg-white text-dark rounded rounded shado">
                    <b>Users</b> 
                    <div class="d-flex justify-content-between px-4 mt-2">
                        🙋‍♂️Active
                        <span class="badge text-bg-primary px-5 shado">{{ $NumActiveUsers }}</span>
                    </div>
                    <div class="d-flex justify-content-between px-4 mt-2">
                        🙇‍♂️Inactive
                        <span class="badge text-bg-secondary px-5 shado">{{ $NumUsers - $NumActiveUsers }}</span>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <div class="col-md-4">
        <div class="mb-5">
            <span class="mt-4 fs-5">Super Admin Details</span>

            {{-- btn for super admin registration model --}}
            <div class="d-grid gap-2 mb-4 d-md-flex justify-content-end">
                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add super Admin</button>
            </div>
            {{-- include model --}}
            @include('components.superAdmin.users.registerSuperAdmin')
            {{-- end user registration section --}}

            @foreach ($superAdmin as $admin )
            <div class="col-md-12 mt-4">
                <p>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        👨‍💼User name : <b>{{ $admin->name }}</b>
                    </div>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        Email : <b>{{ $admin->email }}</b>
                    </div>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        Tp : <b>{{ $admin->user_contact_num }}</b>
                    </div>
                    
                    <form action="{{ route('superAdmin.SuperAdmin.delete', $admin->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-primary btn-sm px-4" href="{{ route('superAdmin.deails', $admin->id) }}" role="button">Edit Details</a>
                        <button class="btn btn-danger btn-sm px-4" type="submit" onclick="return confirm('Are you sure you want to delete this user?');">Remove</button>
                    </form>
                </p>
            </div>
            @endforeach
        </div>
        
    </div>


{{-- first row end --}}
</div>




@endsection
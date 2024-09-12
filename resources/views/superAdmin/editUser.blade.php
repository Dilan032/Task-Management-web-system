@extends('layouts.superAdminLayout')
@section('SuperAdminContent')

    <span class="fs-4">Edit Users</span> <br>
    <div class="d-flex justify-content-start ms-4">
        @if($user)
            <div class="badge text-bg-dark fs-6 px-4"> {{ $user->user_type }} {{ $user->name }} </div>
            <div class="mx-1">
                @if ($user->status == "active")
                    <span class="badge text-bg-success fs-6 px-4">{{ $user->status }}</span>
                @else
                    <span class="badge text-bg-secondary fs-6 px-4">{{ $user->status }}</span>
                @endif 
            </div>
        @else
            <p>👨‍💼</p>
        @endif
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

    <div class="row px-4 justify-content-around mb-5">
        <div class="col-md-6 bg-primary-subtle text-dark rounded p-4 messageBG">
            @if($user)
            <form action="{{ route('user.details.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label"><small>User name</small></label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                </div>

                <label for="user_type" class="form-label"><small>user type</small></label>
                <select name="user_type" class="form-select mb-3" aria-label="Default select example">
                    <option value="administrator" {{ old('user_type', $user->user_type) == 'administrator' ? 'selected' : '' }}>administrator</option>
                    <option value="user" {{ old('status', $user->user_type) == 'user' ? 'selected' : '' }}>user</option>  
                </select>

                <div class="mb-3">
                    <label for="email" class="form-label"><small>User email</small></label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                </div>

                <div class="mb-3">
                    <label for="cNumber" class="form-label"><small>User Contact Number</small></label>
                    <input type="text" name="user_contact_num" class="form-control" id="cNumber" value="{{ old('user_contact_num', $user->user_contact_num) }}">
                </div>

                <label for="status" class="form-label"><small>status</small></label>
                <select name="status" class="form-select mb-3 bg-success bg-opacity-50" aria-label="Default select example">
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>active</option>
                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>inactive</option>  
                </select>

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
                @else
                    <p class="text-center text-muted">No user data available.</p>
                @endif
            </div>

    </div>

    {{-- new colum --}}
    <div class="col-md-5 mt-1 bg-white text-dark userBgShado rounded p-4 allUserListBG">
        <p class="fs-6">All users</p>
        <div class="overflow-y-scroll" style="height: 415px;">
            @foreach ($adminDetails as $admins)
                <a href="{{ route('superAdmin.user.details',$admins->id) }}">
                    <div class="p-2 mb-2 bg-primary-subtle text-primary-emphasis userList rounded">
                        <div class="text-start">
                            <span class="badge text-bg-{{ $admins->status == 'active' ? 'success' : 'secondary' }}">{{ $admins->status }}</span> 
                            <span class="badge text-bg-dark">{{ $admins->user_type }}</span> <br>
                            <small>{{ $admins->name }}</small> <br>
                        </div>
                    </div>
                </a>
            @endforeach
            @foreach ($userDetails as $user)
                <a href="{{ route('superAdmin.user.details',$user->id) }}">
                    <div class="p-2 mb-2 bg-info-subtle text-primary-emphasis userList rounded">
                        <div class="text-start">
                            <span class="badge text-bg-{{ $user->status == 'active' ? 'success' : 'secondary' }}">{{ $user->status }}</span> 
                            <span class="badge text-bg-dark">{{ $user->user_type }}</span> <br>
                            <small>{{ $user->name }}</small> <br>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>

    




@endsection
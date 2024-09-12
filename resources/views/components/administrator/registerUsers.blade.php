
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
        timer: 3000
        });
    </script>
    @endif




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">User Registration Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <form action="{{route('RegisterUser.save')}}" method="POST" class="mx-auto px-2">
            @csrf

            <div class="row">
                <div class="col-md-12 col-sm-4">
                    <select name="institute_id" class="form-select form-select-lg mb-3 fs-6" aria-label="Large select example" required>
                        <option selected>Select Institute Name</option>
                        {{-- $institute variable used in super admin controller and for administrator i used administrator controller--}}
                        @if ($institute->isNotEmpty())
                            @foreach ($institute as $instituteDetails)
                                <option class="fw-bold" value="{{$instituteDetails->id}}" {{ old('institute_name') == $instituteDetails->institute_name ? 'selected' : '' }}> {{$instituteDetails->institute_name}} </option>
                            @endforeach
                        @endif  
                    </select>
                </div>
                <div class="col-md-12 col-sm-4">
                    <select name="user_type" class="form-select form-select-lg mb-3 fs-6" aria-label="Large select example" required>
                        <option selected>Select User Type</option>
                        <option value="administrator" class="fw-bold" {{ old('user_type') == 'administrator' ? 'selected' : '' }}>administrator</option>
                        <option value="user" class="fw-bold" {{ old('user_type') == 'user' ? 'selected' : '' }}>user</option>
                    </select>
                </div>
                <div class="col-md-12 col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="floatingInput2" placeholder="User Name">
                        <label for="floatingInput2">User Name</label>
                    </div>
                </div>
                <div class="col-md-12 col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="floatingInput3" placeholder="Email">
                        <label for="floatingInput3">Email</label>
                    </div>
                </div>
                <div class="col-md-12 col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" name="user_contact_num" value="{{ old('user_contact_num') }}"  class="form-control" id="floatingInput3" placeholder="User Contact Number">
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
                    <button class="btn btn-primary" type="submit">Register Now</button>
                </div>
                
            </div>
        </form>

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
        </div>
      </div>
    </div>
  </div>

    
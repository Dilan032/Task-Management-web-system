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




<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Institute Registration Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{route('RegisterInstitute.save')}}" method="POST" class="mx-auto px-2">
                @csrf
        
                <div class="row">
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="institute_name" value="{{ old('institute_name')}}" class="form-control" id="floatingInput1" placeholder="institute Name">
                            <label for="floatingInput1">Institute Name</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="institute_address" value="{{old('institute_address')}}" class="form-control" id="floatingInput2" placeholder="institute address">
                            <label for="floatingInput2">Address</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="institute_contact_num" value="{{old('institute_contact_num')}}" class="form-control" id="floatingInput3" placeholder="institute Contact Number">
                            <label for="floatingInput3">Contact Number</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="{{old('email')}}" class="form-control" id="floatingInput4" placeholder="Email">
                            <label for="floatingInput4">Email</label>
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
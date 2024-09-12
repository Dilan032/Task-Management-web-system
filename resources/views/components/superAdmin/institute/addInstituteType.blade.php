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


<!-- Modal for Adding Institute Type -->
<div class="modal fade" id="addInstituteTypeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addInstituteTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addInstituteTypeModalLabel">Add Institute Type</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form action="{{route('AddInstituteType.save')}}" method="POST" class="mx-auto px-2">
                @csrf

                <div class="row">
                    <div class="col-md-12 col-sm-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="institute_type" value="{{ old('institute_type')}}" class="form-control" id="floatingInput1" placeholder="Institute Type">
                            <label for="floatingInput1">Institute Type</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Add</button>
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

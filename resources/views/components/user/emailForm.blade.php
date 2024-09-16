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

    <div class="row">
        <div class="col-md-8">
            <section class="p-3 bg-primary-subtle text-black border-bottom border-dark border-5 rounded messageBG">
                <p class="fs-5 mb-3 text-center fw-lighter">Put the problem here to sent</p>

                <form action="{{ route('message.save') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    @if (Auth::check())
                        <!-- Hidden input for institute_id -->
                        <input type="hidden" name="institute_id" value="{{ $user = Auth::user()->institute_id }}">
                    @else
                        <script>
                            window.location = "/";
                        </script>
                    @endif

                    <div class="form-floating mb-3 messageBG">
                        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                            id="floatingInput" placeholder="Subject">
                        <label for="floatingInput">Subject</label>
                    </div>
                    <div class="form-floating messageBG">
                        <textarea class="form-control" name="message" value="{{ old('message') }}" placeholder="Message" id="floatingTextarea2"
                            style="height: 250px"></textarea>
                        <label for="floatingTextarea2">Message</label>
                    </div>
                </form>
        </div>

        <div class="col-md-4">
            <br> <br> <br>
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>Upload Images</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                    Upload pictures where there are problems
                </figcaption>
            </figure>

            <div class="d-flex justify-content-around">
                <section>
                    <div class="bg-white  rounded p-2 imgBg">
                        <label for="file_1" class="ionHover">
                            <i class="bi bi-image-fill fs-1"></i>
                        </label>
                        <input type="file" class="d-none" name="img_1" id="file_1">
                    </div>
                    {{-- this style for when image file uploaded show that file uploaded or not --}}
                    <div class="ms-4 mt-2">
                        <div class="spinner-border spinner-border-sm" id="spinner_1" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <i class="bi bi-check-circle checkmark" id="checkmark_1"></i>
                    </div>
                </section>

                <section>
                    <div class="bg-white  rounded p-2 imgBg">
                        <label for="file_2" class="ionHover">
                            <i class="bi bi-image-fill fs-1"></i>
                        </label>
                        <input type="file" class="d-none" name="img_2" id="file_2">
                    </div>
                    {{-- this style for when image file uploaded show that file uploaded or not --}}
                    <div class="ms-4 mt-2">
                        <div class="spinner-border spinner-border-sm" id="spinner_2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <i class="bi bi-check-circle checkmark" id="checkmark_2"></i>
                    </div>
                </section>

                <section>
                    <div class="bg-white  rounded p-2 imgBg">
                        <label for="file_3" class="ionHover">
                            <i class="bi bi-image-fill fs-1"></i>
                        </label>
                        <input type="file" class="d-none" name="img_3" id="file_3">
                    </div>
                    {{-- this style for when image file uploaded show that file uploaded or not --}}
                    <div class="ms-4 mt-2">
                        <div class="spinner-border spinner-border-sm" id="spinner_3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <i class="bi bi-check-circle checkmark" id="checkmark_3"></i>
                    </div>
                </section>

                <section>
                    <div class="bg-white  rounded p-2 imgBg">
                        <label for="file_4" class="ionHover">
                            <i class="bi bi-image-fill fs-1"></i>
                        </label>
                        <input type="file" class="d-none" name="img_4" id="file_4">
                    </div>
                    {{-- this style for when image file uploaded show that file uploaded or not --}}
                    <div class="ms-4 mt-2">
                        <div class="spinner-border spinner-border-sm" id="spinner_4" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <i class="bi bi-check-circle checkmark" id="checkmark_4"></i>
                    </div>
                </section>

                <section>
                    <div class="bg-white  rounded p-2 imgBg">
                        <label for="file_5" class="ionHover">
                            <i class="bi bi-image-fill fs-1"></i>
                        </label>
                        <input type="file" class="d-none" name="img_5" id="file_5">
                    </div>
                    {{-- this style for when image file uploaded show that file uploaded or not --}}
                    <div class="ms-4 mt-2">
                        <div class="spinner-border spinner-border-sm" id="spinner_5" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <i class="bi bi-check-circle checkmark" id="checkmark_5"></i>
                    </div>
                </section>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto mt-4">
                <button class="btn btn-primary" type="submit">Send Message</button>
            </div>
            </form>
            </section>

        </div>
    </div>

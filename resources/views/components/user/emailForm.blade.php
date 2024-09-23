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
    <!-- Form for sending message to administrator -->
    <form action="{{ route('message.save') }}" method="POST" enctype="multipart/form-data" class="row">
        @csrf

        <!-- Message Section -->
        <div class="col-md-8">
            <section class="p-3 bg-primary-subtle text-black border-bottom border-dark border-5 rounded messageBG">
                <p class="fs-5 mb-3 text-center fw-lighter">Put the problem here to send</p>

                <!-- Hidden input for institute_id -->
                <input type="hidden" name="institute_id" value="{{ Auth::user()->institute_id }}">

                <!-- Subject Input -->
                <div class="form-floating mb-3 messageBG">
                    <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                        id="floatingInput" placeholder="Subject" required>
                    <label for="floatingInput">Subject</label>
                </div>

                <!-- Message Textarea -->
                <div class="form-floating messageBG">
                    <textarea class="form-control" name="message" placeholder="Message" id="floatingTextarea2" style="height: 250px"
                        required>{{ old('message') }}</textarea>
                    <label for="floatingTextarea2">Message</label>
                </div>
            </section>
        </div>

        <!-- Image Upload Section -->
        <div class="col-md-4">
            <section class="p-3">
                <figure class="text-center">
                    <blockquote class="blockquote">
                        <p>Upload Images</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        Upload pictures where there are problems
                    </figcaption>
                </figure>

                <div class="d-flex justify-content-around gap-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <section>
                            <div class="bg-white rounded p-2 imgBg">
                                <label for="file_{{ $i }}" class="ionHover">
                                    <i class="bi bi-image-fill fs-1"></i>
                                </label>
                                <input type="file" class="d-none" name="img_{{ $i }}"
                                    id="file_{{ $i }}">
                            </div>
                            <div class="ms-4 mt-2">
                                <div class="spinner-border spinner-border-sm" id="spinner_{{ $i }}"
                                    role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="bi bi-check-circle checkmark" id="checkmark_{{ $i }}"></i>
                            </div>
                        </section>
                    @endfor
                </div>
            </section>

            <!-- Submit Button -->
            <div class="d-grid gap-2 col-12 mx-auto mt-4">
                <button class="btn btn-primary" type="submit">Send Message</button>
            </div>
        </div>


    </form>
</div>

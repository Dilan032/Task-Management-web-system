<!-- Modal -->
{{-- <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Put the problem here to sent</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('superAdmin.messages.save') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Institute Dropdown -->
                            <div class="form-floating mb-3 userBgShado">
                                <select name="institute_id" class="form-select" id="instituteSelect">
                                    <option value="">None</option>
                                    @foreach ($institutes as $institute)
                                    <option value="{{ $institute->id }}">{{ $institute->institute_name }}</option>
                                    @endforeach
                                </select>
                                <label for="instituteSelect">Select Institute</label>
                            </div>

                            <div class="form-floating mb-3 userBgShado">
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                                    id="floatingInput" placeholder="Subject">
                                <label for="floatingInput">Subject</label>
                            </div>
                            <div class="form-floating userBgShado">
                                <textarea class="form-control" name="message" value="{{ old('message') }}" placeholder="Message" id="floatingTextarea2"
                                    style="height: 250px"></textarea>
                                <label for="floatingTextarea2">Message</label>
                            </div>

                            <div class="d-grid gap-2 mx-auto mt-4">
                                <button class="btn btn-primary" type="submit">Send Message</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                    </div>


                    <div class="col-md-4">
                        <br> <br> <br>
                        <div class="text-center mb-3 mt-4">
                            <h3 class="fw-normal">Upload Images</h3>
                            <span class="font-monospace"><small>(Upload pictures where there are
                                    problems)</small></span>
                        </div>

                        <div class="d-flex justify-content-around">
                            <section>
                                <div class="bg-white  rounded p-2 imgBg">
                                    <label for="file_1" class="ionHover">
                                        <i class="bi bi-image-fill fs-1"></i>
                                    </label>
                                    <input type="file" class="d-none" name="img_1" id="file_1">
                                </div>
                                {{-- this style for when image file uploaded show that file uploaded or not --}}
                                {{-- <div class="ms-4 mt-2">
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
                                {{-- <div class="ms-4 mt-2">
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
                                </div> --}}
                                {{-- this style for when image file uploaded show that file uploaded or not --}}
                                {{-- <div class="ms-4 mt-2">
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
                                </div> --}}
                                {{-- this style for when image file uploaded show that file uploaded or not --}}
                                {{-- <div class="ms-4 mt-2">
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
                                </div> --}}
                                {{-- this style for when image file uploaded show that file uploaded or not --}}
                                {{-- <div class="ms-4 mt-2">
                                    <div class="spinner-border spinner-border-sm" id="spinner_5" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <i class="bi bi-check-circle checkmark" id="checkmark_5"></i>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

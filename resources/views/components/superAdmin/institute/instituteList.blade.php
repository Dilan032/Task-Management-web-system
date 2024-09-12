<div class="fs-4 text-center mt-4">
    <p>Institute Details</p>
</div>


<div class="px-2">
    <div class="p-2 mb-2 bg-black text-white rounded">
        <div class="d-flex justify-content-between">
            <div>ID | Institute Name | Address</div>
            <div>View</div>
        </div>
    </div>

    <div class="accordion accordion-flush" id="accordionFlushExample">
        @if ($institute->isNotEmpty())
            @foreach ($institute as $key => $instituteDetails)
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="flush-heading{{ $key }}">
                        <button class="accordion-button collapsed d-flex justify-content-between align-items-center border-bottom border-dark rounded shado" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $key }}" aria-expanded="false" aria-controls="flush-collapse{{ $key }}">
                            <div class="w-100 d-flex justify-content-between align-items-center">
                                {{-- <div>
                                    <span class="badge text-bg-dark">{{ $instituteDetails->id }}</span>
                                    <span class="ms-2">{{ $instituteDetails->institute_name }},</span>
                                    <span class="ms-2"><small>{{ $instituteDetails->institute_address }}</small></span>
                                </div>  --}}
                                <div></div>
                            </div>
                        </button>                       
                    </h2>
                    <div id="flush-collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $key }}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body ">
                            <div class="bg-light text-dark px-4">

                                <div class="row">
                                    <div class="col">
                                        {{-- <span class="fw-light"> institute Details </span> <br> --}}
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-primary">
                                              <tr>
                                                <td scope="col">Institute Name</td>
                                                <td scope="col">Address</td>
                                                <td scope="col">Email</td>
                                                <td scope="col">Contact Number</td>
                                              </tr>
                                            </thead>
                                            {{-- <tbody class="fw-light">
                                                <td scope="col">{{ $instituteDetails->institute_name }}</td>
                                                <td scope="col">{{ $instituteDetails->institute_address }}</td>
                                                <td scope="col">{{ $instituteDetails->email }}</td>
                                                <td scope="col">{{ $instituteDetails->institute_contact_num }}</td>
                                            </tbody> --}}
                                        </table>
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="row">
                                    <div class="col">
                                        {{-- <span class="fw-light"> Administrators </span> <br> --}}
                                        <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-primary">
                                              <tr>
                                                <td scope="col" style="width: 30%">Administrators</td>
                                                <td scope="col">Contact Number</td>
                                                <td scope="col" class="text-center">status</td>
                                                <td scope="col"></td>
                                                <td scope="col"></td>
                                              </tr>
                                            </thead>
                                            <tbody>
                                           
                                               

                

            @endforeach
        @endif
    </div>
</div>
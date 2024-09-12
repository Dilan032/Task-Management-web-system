@extends('layouts.administratorLayout')
@section('administratorContent')

<span class="fs-4 ms-4">Dashbord</span>

<hr class="me-3">

<div class="row ps-2">
    <div class="col-md-8">
        <div class="p-1 userBgShado rounded border-bottom border-black border-5">
            <p class="fs-4">Institute details</p>
            <div class="fs-5">
                <span class="badge bg-primary-subtle text-dark m-1 p-2 pe-5 btnShado fw-lighter">{{ $institute->institute_name }}</span>
                <span class="badge bg-primary-subtle text-dark m-1 p-2 pe-5 btnShado fw-lighter">Branch name</span>
                <span class="badge bg-primary-subtle text-dark m-1 p-2 pe-5 btnShado fw-lighter">{{ $institute->institute_address }}</span>
                <br> 
                <span class="badge bg-primary-subtle text-dark m-1 p-2 pe-5 btnShado fw-lighter">{{ $institute->email }}</span>
                <span class="badge bg-primary-subtle text-dark m-1 p-2 pe-5 btnShado fw-lighter">{{ $institute->institute_contact_num }}</span>
                <br>
            </div>
        </div>

                {{-- new row --}}
                <div class="p-3 mb-2 mt-4 bg-primary-subtle text-primary-emphasis border-bottom border-black border-5 rounded btnShado">
                    <p class="fs-4">All Registered Employees <span class="badge text-bg-light px-4 btnShado">{{ $NumAdministrators + $NumUsers }}</span></p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        
                        <div class="p-1 w-100 w-sm-50 bg-white text-dark rounded btnShado rounded">
                            | Administrators &nbsp;&nbsp;&nbsp;<span class="badge bg-primary-subtle text-dark px-3 btnShado">{{ $NumAdministrators }}</span> 
                            <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                                 🙋‍♂️Active
                                <span class="badge text-bg-warning px-5">{{ $NumActiveAdministrators }}</span>
                            </div>
                            <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                                🙇‍♂️Inactive
                                <span class="badge text-bg-success px-5">{{ $NumInactiveAdministrators }}</span>
                            </div>
                        </div>
        
                        <div class="p-1 w-100 w-sm-50 bg-white text-dark rounded btnShado rounded">
                            | Users &nbsp;&nbsp;&nbsp;<span class="badge bg-primary-subtle text-dark px-3 btnShado">{{ $NumUsers }}</span>
                            <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                                🙋‍♂️Active
                                <span class="badge text-bg-success px-5">{{ $NumActiveUsers }}</span>
                            </div>
                            <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                                🙇‍♂️Inactive
                                <span class="badge text-bg-warning px-5">{{ $NumInactiveUsers }}</span>
                            </div>
                        </div>
        
                    </div>
                </div>

        {{-- new row --}}
        <div class="p-3 mb-2 mt-4 bg-primary-subtle text-primary-emphasis border-bottom border-black border-5 rounded btnShado">
            <div class="d-flex justify-content-between">
                <p class="fs-4">Messages <span class="badge text-bg-light px-4 btnShado">{{ $NumMessages }}</span></p>

                <select class="form-select w-25 h-25 border border-primary" aria-label="Default select example">
                    <option selected>Today</option>
                    <option value="1">Yesterday</option>
                    <option value="2">Last Week</option>
                    <option value="3">Last Month</option>
                    <option value="4">Last Year</option>
                    <option value="5">All</option>
                </select>
                {{-- <i class="bi bi-search"></i> --}}
            </div>

            <div class="d-flex flex-column flex-sm-row gap-3">
                
                <div class="p-1 w-100 w-sm-50 bg-white text-dark rounded btnShado rounded">
                    | Administrator Request 
                    <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                        ⏳Pending
                        <span class="badge text-bg-warning px-5">{{ $NumPendingMsg }}</span>
                    </div>
                    <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                        ✔Accept
                        <span class="badge text-bg-success px-5">{{ $NumAcceptMsg }}</span>
                    </div>
                    <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                        ❌Rejected
                        <span class="badge text-bg-danger px-5 mb-2">{{ $NumRejectMsg }}</span>
                    </div>
                </div>

                <div class="p-1 w-100 w-sm-50 bg-white text-dark rounded btnShado rounded">
                    | Nanosoft Solutions (Pvt)Ltd Status 
                    <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                        ✔solved
                        <span class="badge text-bg-success px-5">{{ $NumSolvedMsg }}</span>
                    </div>
                    <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                        ❌not solved
                        <span class="badge text-bg-warning px-5">{{ $NumNotSolvedMsg }}</span>
                    </div>
                    <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                        ⚙ Processing
                        <span class="badge text-bg-dark px-5">{{ $NumProcessing }}</span>
                    </div>
                    <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                        👁 Viewed 
                        <span class="badge text-bg-info px-5">{{ $NumViewed }}</span>
                    </div>
                </div>

            </div>
        </div>

    {{-- first col end --}}
    </div>

    <div class="col-md-4">
        <div class="p-1">
            <div class="p-3 mb-2 bg-white text-dark rounded">
                <img src="{{ asset('images/CompanyLogo/nanosoftSolutions Company Logo.png') }}" alt="NanosoftSolutions Logo">
                <p class="fs-5 fw-bold">Nanosoft Solutions <small>(Pvt) Ltd</small></p>

                <div class="overflow-y-scroll" style="height: 440px;">
                    
                <p>
                    අප සමගම පරිගණක මෘදුකාංග නිර්මාණය කිරීමෙහිලා විශේෂිත වූ ආයතනයකි. 
                    අප ආයතනය මගින් <br>
                    සමුපකාර තොග ගබඩා, කෝප් සිටි, කුෂුද්‍ර මුල්‍ය ආයතන
                    සදහා විශේෂයෙන් සැකසු මුදුකාංග පද්ධතින් සපයනු ලබන අතර,
                    <ul>
                        <li>වැටුප් සැකසීම්</li>
                        <li>මානව සම්පත් කළමනාකරණ</li>
                        <li>කළමනාකරණ තොරතුරු පද්ධති</li>
                        <li>ආරක්‍ෂිත කැමරා පද්ධති</li>
                        <li>වාහන නිරීක්ෂණ පද්ධති</li>
                        <li>ස්වයංක්‍රීය දුරස්ථ පාලන පද්ධති</li>
                    </ul>
                    ආදී සියලු අංශයන්ට අදාල මෘදුකාංග සහ දෘඩාංග විශ්වසනියව ලබාදීමට කටයුතු කරයි.
                </p>

                <hr>

                <p class="text-center bg-primary-subtle p-1">Contact Details</p>
                <p>
                    <span class="fs-6">Contact Number</span> <br>
                    @foreach ($superAdminDetails as $superAdmin )
                        <span class="fw-lighter">📞{{ $superAdmin->user_contact_num }}</span> <br>
                    @endforeach
                </p>
                <p>
                    <span class="fs-6">Email</span> <br>
                    @foreach ($superAdminDetails as $superAdmin )
                    <span class="fw-lighter">📧{{ $superAdmin->email }}</span> <br>
                    @endforeach
                </p>

                <p>
                    <span class="fs-6">Address:</span> <br>
                    <span class="fw-lighter">
                        No.227/A, <br>
                        Gettuwana Road, <br>
                        Kurunegala.
                    </span>
                </p>


            </div>
            </div>
        </div>
    </div>


{{-- first row end --}}
</div>



@endsection
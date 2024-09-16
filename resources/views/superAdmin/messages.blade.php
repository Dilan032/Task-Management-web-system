@extends('layouts.superAdminLayout')
@section('SuperAdminContent')

{{-- <div class="container d-flex justify-content-between"> --}}
    <div class="fs-3 ms-4">message</div>
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



    <div class="row mt-3 mb-4 d-flex justify-content-center">
        <div class="col-md-12">
            <div class="p-2 mb-2 bg-white text-black rounded shado">

                <div class="text-center">
                    <p class="fs-4">All Messages <span class="badge text-bg-light px-5 problemImageMainBG">{{$solvedMessageCount + $noSolvedMessageCount + $ViewedMessageCount + $processingMessageCount}}</span></p>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="d-flex p-2 mb-2 bg-light  text-black text-dark rounded justify-content-between">
                            <div class="p-2">
                                👁 Viewed
                                <span class="badge text-bg-info">{{$ViewedMessageCount}}</span>
                            </div>
                            <div class="p-2">
                                ❌ Not Solved
                                <span class="badge text-bg-danger">{{$noSolvedMessageCount}}</span>
                            </div>
                            <div class="p-2">
                                ⚙ Processing
                                <span class="badge text-bg-warning">{{$processingMessageCount}}</span>
                            </div>
                            <div class="p-2">
                                ✔ Solved
                                <span class="badge text-bg-success">{{$solvedMessageCount}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



<section class="px-4 mb-4">
    <div class="p-2 mb-2 bg-white text-black rounded shado">
        <div class="text-center d-none d-sm-inline">
            <div class="row">
                <div class="col-12 col-sm-auto col-md-1" >
                    <span class="">Date</span>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    <span class="">Assign</span>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    <span class="">Priority</span>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    <span class="">Progress</span>
                </div>
                <div class="col-12 col-sm-auto col-md-2">
                    <span class="">Institute Name</span>
                </div>
                <div class="col-12 col-sm-auto col-md-2">
                    <span class="">Institute Type</span>
                </div>
                <div class="col-12 col-sm-auto col-md-3">
                    <span class="">Subject</span>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    <span class="">Action</span>
                </div>
            </div>
        </div>
    </div>

    {{-- in mobile view show this title --}}
    <div class="fs-4 text-center mb-4">
        <p class="d-inline d-sm-none">All Institute Messages</p>
    </div>

    @if (!empty($messagesAndInstitute))
    @foreach ($messagesAndInstitute as $oneMessage)
    {{-- start message content --}}
    <div class="p-1 mb-2 bg-primary-subtle text-dark messageBG rounded">
        <div class="text-center">
            <div class="row">
                <div class="col-12 col-sm-auto col-md-1">
                    <small>{{ \Carbon\Carbon::parse($oneMessage->created_at)->format('Y M d') }}</small>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    <span class="">amal</span>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    <span class="">Priority</span>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    @if ( $oneMessage->status == 'not resolved')
                        <span class="badge rounded-pill text-bg-warning py-1"><small>{{$oneMessage->status}}</small></span>
                    @elseif ( $oneMessage->status == 'solved')
                        <span class="badge rounded-pill text-bg-success py-1 px-4"><small>{{$oneMessage->status}}</small></span>
                    @elseif ($oneMessage->status == 'Processing')
                        <span class="badge rounded-pill text-bg-dark py-1 px-3"><small>{{$oneMessage->status}}</small></span>
                    @else
                        <span class="badge rounded-pill text-bg-info text-dark py-1 px-4"><small>{{$oneMessage->status}}</small></span>
                    @endif
                </div>
                <div class="col-12 col-sm-auto col-md-2">
                    <small>{{ $oneMessage->institute->institute_name ?? 'No institute Name Available' }}</small>
                </div>
                <div class="col-12 col-sm-auto col-md-2">
                    <small>institute type</small>
                </div>
                <div class="col-12 col-sm-auto col-md-3">
                        <small>{{ $oneMessage->subject }}</small>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    <!-- Button trigger modal -->
                    <div class="d-grid gap-2 btnShado">
                        <a href="{{route('superAdmin.one.messages.view', $oneMessage->id)}}" class="btn btn-primary btn-sm" type="button">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
        <center><p>No messages found</p></center>
    @endif
</section>


@endsection

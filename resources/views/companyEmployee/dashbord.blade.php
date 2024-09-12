@extends('layouts.userLayout')
@section('userContent')

    {{-- <div class="d-flex justify-content-between bg-primary-subtle p-1">
        <p class="fs-3 ">Nanosoft Solutions </p>
        <div class="dropdown text-start mt-3">
            <a class="px-5 py-1 border text-dark"  data-bs-toggle="dropdown" aria-expanded="false">
            @if(Auth::check())
                <span><b>{{ Auth::user()->name }} 🔽</b></span> <br>
            @else
                <script>window.location = "/";</script>
            @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-center">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a href="{{route('user.logout')}}" class="active">Logout</a></li>
            </ul>
        </div>
    </div> --}}

    <div class="d-flex justify-content-around mt-5 mb-4">
        <div class="fs-4 ms-4">Priority</div>
        <div class="fs-4 ms-4">Institute</div>
        <div class="fs-4 ms-4">date</div>
        <div class="fs-4 ms-4">filter section</div>
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
            timer: 3000
            });
        </script>
        @endif

<div class="container">
            
    <section class="mt-2">
        <div class="p-2 mb-3 bg-black text-white">
            <div class="text-center d-none d-sm-inline">
                <div class="row">
                    <div class="col-12 col-sm-auto col-md-2">
                        <span class="">Date</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Priority</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-3">
                        <span class="">Institute</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-4">
                        <span class="">Address</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Progess</span> 
                        {{-- in database 'status' column in hear show --}}
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Action</span>
                    </div>
                </div>
            </div>
        </div>
        
        @if (!empty($messages))
        @foreach ($messages as $oneMessage)
        {{-- start message content --}}
        <div class="p-1 mb-3 bg-white text-dark messageBG rounded">
            <div class="text-center">
                <div class="row">
                    <div class="col-12 col-sm-auto col-md-2">
                        <small>{{ \Carbon\Carbon::parse($oneMessage->created_at)->format('d M Y') }}</small>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        pppp
                    </div>
                    <div class="col-12 col-sm-auto col-md-3">
                       {{  $oneMessage->institute->institute_name }}
                    </div>
                    <div class="col-12 col-sm-auto col-md-4">
                        address
                    </div>
                    
                       
                    <div class="col-12 col-sm-auto col-md-1">
                        @if ( $oneMessage->status == 'not resolved')
                            <span class="badge rounded-pill text-bg-warning btnInset py-1">{{$oneMessage->status}}</span>
                        @elseif ( $oneMessage->status == 'solved')
                            <span class="badge rounded-pill text-bg-success btnInset py-1 px-4">{{$oneMessage->status}}</span>
                        @elseif ($oneMessage->status == 'Processing')
                            <span class="badge rounded-pill text-bg-dark btnInset py-1">{{$oneMessage->status}}</span>
                        @else
                            <span class="badge rounded-pill text-bg-info btnInset text-dark py-1 px-3">{{$oneMessage->status}}</span>
                        @endif    
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <!-- Button trigger modal -->
                        <div class="d-grid gap-2 btnShado">
                            <a href="{{route('message', $oneMessage->id)}}" class="btn btn-primary btn-sm" type="button">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <p>No messages found</p>
        @endif
    </section>
</div>


@endsection
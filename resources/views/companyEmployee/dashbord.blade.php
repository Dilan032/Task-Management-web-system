@extends('layouts.companyUserLayout')
@section('companyEmployeeContent')

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
            timer: 2000
            });
        </script>
        @endif

        <div class="container mt-3 mb-5">
            <form method="GET" action="">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label ms-2">Priority</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Priority</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="start_date" class="form-label ms-2">Institute</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Priority</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control datepicker" placeholder="YYYY-MM-DD" required>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary px-3">Filter</button>
                        <button type="submit" class="btn btn-warning px-3">Reset</button>
                    </div>
                </div>
            </form>
        </div>

<div class="container mb-5">
            
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
                            <span class="badge rounded-pill text-bg-dark btnInset py-1 px-2">{{$oneMessage->status}}</span>
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
            <p>No Task found</p>
        @endif
    </section>
</div>


@endsection
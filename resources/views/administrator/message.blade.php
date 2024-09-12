@extends('layouts.administratorLayout')
@section('administratorContent')


<div class="fs-4 ms-4">message</div>

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
    <div class="d-grid gap-2 justify-content-end mt-3 mb-4 me-sm-3">
        <button class="btn btn-primary mt-3 btnShado" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Write a message</button>
    </div>
        
    @include('components.administrator.messageModel')
    
    
    <div class="bg-warning-subtle text-dark text-center fw-lighter">
        <small>
            It is the manager's responsibility to confirm or reject messages. 
            After confirming the message, Nanosoft Solutions will receive the message.
        </small>
    </div>
    
    
    <section class="mt-2">
        <div class="p-2 mb-3 bg-black text-white">
            <div class="text-center d-none d-sm-inline">
                <div class="row">
                    <div class="col-12 col-sm-auto col-md-2">
                        <span class="">Date</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Request</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-6">
                        <span class="">Subject</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-2">
                        <span class="">Status</span>
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
                        @if ( $oneMessage->request == 'accept')
                            <span class="badge rounded-pill text-bg-success btnInset py-1 px-3">{{ $oneMessage->request }}</span>     
                        @elseif ($oneMessage->request == 'reject')    
                            <span class="badge rounded-pill text-bg-danger btnInset py-1 px-3">{{ $oneMessage->request }}</span>
                        @else
                            <span class="badge rounded-pill text-bg-warning btnInset py-1">{{ $oneMessage->request }}</span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-auto col-md-6">
                        <span>
                            <small>{{ $oneMessage->subject }}</small>
                        </span>  
                    </div>
                    <div class="col-12 col-sm-auto col-md-2">
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
                            <a href="{{route('oneMessageForAdministrator.show', $oneMessage->id)}}" class="btn btn-primary btn-sm" type="button">View</a>
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
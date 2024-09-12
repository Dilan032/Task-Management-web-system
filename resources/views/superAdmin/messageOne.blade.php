@extends('layouts.superAdminLayout')
@section('SuperAdminContent')

<div class="d-flex justify-content-between mt-3">
    <p class="fs-4">
        {{$oneMessage->institute->institute_name}} Message
        {{-- <span class="badge text-bg-dark">{{$oneMessage->user->user_type}}</span> 
        {{$oneMessage->user->name}}'s message of 
        <span class="bg-dark-subtle p-1 px-2">{{$oneMessage->institute->institute_name}}</span> |
        <small class="bg-dark-subtle p-1 px-2">{{$oneMessage->institute->institute_address}}</small> --}}
    </p>  
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
    timer: 1000
    });
</script>
@endif

<div class="d-grid gap-2 d-flex justify-content-end mb-4">
    
    <div class="dropdown-center">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Centered dropdown
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Action two</a></li>
          <li><a class="dropdown-item" href="#">Action three</a></li>
        </ul>
    </div>

<!-- Example split danger button -->
<div class="btn-group me-5">
    <form action="{{ route('superAdmin.problem.resolved.or.not', $oneMessage->id ) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" value="solved">
        <button type="submit" class="btn btn-success px-4" onclick="return confirm('A text message will also be sent to the institute');">Solved</button>
    </form>

    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-dark">
        <form action="{{ route('superAdmin.problem.resolved.or.not', $oneMessage->id ) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="Processing">
            <li><button class="dropdown-item" type="submit" href="#">Processing</button></li>
        </form>
        <form action="{{ route('superAdmin.problem.resolved.or.not', $oneMessage->id ) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="Viewed">
            <li><button class="dropdown-item" type="submit" href="#">Viewed</button></li>
        </form>
        {{-- <form action="{{ route('superAdmin.problem.resolved.or.not', $oneMessage->id ) }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="not resolved">
            <li><button class="dropdown-item" type="submit" href="#">Not Solved</button></li>
        </form> --}}
    </ul>
  </div>
        
</div>

      
<section class="container">
    <div class="table-responsive">
        <table class="table table-borderless rounded messageBG">
            <thead>
              <tr>
                <td colspan="4" class="fs-5">
                    {{$oneMessage->subject}}
                </td>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <td colspan="4" class="bg-primary-subtle">
                    @if ( $oneMessage->status == 'not resolved')
                        status  <span class="badge text-bg-warning py-2">{{$oneMessage->status}}</span>
                    @elseif ( $oneMessage->status == 'solved')
                        status  <span class="badge text-bg-success py-2 px-4">{{$oneMessage->status}}</span>
                    @elseif ($oneMessage->status == 'Processing')
                        status  <span class="badge text-bg-dark py-2">{{$oneMessage->status}}</span>
                    @else
                        status  <span class="badge text-bg-info text-dark py-2 px-4">{{$oneMessage->status}}</span>
                    @endif 
                </td>
              </tr>
              <tr>
                <td colspan="4">
                    <span class="fs-5">message:</span> <br>
                     <span class="fw-lighter">{{$oneMessage->message}}</span>
                </td>
              </tr>
            </tbody>
          </table>
    
            <div class="text-end me-2 fw-light">
                <p>
                    <span class="badge bg-secondary-subtle text-dark px-4 py-2 fw-light">
                        📅 {{ \Carbon\Carbon::parse($oneMessage->created_at)->format('d M Y ') }}  &nbsp;&nbsp;
                        ⏱ {{ \Carbon\Carbon::parse($oneMessage->created_at)->format('h:i A') }}
                    </span>
                </p>
            </div>
    </div>
    
          
    
          <!-- Thumbnail Images -->
          <div class="container mt-4 mb-5">
            <p class="fw-light">Pictures of the problem areas :</p>
            <div class="p-3 mb-2 bg-primary-subtle text-secondary-emphasis problemImageMainBG rounded">
                <div class="row d-flex justify-content-center mx-auto">
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_1) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal1">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_2) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal2">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_3) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal3">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_4) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal4">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_5) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal5">
                    </div>
                </div>
            </div>
        </div>
    
    
         <!-- Modals -->
         <div class="modal fade" id="imageModal1" tabindex="-1" aria-labelledby="imageModalLabel1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                  <div class="modal-body">
                      <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_1) }}" alt="Full Image 1" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
    
      <div class="modal fade" id="imageModal2" tabindex="-1" aria-labelledby="imageModalLabel2" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                  <div class="modal-body">
                      <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_2) }}" alt="Full Image 2" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
    
      <div class="modal fade" id="imageModal3" tabindex="-1" aria-labelledby="imageModalLabel3" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                  <div class="modal-body">
                      <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_3) }}" alt="Full Image 3" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
    
      <div class="modal fade" id="imageModal4" tabindex="-1" aria-labelledby="imageModalLabel4" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                  <div class="modal-body">
                      <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_4) }}" alt="Full Image 4" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
    
      <div class="modal fade" id="imageModal5" tabindex="-1" aria-labelledby="imageModalLabel5" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                  <div class="modal-body">
                      <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_5) }}" alt="Full Image 5" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
</section>

<hr>

{{-- institute Details --}}
<div class="container">
    <div class="row mb-5 mt-5 px-3 d-flex justify-content-evenly">
        <div class="col-md-6 fw-light">
            <span class="fs-5 fw-normal">Institute Details</span>
            <p>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    Name : {{$oneMessage->institute->institute_name}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    Address : {{$oneMessage->institute->institute_address}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    Contact Number : {{$oneMessage->institute->institute_contact_num}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    Email : {{$oneMessage->institute->email}}
                </div>
            </p>
        </div>
        <div class="col-md-6 fw-light">
            <span class="mt-5 mt-md-0 fs-4 fw-normal">Message Sender Details</span>
            <p>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    Name : {{$oneMessage->user->name}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    Contact Number : {{$oneMessage->user->user_contact_num}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    Email : {{$oneMessage->user->email}}
                </div>
            </p>
        </div>
    </div>
</div>

@endsection
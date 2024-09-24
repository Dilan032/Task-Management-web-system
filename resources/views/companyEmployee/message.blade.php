@extends('layouts.companyUserLayout')
@section('companyEmployeeContent')

<div class="d-flex justify-content-between">
    <p class="fs-3 ms-3 fw-normal">
        🏬 {{ $oneMessage->institute->institute_name }} |
        <small>{{ $oneMessage->institute->institute_address }}</small>
    </p>  
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a> </li>
      <li class="breadcrumb-item active" aria-current="page">Message</li>
    </ol>
</nav>

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

        <!-- Time and Buttons -->
        <div class="time-buttons-container">
            <div class="time-info">
                <div id="start-time-display">
                    @if ($oneMessage->start_time)
                        <b>Start Time:</b> {{ \Carbon\Carbon::parse($oneMessage->start_time)->format('d M Y h:i:s A') }}
                    @endif
                </div>
                <div id="end-time-display">
                    @if ($oneMessage->end_time)
                        <b>End Time  :</b> {{ \Carbon\Carbon::parse($oneMessage->end_time)->format('d M Y h:i:s A') }}
                    @endif
                </div>
            </div>

            <div>
                @if (is_null($oneMessage->start_time) && is_null($oneMessage->end_time))
                    <button id="start-btn" class="btn btn-success" onclick="startTimer()">Start</button>
                    <button id="end-btn" class="btn btn-danger" style="display: none;" onclick="endTimer()">End</button>
                @elseif (!is_null($oneMessage->start_time) && is_null($oneMessage->end_time))
                    <button id="end-btn" class="btn btn-danger" onclick="endTimer()">End</button>
                @endif
            </div>
        </div>
    

      
<section class="container-fluid">
    <div class="table-responsive">
        <table class="table table-borderless rounded messageBG">
            <thead>
              <tr>
                <td colspan="4" class="fs-5 fw-normal">
                    {{$oneMessage->subject}}
                </td>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <th colspan="4" class="bg-primary-subtle fw-light">
                    <div class="d-flex justify-content-between">
                        <div>
                            @if ( $oneMessage->status == 'not resolved')
                            <span>status</span> <span class="badge text-bg-warning btnInset py-2">{{$oneMessage->status}}</span>  
                            @elseif ( $oneMessage->status == 'solved')
                                Progess  <span class="badge text-bg-success btnInset py-2 px-4">{{$oneMessage->status}}</span> 
                            @elseif ($oneMessage->status == 'Processing')
                                Progess  <span class="badge text-bg-dark btnInset py-2">{{$oneMessage->status}}</span> 
                            @else
                                Progess <span class="badge text-bg-info text-dark btnInset py-2 px-3">{{$oneMessage->status}}</span>
                            @endif 
                        
                            @if ($oneMessage->request == 'Pending')
                                Priorty  <span class="badge text-bg-warning btnInset py-2">#</span>
                            @elseif ( $oneMessage->request == 'Accept')
                                Priorty  <span class="badge text-bg-success btnInset py-2">#</span>
                            @elseif ( $oneMessage->request == 'Reject')
                                Priorty  <span class="badge text-bg-danger btnInset py-2">#</span>
                            @endif
                        </div>
    
                        <div>
                            @if (!empty($oneMessage->support_description) || !empty($oneMessage->support_img_1) || !empty($oneMessage->support_img_2) || !empty($oneMessage->support_img_3) || !empty($oneMessage->support_img_4) || !empty($oneMessage->support_img_5))
                                <p>Documents received ✔</p>
                            @endif
                        </div>
                    </div>
                  
                </th>
              </tr>
              <tr>
                <td colspan="4"><span class="fs-6">message:</span> <br> 
                    <span class="fw-light">{{$oneMessage->message}}</span>
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
            <p class="fw-normal">Pictures of the problem areas :</p>
            <div class="p-1 mb-2 bg-primary-subtle text-dark problemImageMainBG rounded">
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


{{-- institute Details --}}
<div class="container">
    <div class="row mb-5 mt-5 px-3 d-flex justify-content-evenly">
        <div class="col-md-6 fw-light">
            <span class="fs-5 fw-normal">Institute Details</span>
            <p>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Name :</span> {{$oneMessage->institute->institute_name}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Address :</span> {{$oneMessage->institute->institute_address}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Contact Number :</span> {{$oneMessage->institute->institute_contact_num}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Email :</span> {{$oneMessage->institute->email}}
                </div>
            </p>
        </div>
        <div class="col-md-6 fw-light">
            <span class="mt-5 mt-md-0 fs-5 fw-normal">Message Sender Details</span>
            <p>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Name :</span> {{$oneMessage->user->name}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Contact Number :</span> {{$oneMessage->user->user_contact_num}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Email :</span> {{$oneMessage->user->email}}
                </div>
            </p>
        </div>
    </div>
</div>

    <hr class="border border-2 opacity-50">

    {{-- if company employee requered addtional document (that user upload documet show hear) --}}
    @include('components.user.supportMessage')

@endsection
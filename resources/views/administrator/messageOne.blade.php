@extends('layouts.administratorLayout')
@section('administratorContent')

<div class="d-flex justify-content-between">
    <p class="fs-3">
        <span class="badge text-bg-dark">{{$messagesTableDataUser->user->user_type}}</span> 
        {{$messagesTableDataUser->user->name}}'s message
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
                    timer: 3000
                    });
                </script>
            @endif


        @if ( $oneMessage->request == 'pending')
        <div class="d-grid gap-2 d-flex justify-content-end mt-3 mb-5">
            <form action="{{ route('administrator.conform.message', $oneMessage->id ) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="request" value="accept">
                <button class="btn btn-success me-4 me-md-2" type="submit" onclick="return confirm('Do you want to forward this user s message to Nanosoft Solutions Company?');">Conform Message</button>
            </form>

            <form action="{{ route('administrator.reject.message', $oneMessage->id ) }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="request" value="reject">
                <button class="btn btn-danger me-4" type="submit" onclick="return confirm('Do you want to ignore this user s message?');">Reject Message</button> 
            </form>
          </div>
        @else
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 mb-2">
            @if ($oneMessage->request == 'accept')
            {{-- border border-success border-start-4 rounded-start --}}
                <p class="p-2 text-success">This user's message was sent to Nanosoft Solutions (Pvt)Ltd</p>
            @else
            {{-- border border-danger border-start-4 rounded-start --}}
                <p class="p-2 text-danger">This user's message has been ignored</p>
            @endif
            
        </div>
        @endif
      
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
                <th colspan="4" class="bg-primary-subtle fw-light">
                    @if ( $oneMessage->status == 'not resolved')
                        <span>status</span> <span class="badge text-bg-warning btnInset py-2">{{$oneMessage->status}}</span>  
                    @elseif ( $oneMessage->status == 'solved')
                        status  <span class="badge text-bg-success btnInset py-2 px-4">{{$oneMessage->status}}</span> 
                    @elseif ($oneMessage->status == 'Processing')
                        status  <span class="badge text-bg-dark btnInset py-2">{{$oneMessage->status}}</span> 
                    @else
                        status <span class="badge text-bg-info text-dark btnInset py-2 px-3">{{$oneMessage->status}}</span>
                    @endif 
                  
                    @if ($oneMessage->request == 'pending')
                        request  <span class="badge text-bg-warning btnInset py-2">{{$oneMessage->request}}</span>
                    @elseif ( $oneMessage->request == 'accept')
                        request  <span class="badge text-bg-success btnInset py-2">{{$oneMessage->request}}</span>
                    @elseif ( $oneMessage->request == 'reject')
                        request  <span class="badge text-bg-danger btnInset py-2">{{$oneMessage->request}}</span>
                    @endif
                  
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
            <p class="fw-bold">Pictures of the problem areas :</p>
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


@endsection
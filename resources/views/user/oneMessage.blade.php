@extends('layouts.userLayout')
@section('userContent')


{{-- <div class="p-2 mb-5 bg-black text-white">
  <span class="fs-5 ms-2">{{$messagesTableDataUser->user->name}}'s message </span>
</div> --}}

<div id="particles-js"></div>

<div class="table-responsive">
    <table class="table table-borderless rounded messageBG">
        <thead>
          <tr>
            <td colspan="4" class="fs-6 fs-sm-2">
                {{$oneMessage->subject}}
            </td>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          <tr>
            <td colspan="4" class="bg-primary-subtle text-black">
              <span class="fw-light">status</span>  

            @if ( $oneMessage->status == 'not resolved')
                <span class="badge text-bg-warning btnInset py-1">{{$oneMessage->status}}</span>
            @elseif ( $oneMessage->status == 'solved')
                <span class="badge text-bg-success btnInset py-1 px-4">{{$oneMessage->status}}</span>
            @elseif ($oneMessage->status == 'Processing')
                <span class="badge text-bg-dark btnInset py-1 px-2">{{$oneMessage->status}}</span>
            @else
                <span class="badge text-bg-info text-dark btnInset py-1 px-4">{{$oneMessage->status}}</span>
            @endif  
             
            <span class="fw-light">request</span> 

                @if ($oneMessage->request == "accept")
                    <span class="badge text-bg-success btnInset py-1 px-3">{{ $oneMessage->request }}</span>
                @elseif ($oneMessage->request == "reject")
                    <span class="badge text-bg-danger btnInset py-1 px-3">{{ $oneMessage->request }}</span>
                @else
                    <span class="badge text-bg-warning btnInset py-1 px-2">{{ $oneMessage->request }}</span>
                @endif 
            </td>
          </tr>
          <tr>
            <td colspan="4"><span class="fs-6">message: </span><br> 
                <div class="fw-light">
                    {{$oneMessage->message}}
                </div>
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
        <p class="fs-6">Pictures of the problem areas :</p>
        <div class="p-3 mb-2 bg-primary-subtle text-black problemImageMainBG rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_1) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal1">
            </div>
            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_2) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal2">
            </div>
            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_3) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal3">
            </div>
            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_4) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal4">
            </div>
            <div class="col-md-2 py-2">
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
                  <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_1) }}" alt="empty" class="img-fluid">
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
                  <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_2) }}" alt="empty" class="img-fluid">
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
                  <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_3) }}" alt="empty" class="img-fluid">
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
                  <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_4) }}" alt="empty" class="img-fluid">
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
                  <img src="{{ asset('images/MessageWithProblem/'.$oneMessage-> img_5) }}" alt="empty" class="img-fluid">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>



@endsection
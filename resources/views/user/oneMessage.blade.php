@extends('layouts.userLayout')
@section('userContent')
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('user.previous.messages') }}" class="btn btn-primary" type="button">Back</a>
    </div>


        @if (($oneMessage->status == "Document Pending") && !empty($oneMessage->support_description) || !empty($oneMessage->support_img_1) || !empty($oneMessage->support_img_2) || !empty($oneMessage->support_img_3) || !empty($oneMessage->support_img_4) || !empty($oneMessage->support_img_5))
            {{-- Re-upload the document pending button --}}
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-outline-primary ping" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropSendMessage">Re-upload the document</button>
            </div>
        @elseif ($oneMessage->status == "Document Pending")
            {{-- document pending button --}}
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-outline-primary ping" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropSendMessage">Upload Document</button>
            </div>
        @endif

    {{-- include document upload model --}}
    @include('components.user.documentPendingModel')


    <div class="table-responsive">
        <table class="table table-borderless rounded messageBG" style="overflow-x: hidden;">
            <thead>
                <tr>
                    <td  class="fs-5 fw-normal">Topic : {{ $oneMessage->subject }}</td>
                    <td>
                        <div class="text-end">
                            <p>
                                <span class="badge bg-secondary-subtle text-dark fw-light">
                                    📅 {{ \Carbon\Carbon::parse($oneMessage->created_at)->format('d M Y ') }}
                                    &nbsp;&nbsp; ⏱
                                    {{ \Carbon\Carbon::parse($oneMessage->created_at)->format('h:i A') }}
                                </span>
                            </p>
                        </div>
                    </td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td colspan="4" class="bg-primary-subtle text-black">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                        <span class="fw-light">Progress :</span>

                        @if ($oneMessage->status == 'In Queue')
                                            <span class="badge rounded-pill"
                                                style="background-color: #ffd637; color: black; padding: 5px;">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @elseif ($oneMessage->status == 'In Progress')
                                            <span class="badge rounded-pill"
                                                style="background-color: #f32121; color: black; padding: 5px;">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @elseif ($oneMessage->status == 'Document Pending')
                                            <span class="badge rounded-pill"
                                                style="background-color: #51a800; color: black; padding: 5px;">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @elseif ($oneMessage->status == 'Postponed')
                                            <span class="badge rounded-pill"
                                                style="background-color: #f436f4; color: black; padding: 5px;">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @elseif ($oneMessage->status == 'Move to Next Day')
                                            <span class="badge rounded-pill"
                                                style="background-color: #705601; color: black; padding: 5px;">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @elseif ($oneMessage->status == 'Complete in Next Day')
                                            <span class="badge rounded-pill"
                                                style="background-color: #df7700; color: black; padding: 5px;">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @elseif ($oneMessage->status == 'Completed')
                                            <span class="badge rounded-pill"
                                                style="background-color: #003c96; color: black; padding: 5px;">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @else
                                            <span class="badge rounded-pill text-bg-info text-dark py-1 px-4">
                                                <small>{{ $oneMessage->status }}</small>
                                            </span>
                                        @endif
                            </div>
                            <div>
                        <span class="fw-light">Request :</span>

                        @if ($oneMessage->request == 'accept')
                            <span class="badge rounded-pill text-bg-success py-1 px-3">{{ $oneMessage->request }}</span>
                        @elseif ($oneMessage->request == 'reject')
                            <span class="badge rounded-pill text-bg-danger py-1 px-3">{{ $oneMessage->request }}</span>
                        @else
                            <span class="badge rounded-pill text-bg-warning py-1 px-3">{{ $oneMessage->request }}</span>
                        @endif
                            </div>
                            <div></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="white-space: normal; word-wrap: break-word;">
                        <span class="fs-6">Message: </span><br>
                        <div class="fw-light" style="text-align: justify; margin-top: 10px;">
                            {{ $oneMessage->message }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


     <!-- Thumbnail Images -->
     <div class="container mt-4 mb-5">
        <p class="fs-6">Pictures of the problem areas :</p>
        <div class="p-3 mb-2 bg-primary-subtle text-black problemImageMainBG rounded">
        <div class="row d-flex justify-content-center">
            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->img_1) }}" alt="empty"
                class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModal1">
            </div>

            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->img_2) }}" alt="empty"
                class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModal2">
            </div>

            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->img_3) }}" alt="empty"
                class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModal3">
            </div>

            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->img_4) }}" alt="empty"
                class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModal4">
            </div>

            <div class="col-md-2 py-2">
                <img src="{{ asset('images/MessageWithProblem/' . $oneMessage->img_5) }}" alt="empty"
                class="img-thumbnail problemImage ionHover" data-bs-toggle="modal" data-bs-target="#imageModal5">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
      </div>
  </div>

    <hr>

    {{-- if company employee requered addtional document (that user upload documet show hear) --}}
    @include('components.user.supportMessage')


@endsection

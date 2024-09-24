<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.companyUserLayout')
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@section('companyEmployeeContent')
<div class= "d-flex justify-content-between mt-3 mb-3">
<div class= "d-flex">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('company.employee.dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $messages->institute->institute_name }} Message</li>
    </ol>
</nav>
</div>
<div>

<!-- Time and Buttons -->
<div class="time-buttons-container">
    <div class="time-info">
        <div id="start-time-display">
            @if ($messages->start_time)
                <b>Start Time:</b> {{ \Carbon\Carbon::parse($messages->start_time)->format('d M Y h:i:s A') }}
            @endif
        </div>
        <div id="end-time-display">
            @if ($messages->end_time)
                <b>End Time  :</b> {{ \Carbon\Carbon::parse($messages->end_time)->format('d M Y h:i:s A') }}
            @endif
        </div>
    </div>

    <div>
        @if (is_null($messages->start_time) && is_null($messages->end_time))
            <button id="start-btn" class="btn btn-success" onclick="startTimer()">Start</button>
            <button id="end-btn" class="btn btn-danger" style="display: none;" onclick="endTimer()">End</button>
        @elseif (!is_null($messages->start_time) && is_null($messages->end_time))
            <button id="end-btn" class="btn btn-danger" onclick="endTimer()">End</button>
        @endif
    </div>
</div>
</div>
</div>

<div class="d-flex justify-content-end mb-3">

    {{-- priority drop down --}}
    {{-- <form action="{{ route('com.update.message.priority', $messages->id) }}" method="POST">
        @csrf
        @method('POST')

        <input type="hidden" name="priority" id="priority-input">

        <div class="dropdown-center me-2">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" style="width: 100px;">
                Priority
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item badge top-urgent" href="#"
                        onclick="changePriority('Top Urgent')">Top Urgent (2 min)</a></li>
                <li><a class="dropdown-item badge urgent" href="#" onclick="changePriority('Urgent')">Urgent
                        (5 min)</a></li>
                <li><a class="dropdown-item badge medium" href="#" onclick="changePriority('Medium')">Medium
                        (2 hrs)</a></li>
                <li><a class="dropdown-item badge low" href="#" onclick="changePriority('Low')">Low (1
                        day)</a></li>
            </ul>
        </div>
    </form> --}}

    <!-- Status Dropdown -->
    <form action="{{ route('com.update.message.status', $messages->id) }}" method="POST" id="statusForm">
        @csrf
        @method('POST')

        <input type="hidden" name="status" id="status-input">
        <input type="hidden" name="progress_note" id="progress-note-input">

        <div class="dropdown-center">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false" style="width: 100px;">
                Progress
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item badge in-queue" href="#" onclick="changeStatus('In Queue')">In
                        Queue</a></li>
                <li><a class="dropdown-item badge in-progress" href="#"
                        onclick="changeStatus('In Progress')">In Progress</a></li>
                <li><a class="dropdown-item badge document-pending" href="#"
                        onclick="openProgressModal('Document Pending')">Document Pending</a></li>
                <li><a class="dropdown-item badge postponed" href="#"
                        onclick="openProgressModal('Postponed')">Postponed</a></li>
                <li><a class="dropdown-item badge move-next-day" href="#"
                        onclick="openProgressModal('Move to next day')">Move to next day</a></li>
                <li><a class="dropdown-item badge complete-next-day" href="#"
                        onclick="openProgressModal('Complete in next day')">Complete in next day</a></li>
                <li><a class="dropdown-item badge completed" href="#"
                        onclick="changeStatus('Completed')">Completed</a></li>
            </ul>
        </div>
    </form>
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
                    timer: 2000
                    });
                </script>
            @endif

<!-- Modal for Progress Note -->
<div class="modal fade" id="progressModal2" tabindex="-1" aria-labelledby="progressModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="progressModalLabel">Add Progress Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="progressNoteForm">
                <div class="mb-3">
                    <label for="progress-note" class="form-label">Progress Note</label>
                    <textarea class="form-control" id="progress-note" rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="submitStatusWithNote()">Submit</button>
        </div>
    </div>
</div>
</div>


<section class="container-fluid">
    <div class="table-responsive">
        <table class="table table-borderless rounded messageBG">
            <thead>
              <tr>
                <td colspan="4" class="fs-6 fw-normal">
                    <b>Topic :</b> {{$messages->subject}}
                </td>
              </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td colspan="2" class="bg-primary-subtle">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Status -->
                            <div>
                                <b>Status :</b>
                                @if ($messages->status == 'In Queue')
                                    <span class="badge rounded-pill"
                                        style="background-color: #ffd637; color: black; padding: 5px;">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @elseif ($messages->status == 'In Progress')
                                    <span class="badge rounded-pill"
                                        style="background-color: #f32121; color: black; padding: 5px;">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @elseif ($messages->status == 'Document Pending')
                                    <span class="badge rounded-pill"
                                        style="background-color: #51a800; color: black; padding: 5px;">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @elseif ($messages->status == 'Postponed')
                                    <span class="badge rounded-pill"
                                        style="background-color: #f436f4; color: black; padding: 5px;">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @elseif ($messages->status == 'Move to Next Day')
                                    <span class="badge rounded-pill"
                                        style="background-color: #705601; color: black; padding: 5px;">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @elseif ($messages->status == 'Complete in Next Day')
                                    <span class="badge rounded-pill"
                                        style="background-color: #df7700; color: black; padding: 5px;">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @elseif ($messages->status == 'Completed')
                                    <span class="badge rounded-pill"
                                        style="background-color: #003c96; color: black; padding: 5px;">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @else
                                    <span class="badge rounded-pill text-bg-info text-dark py-1 px-4">
                                        <small>{{ $messages->status }}</small>
                                    </span>
                                @endif
                            </div>

                            <!-- Priority -->
                            <div class= " me-5">
                                <b>Priority :</b>
                                @if ($messages->priority == 'Top Urgent')
                                    <span class="badge rounded-pill"
                                        style="background-color: #705601; color: black; padding: 5px;">
                                        <small>{{ $messages->priority }}</small>
                                    </span>
                                @elseif ($messages->priority == 'Urgent')
                                    <span class="badge rounded-pill"
                                        style="background-color: #f32121; color: black; padding: 5px;">
                                        <small>{{ $messages->priority }}</small>
                                    </span>
                                @elseif ($messages->priority == 'Medium')
                                    <span class="badge rounded-pill"
                                        style="background-color: #51a800; color: black; padding: 5px;">
                                        <small>{{ $messages->priority }}</small>
                                    </span>
                                @elseif ($messages->priority == 'Low')
                                    <span class="badge rounded-pill"
                                        style="background-color: #ffd637; color: black; padding: 5px;">
                                        <small>{{ $messages->priority }}</small>
                                    </span>
                                @else
                                    <span class="badge rounded-pill text-bg-info text-dark py-1 px-4">
                                        <small>{{ $messages->priority }}</small>
                                    </span>
                                @endif
                            </div>
                            <div></div>
                        </div>
                    </td>
                </tr>
              <tr>
                <td colspan="4"><span class="fs-6"><b>Description :</b></span> <br>
                    <span class="fw-light">{{$messages->message}}</span>
                </td>
              </tr>
            </tbody>
          </table>

<!-- Message Created Time -->
<div class="d-flex justify-content-between mb-3">

    <!-- Show Progress Note button only for certain statuses -->
    @if (in_array($messages->status, ['Document Pending', 'Postponed', 'Move to next day', 'Complete in next day']))
        <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#" onclick="openProgressEditModal()">Progress Note</a>
                </li>
            </ol>
        </nav>
    @endif

    <div class="text-end me-2 fw-light">
        <p>
            <span class="badge bg-secondary-subtle text-dark px-4 py-2 fw-light">
                @if ($messages->viewed_at)
                    <!-- If the message has been viewed, display the viewed_at time -->
                    📅 {{ \Carbon\Carbon::parse($messages->viewed_at)->format('d M Y') }} &nbsp;&nbsp;
                    ⏱ {{ \Carbon\Carbon::parse($messages->viewed_at)->format('h:i A') }}
                @else
                    <!-- If the message hasn't been viewed yet, display "Not viewed yet" -->
                    <span class="text-danger">Not viewed yet</span>
                @endif
            </span>
        </p>
    </div>
</div>
</div>

<!-- Modal for Editing Progress Note -->
<div class="modal fade" id="editProgressNoteModal2" tabindex="-1"
aria-labelledby="editProgressNoteModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editProgressNoteModalLabel">Edit Progress Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editProgressNoteForm" action="{{ route('com.update.progress.note', $messages->id) }}"
                method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="progress-note-edit" class="form-label">Progress Note</label>
                    <textarea class="form-control" id="progress-note-edit" name="progress_note" rows="3">{{ $messages->progress_note }}</textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="submitEditProgressNoteForm()">Save
                Changes</button>
        </div>
    </div>
</div>
</div>

          <!-- Thumbnail Images -->
          <div class="container mt-4 mb-5">
            <p class="fw-normal">Pictures of the problem areas :</p>
            <div class="p-1 mb-2 bg-primary-subtle text-dark problemImageMainBG rounded">
                <div class="row d-flex justify-content-center mx-auto">
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_1) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal1">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_2) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal2">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_3) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal3">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_4) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal4">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_5) }}" alt="empty" class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal5">
                    </div>
                </div>
            </div>
        </div>


         <!-- Modals -->
         <div class="modal fade" id="imageModal1" tabindex="-1" aria-labelledby="imageModalLabel1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-xl">
              <div class="modal-content">
                  <div class="modal-body">
                      <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_1) }}" alt="Full Image 1" class="img-fluid">
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
                      <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_2) }}" alt="Full Image 2" class="img-fluid">
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
                      <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_3) }}" alt="Full Image 3" class="img-fluid">
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
                      <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_4) }}" alt="Full Image 4" class="img-fluid">
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
                      <img src="{{ asset('images/MessageWithProblem/'.$messages-> img_5) }}" alt="Full Image 5" class="img-fluid">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
              </div>
          </div>
      </div>
</section>

<hr class="me-3">

{{-- institute Details --}}
<div class="container">
    <div class="row mb-5 mt-5 px-3 d-flex justify-content-evenly">
        <div class="col-md-6 fw-light">
            <span class="fs-5 fw-normal">Institute Details</span>
            <p>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Name :</span> {{$messages->institute->institute_name}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Address :</span> {{$messages->institute->institute_address}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Contact Number :</span> {{$messages->institute->institute_contact_num}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Email :</span> {{$messages->institute->email}}
                </div>
            </p>
        </div>
        <div class="col-md-6 fw-light">
            <span class="mt-5 mt-md-0 fs-5 fw-normal">Message Sender Details</span>
            <p>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Name :</span> {{$messages->user->name}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Contact Number :</span> {{$messages->user->user_contact_num}}
                </div>
                <div class="p-1 mb-1 bg-white text-dark rounded shado">
                    <span class="fw-normal">Email :</span> {{$messages->user->email}}
                </div>
            </p>
        </div>
    </div>
</div>

<script>
    function changeStatus(status) {
        document.getElementById('status-input').value = status;
        event.target.closest('form').submit(); // Submit the form when a status is selected
    }

    function changePriority(priority) {
        document.getElementById('priority-input').value = priority;
        event.target.closest('form').submit(); // Submit the form when a priority is selected
    }

    function startTimer() {
    const messageId = @json($messages->id); // Pass message ID from Blade to JavaScript
    const startTime = new Date().toLocaleString();
    document.getElementById('start-time-display').textContent = 'Start Time: ' + startTime;
    document.getElementById('start-btn').style.display = 'none';
    document.getElementById('end-btn').style.display = 'inline-block';

    // Show loading SweetAlert before starting the timer
    Swal.fire({
        title: 'Starting timer...',
        text: 'Please wait while we update the status.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/companyEmployee/message/${messageId}/start`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Timer started!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                location.reload(); // Refresh the page to show the updated status
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to start the timer.',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while starting the timer.',
                icon: 'error'
            });
        });
}

function endTimer() {
    const messageId = @json($messages->id); // Pass message ID from Blade to JavaScript
    const endTime = new Date().toLocaleString();
    document.getElementById('end-time-display').textContent = 'End Time: ' + endTime;
    document.getElementById('end-btn').style.display = 'none';

    // Show loading SweetAlert before ending the timer
    Swal.fire({
        title: 'Ending timer...',
        text: 'Please wait while we update the status.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(`/companyEmployee/message/${messageId}/end`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    title: 'Timer ended!',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
                location.reload(); // Refresh the page to show the updated status
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to end the timer.',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while ending the timer.',
                icon: 'error'
            });
        });
}

    let selectedStatus = '';

    function openProgressModal(status) {
        selectedStatus = status;
        const modal = new bootstrap.Modal(document.getElementById('progressModal2'));
        modal.show();
    }

    function submitStatusWithNote() {
        const progressNote = document.getElementById('progress-note').value;
        document.getElementById('status-input').value = selectedStatus;
        document.getElementById('progress-note-input').value = progressNote;

        // Submit the form after setting the status and progress note
        document.getElementById('statusForm').submit();
    }

    function changeStatus(status) {
        document.getElementById('status-input').value = status;
        document.getElementById('statusForm').submit();
    }

    // Function to open the edit progress note modal
    function openProgressEditModal() {
        const modal = new bootstrap.Modal(document.getElementById('editProgressNoteModal2'));
        modal.show();
    }

    // Function to submit the form from the modal
    function submitEditProgressNoteForm() {
        document.getElementById('editProgressNoteForm').submit();
    }

    function submitSpRequestForm() {
        document.getElementById('acceptSpRequestForm').submit();
    }


</script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}



@endsection

</body>

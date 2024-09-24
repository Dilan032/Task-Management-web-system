<!DOCTYPE html>
<html lang="en">

<head>
    @extends('layouts.superAdminLayout')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .dropdown-item.in-queue {
            background-color: #ffd637;
        }

        .dropdown-item.in-progress {
            background-color: #ff0000;
        }

        .dropdown-item.document-pending {
            background-color: #357402;
        }

        .dropdown-item.postponed {
            background-color: #ff00b3;
        }

        .dropdown-item.move-next-day {
            background-color: #995e05;
        }

        .dropdown-item.complete-next-day {
            background-color: #ff7300;
        }

        .dropdown-item.completed {
            background-color: #001aff;
        }

        .dropdown-item.top-urgent {
            background-color: #995e05;
        }

        .dropdown-item.urgent {
            background-color: #ff0000;
        }

        .dropdown-item.medium {
            background-color: #357402;
        }

        .dropdown-item.low {
            background-color: #ffd637;
        }

        .time-buttons-container {
            display: flex;
            align-items: center;
        }

        .time-info {
            margin-right: 20px;
        }

        .time-info div {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

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

    @section('SuperAdminContent')
        <div class="d-flex justify-content-between mt-3 mb-3">
            <div class="d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="ms-4 breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('superAdmin.allmessages.view') }}">All issues</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $message->institute->institute_name }}
                            Message
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Time and Buttons -->
            <div class="time-buttons-container">
                <div class="time-info">
                    <div id="start-time-display">
                        @if ($message->start_time)
                            <b>Start Time:</b> {{ \Carbon\Carbon::parse($message->start_time)->format('d M Y h:i:s A') }}
                        @endif
                    </div>
                    <div id="end-time-display">
                        @if ($message->end_time)
                            <b>End Time :</b> {{ \Carbon\Carbon::parse($message->end_time)->format('d M Y h:i:s A') }}
                        @endif
                    </div>
                </div>

                <div>
                    <div class="d-flex justify-content-end gap-2">

                        @if (is_null($message->start_time) && is_null($message->end_time))
                            <!-- Accept SP Request Button -->
                            @if ($message->sp_request !== 'Accepted')
                                <form action="{{ route('accept.sp_request', $message->id) }}" method="POST" id="acceptSpRequestForm">
                                    @csrf
                                    <button id="accept-sp-request-btn" class="btn btn-warning me-2" onclick="submitSpRequestForm()">Accept</button>
                                </form>
                            @endif

                            <!-- Start Button (Disabled until SP request is accepted) -->
                            <button id="start-btn" class="btn btn-success"
                                @if ($message->sp_request !== 'Accepted')
                                    disabled
                                @endif
                                onclick="startTimer()">Start</button>

                            <button id="end-btn" class="btn btn-danger" style="display: none;" onclick="endTimer()">End</button>
                        @elseif (!is_null($message->start_time) && is_null($message->end_time))
                            <button id="end-btn" class="btn btn-danger" onclick="endTimer()">End</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-end mb-3">
            <form id="assign-employee-form" action="{{ route('update.assigned.employee', $message->id) }}" method="POST">
                @csrf
                <div class="dropdown-center me-2">
                    <select name="assigned_employee" class="form-select" aria-label="Assign Employee"
                        onchange="submitAssignEmployeeForm();">
                        <option selected disabled>Assign Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->name }}"
                                {{ $message->assigned_employee == $employee->name ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <form action="{{ route('update.message.priority', $message->id) }}" method="POST">
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
            </form>

            <!-- Status Dropdown -->
            <form action="{{ route('update.message.status', $message->id) }}" method="POST" id="statusForm">
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

        <!-- Modal for Progress Note -->
        <div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel"
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

        <section class="container">
            <div class="table-responsive">
                <table class="table table-border rounded">
                    <thead>
                        <tr>
                            <td colspan="4" class="fs-5">
                                <b>Topic :</b> {{ $message->subject }}
                            </td>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <td colspan="4" class="bg-primary-subtle">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Status -->
                                    <div>
                                        <b>Status :</b>
                                        @if ($message->status == 'In Queue')
                                            <span class="badge rounded-pill"
                                                style="background-color: #ffd637; color: black; padding: 5px;">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @elseif ($message->status == 'In Progress')
                                            <span class="badge rounded-pill"
                                                style="background-color: #f32121; color: black; padding: 5px;">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @elseif ($message->status == 'Document Pending')
                                            <span class="badge rounded-pill"
                                                style="background-color: #51a800; color: black; padding: 5px;">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @elseif ($message->status == 'Postponed')
                                            <span class="badge rounded-pill"
                                                style="background-color: #f436f4; color: black; padding: 5px;">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @elseif ($message->status == 'Move to Next Day')
                                            <span class="badge rounded-pill"
                                                style="background-color: #705601; color: black; padding: 5px;">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @elseif ($message->status == 'Complete in Next Day')
                                            <span class="badge rounded-pill"
                                                style="background-color: #df7700; color: black; padding: 5px;">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @elseif ($message->status == 'Completed')
                                            <span class="badge rounded-pill"
                                                style="background-color: #003c96; color: black; padding: 5px;">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @else
                                            <span class="badge rounded-pill text-bg-info text-dark py-1 px-4">
                                                <small>{{ $message->status }}</small>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Priority -->
                                    <div>
                                        <b>Priority :</b>
                                        @if ($message->priority == 'Top Urgent')
                                            <span class="badge rounded-pill"
                                                style="background-color: #705601; color: black; padding: 5px;">
                                                <small>{{ $message->priority }}</small>
                                            </span>
                                        @elseif ($message->priority == 'Urgent')
                                            <span class="badge rounded-pill"
                                                style="background-color: #f32121; color: black; padding: 5px;">
                                                <small>{{ $message->priority }}</small>
                                            </span>
                                        @elseif ($message->priority == 'Medium')
                                            <span class="badge rounded-pill"
                                                style="background-color: #51a800; color: black; padding: 5px;">
                                                <small>{{ $message->priority }}</small>
                                            </span>
                                        @elseif ($message->priority == 'Low')
                                            <span class="badge rounded-pill"
                                                style="background-color: #ffd637; color: black; padding: 5px;">
                                                <small>{{ $message->priority }}</small>
                                            </span>
                                        @else
                                            <span class="badge rounded-pill text-bg-info text-dark py-1 px-4">
                                                <small>{{ $message->priority }}</small>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Assigned to -->
                                    <div>
                                        <b>Assigned to:</b>
                                        <span>{{ $message->assigned_employee ?? 'Not assigned' }}</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <span class="fs-5"><b>Description:</b></span> <br>
                                <span class="fw-lighter">{{ $message->message }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <!-- Message Created Time -->
                <div class="d-flex justify-content-between mb-3">

                    <!-- Show Progress Note button only for certain statuses -->
                    @if (in_array($message->status, ['Document Pending', 'Postponed', 'Move to next day', 'Complete in next day']))
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
                                @if ($message->viewed_at)
                                    <!-- If the message has been viewed, display the viewed_at time -->
                                    📅 {{ \Carbon\Carbon::parse($message->viewed_at)->format('d M Y') }} &nbsp;&nbsp;
                                    ⏱ {{ \Carbon\Carbon::parse($message->viewed_at)->format('h:i A') }}
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
            <div class="modal fade" id="editProgressNoteModal" tabindex="-1"
                aria-labelledby="editProgressNoteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProgressNoteModalLabel">Edit Progress Note</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editProgressNoteForm" action="{{ route('update.progress.note', $message->id) }}"
                                method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label for="progress-note-edit" class="form-label">Progress Note</label>
                                    <textarea class="form-control" id="progress-note-edit" name="progress_note" rows="3">{{ $message->progress_note }}</textarea>
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

        </section>

        <!-- Thumbnail Images -->
        <div class="container mt-6 mb-6">
            <p class="fw-light">Pictures of the problem areas :</p>
            <div class="p-3 mb-2 bg-primary-subtle text-secondary-emphasis problemImageMainBG rounded">
                <div class="row d-flex justify-content-center mx-auto">
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_1) }}" alt="empty"
                            class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal1">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_2) }}" alt="empty"
                            class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal2">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_3) }}" alt="empty"
                            class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal3">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_4) }}" alt="empty"
                            class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal4">
                    </div>
                    <div class="col-md-2 p-2">
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_5) }}" alt="empty"
                            class="img-thumbnail problemImage ionHover" data-toggle="modal" data-target="#imageModal5">
                    </div>
                </div>
            </div>
        </div>


        <!-- Modals -->
        <div class="modal fade" id="imageModal1" tabindex="-1" aria-labelledby="imageModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_1) }}" alt="Full Image 1"
                            class="img-fluid">
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
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_2) }}" alt="Full Image 2"
                            class="img-fluid">
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
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_3) }}" alt="Full Image 3"
                            class="img-fluid">
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
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_4) }}" alt="Full Image 4"
                            class="img-fluid">
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
                        <img src="{{ asset('images/MessageWithProblem/' . $message->img_5) }}" alt="Full Image 5"
                            class="img-fluid">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Institute Details -->
        <hr>
        <div class="container">
            <div class="row mb-5 px-3 d-flex justify-content-evenly">
                <div class="col-md-6 fw-light">
                    <span class="fs-5 fw-normal"><b>Institute Details :</b></span>
                    <p>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        <b>Name :</b> {{ $message->institute->institute_name }}
                    </div>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        <b>Address :</b> {{ $message->institute->institute_address }}
                    </div>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        <b>Contact Number :</b> {{ $message->institute->institute_contact_num }}
                    </div>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        <b>Email :</b> {{ $message->institute->email }}
                    </div>
                    </p>
                </div>
                <div class="col-md-6 fw-light">
                    <span class="fs-5 fw-normal"><b>Message Sender Details :</b></span>
                    <p>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        <b>Name :</b> {{ $message->user->name }}
                    </div>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        <b>Phone Number :</b> {{ $message->user->user_contact_num }}
                    </div>
                    <div class="p-1 mb-1 bg-white text-dark rounded shado">
                        <b>Email :</b> {{ $message->user->email }}
                    </div>
                    </p>
                </div>
            </div>
        </div>


    {{-- if company employee requered addtional document (that user upload documet show hear) --}}
    @include('components.user.supportMessage')

    @endsection

    <script>
        function changeStatus(status) {
            document.getElementById('status-input').value = status;
            event.target.closest('form').submit(); // Submit the form when a status is selected
        }

        function changePriority(priority) {
            document.getElementById('priority-input').value = priority;
            event.target.closest('form').submit(); // Submit the form when a priority is selected
        }

        function submitAssignEmployeeForm() {
            document.getElementById('assign-employee-form').submit();
        }

        function startTimer() {
            const messageId = @json($message->id); // Pass message ID from Blade to JavaScript
            const startTime = new Date().toLocaleString();
            document.getElementById('start-time-display').textContent = 'Start Time: ' + startTime;
            document.getElementById('start-btn').style.display = 'none';
            document.getElementById('end-btn').style.display = 'inline-block';

            fetch(`/message/${messageId}/start`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload(); // Refresh the page to show the updated status
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function endTimer() {
            const messageId = @json($message->id); // Pass message ID from Blade to JavaScript
            const endTime = new Date().toLocaleString();
            document.getElementById('end-time-display').textContent = 'End Time: ' + endTime;
            document.getElementById('end-btn').style.display = 'none';

            fetch(`/message/${messageId}/end`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload(); // Refresh the page to show the updated status
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        let selectedStatus = '';

        function openProgressModal(status) {
            selectedStatus = status;
            const modal = new bootstrap.Modal(document.getElementById('progressModal'));
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
            const modal = new bootstrap.Modal(document.getElementById('editProgressNoteModal'));
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

</body>

</html>

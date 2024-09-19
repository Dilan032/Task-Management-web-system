<!DOCTYPE html>

<head>
    @extends('layouts.superAdminLayout')
    <style>
        /* Flexbox Container for Status Counts */
        .status-container {
            display: flex;
            justify-content: space-between;
            padding: 5px;
            margin-bottom: 20px;
            background-color: #cccccc;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .status-box {
            flex: 1;
            text-align: center;
            padding: 5px;
            margin: 5px;
            color: white;
            border-radius: 5px;
            font-size: 14px;
        }

        .status-in-queue {
            background-color: #ffd637;
        }

        /* Green */
        .status-in-progress {
            background-color: #f32121;
        }

        /* Blue */
        .status-document-pending {
            background-color: #51a800;
        }

        /* Orange */
        .status-postponed {
            background-color: #f436f4;
        }

        /* Red */
        .status-move-next-day {
            background-color: #705601;
        }

        /* Purple */
        .status-complete-next-day {
            background-color: #df7700;
        }

        /* Amber */
        .status-completed {
            background-color: #003c96;
        }

        /* Teal */

        .status-box span {
            display: block;
            font-size: 20px;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    @section('SuperAdminContent')

        <div class="row mt-3 mb-4 d-flex justify-content-center">
            <div class="col-md-12">
                <div class="p-2 mb-2 bg-white text-black rounded shado">

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            <!-- Responsive flex-wrap and gap between status boxes -->
                            <div class="d-flex flex-wrap justify-content-between p-2 mb-2 text-dark rounded">
                                <div class="p-2 status-box status-in-queue mb-2" style="flex: 1 1 10%; min-width: 150px;">
                                    In Queue
                                    <span>{{ $statusCounts['In Queue'] }}</span>
                                </div>
                                <div class="p-2 status-box status-in-progress mb-2"
                                    style="flex: 1 1 10%; min-width: 150px;">
                                    In Progress
                                    <span>{{ $statusCounts['In Progress'] }}</span>
                                </div>
                                <div class="p-2 status-box status-document-pending mb-2"
                                    style="flex: 1 1 10%; min-width: 150px;">
                                    Document Pending
                                    <span>{{ $statusCounts['Document Pending'] }}</span>
                                </div>
                                <div class="p-2 status-box status-postponed mb-2" style="flex: 1 1 10%; min-width: 150px;">
                                    Postponed
                                    <span>{{ $statusCounts['Postponed'] }}</span>
                                </div>
                                <div class="p-2 status-box status-move-next-day mb-2"
                                    style="flex: 1 1 10%; min-width: 150px;">
                                    Move to Next Day
                                    <span>{{ $statusCounts['Move to Next Day'] }}</span>
                                </div>
                                <div class="p-2 status-box status-complete-next-day mb-2"
                                    style="flex: 1 1 10%; min-width: 150px;">
                                    Complete in Next Day
                                    <span>{{ $statusCounts['Complete in Next Day'] }}</span>
                                </div>
                                <div class="p-2 status-box status-completed mb-2" style="flex: 1 1 10%; min-width: 150px;">
                                    Completed
                                    <span>{{ $statusCounts['Completed'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="px-4 mb-4">

        <!-- Filter Form -->
        <section class="px-4 mb-4">
            <form action="{{ route('superAdmin.allmessages.view') }}" method="GET" class="form-inline row">
                {{-- filter from the employee name --}}
                <div class="form-group col-md-3">
                    <label for="assigned_employee" class="mr-2">Enter Employee Name:</label>
                    <input type="text" name="assigned_employee" class="form-control w-100"
                        placeholder="Enter employee name" value="{{ request()->assigned_employee }}">
                </div>

                {{-- filter from the issue priority --}}
                <div class="form-group col-md-3">
                    <label for="priority" class="mr-2">Priority:</label>
                    <select name="priority" class="form-control w-100">
                        <option value="">None</option>
                        <option value="Top Urgent" {{ request()->priority == 'Top Urgent' ? 'selected' : '' }}>Top Urgent
                        </option>
                        <option value="Urgent" {{ request()->priority == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        <option value="Medium" {{ request()->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="Low" {{ request()->priority == 'Low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>

                {{-- filter from the issue progress --}}
                <div class="form-group col-md-3">
                    <label for="progress" class="mr-2">Progress:</label>
                    <select name="progress" class="form-control w-100">
                        <option value="">None</option>
                        <option value="In Queue" {{ request()->progress == 'In Queue' ? 'selected' : '' }}>In Queue
                        </option>
                        <option value="In Progress" {{ request()->progress == 'In Progress' ? 'selected' : '' }}>In
                            Progress</option>
                        <option value="Document Pending" {{ request()->progress == 'Document Pending' ? 'selected' : '' }}>
                            Document Pending</option>
                        <option value="Postponed" {{ request()->progress == 'Postponed' ? 'selected' : '' }}>Postponed
                        </option>
                        <option value="Move to Next Day" {{ request()->progress == 'Move to Next Day' ? 'selected' : '' }}>
                            Move to Next Day</option>
                        <option value="Complete in Next Day"
                            {{ request()->progress == 'Complete in Next Day' ? 'selected' : '' }}>Complete in Next Day
                        </option>
                        <option value="Completed" {{ request()->progress == 'Completed' ? 'selected' : '' }}>Completed
                        </option>
                    </select>
                </div>

                <div class="form-group col-md-3 d-flex justify-content-between" style="height: 38px; margin-top: 24px;">
                    <!-- Filter Button with fixed width -->
                    <button type="submit" class="btn btn-primary" style="width: 100px;">Filter</button>

                    <!-- Reset Button with fixed width -->
                    <a href="{{ route('superAdmin.allmessages.view') }}" class="btn btn-warning ms-1" style="width: 100px;">Reset</a>

                    <!-- Add Issue Button with fixed width -->
                    <button class="btn btn-success ms-1" type="button" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop2" style="width: 150px; margin-left: 10px;">
                        Add Issue
                    </button>
                </div>
                
        </form>

        <!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Put the problem here to sent</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('superAdmin.messages.save') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Institute Dropdown -->
                        <div class="form-floating mb-3 userBgShado">
                            <select name="institute_id" class="form-select" id="instituteSelect">
                                <option value="">None</option>
                                @foreach ($institutes as $institute)
                                <option value="{{ $institute->id }}">{{ $institute->institute_name }}</option>
                                @endforeach
                            </select>
                            <label for="instituteSelect">Select Institute</label>
                        </div>

                        <div class="form-floating mb-3 userBgShado">
                            <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                                id="floatingInput" placeholder="Subject">
                            <label for="floatingInput">Subject</label>
                        </div>
                        <div class="form-floating userBgShado">
                            <textarea class="form-control" name="message" value="{{ old('message') }}" placeholder="Message" id="floatingTextarea2"
                                style="height: 250px"></textarea>
                            <label for="floatingTextarea2">Message</label>
                        </div>

                        <div class="d-grid gap-2 mx-auto mt-4">
                            <button class="btn btn-primary" type="submit">Send Message</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                </div>


                <div class="col-md-4">
                    <br> <br> <br>
                    <div class="text-center mb-3 mt-4">
                        <h3 class="fw-normal">Upload Images</h3>
                        <span class="font-monospace"><small>(Upload pictures where there are
                                problems)</small></span>
                    </div>

                    <div class="d-flex justify-content-around">
                        <section>
                            <div class="bg-white  rounded p-2 imgBg">
                                <label for="file_1" class="ionHover">
                                    <i class="bi bi-image-fill fs-1"></i>
                                </label>
                                <input type="file" class="d-none" name="img_1" id="file_1">
                            </div>
                            {{-- this style for when image file uploaded show that file uploaded or not --}}
                            <div class="ms-4 mt-2">
                                <div class="spinner-border spinner-border-sm" id="spinner_1" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="bi bi-check-circle checkmark" id="checkmark_1"></i>
                            </div>
                        </section>

                        <section>
                            <div class="bg-white  rounded p-2 imgBg">
                                <label for="file_2" class="ionHover">
                                    <i class="bi bi-image-fill fs-1"></i>
                                </label>
                                <input type="file" class="d-none" name="img_2" id="file_2">
                            </div>
                            {{-- this style for when image file uploaded show that file uploaded or not --}}
                            <div class="ms-4 mt-2">
                                <div class="spinner-border spinner-border-sm" id="spinner_2" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="bi bi-check-circle checkmark" id="checkmark_2"></i>
                            </div>
                        </section>

                        <section>
                            <div class="bg-white  rounded p-2 imgBg">
                                <label for="file_3" class="ionHover">
                                    <i class="bi bi-image-fill fs-1"></i>
                                </label>
                                <input type="file" class="d-none" name="img_3" id="file_3">
                            </div>
                            {{-- this style for when image file uploaded show that file uploaded or not --}}
                            <div class="ms-4 mt-2">
                                <div class="spinner-border spinner-border-sm" id="spinner_3" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="bi bi-check-circle checkmark" id="checkmark_3"></i>
                            </div>
                        </section>

                        <section>
                            <div class="bg-white  rounded p-2 imgBg">
                                <label for="file_4" class="ionHover">
                                    <i class="bi bi-image-fill fs-1"></i>
                                </label>
                                <input type="file" class="d-none" name="img_4" id="file_4">
                            </div>
                            {{-- this style for when image file uploaded show that file uploaded or not --}}
                            <div class="ms-4 mt-2">
                                <div class="spinner-border spinner-border-sm" id="spinner_4" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="bi bi-check-circle checkmark" id="checkmark_4"></i>
                            </div>
                        </section>

                        <section>
                            <div class="bg-white  rounded p-2 imgBg">
                                <label for="file_5" class="ionHover">
                                    <i class="bi bi-image-fill fs-1"></i>
                                </label>
                                <input type="file" class="d-none" name="img_5" id="file_5">
                            </div>
                            {{-- this style for when image file uploaded show that file uploaded or not --}}
                            <div class="ms-4 mt-2">
                                <div class="spinner-border spinner-border-sm" id="spinner_5" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <i class="bi bi-check-circle checkmark" id="checkmark_5"></i>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

            </form>
        </section>

        <section>
            <!-- Table Section -->
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr style="text-align:center">
                        <th style="height: 60px; vertical-align: middle;">Date</th>
                        <th style="height: 60px; vertical-align: middle;">Assign</th>
                        <th style="height: 60px; vertical-align: middle;">
                            Priority
                            @if (request('priority'))
                                <span class="position-relative">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $messages->total() }}
                                        <span class="visually-hidden">filtered priority</span>
                                    </span>
                                </span>
                            @endif
                        </th>
                        <th style="height: 60px; vertical-align: middle;">
                            Progress
                            @if (request('progress'))
                                <span class="position-relative">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $messages->total() }}
                                        <span class="visually-hidden">filtered progress</span>
                                    </span>
                                </span>
                            @endif
                        </th>
                        {{-- <th style="height: 60px; vertical-align: middle;">Request</th> --}}
                        <th style="height: 60px; vertical-align: middle;">Request</th>
                        <th style="height: 60px; vertical-align: middle;">Institute Name</th>
                        {{-- <th style="height: 60px; vertical-align: middle;">Institute Type</th> --}}
                        <th style="height: 60px; vertical-align: middle; width: 20%;">Subject</th>
                        <th style="height: 60px; vertical-align: middle;">Actions</th>
                    </tr>
                </thead>
                <tbody style="text-align:center">
                    @if (!empty($messages))
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($message->created_at)->format('Y M d') }}</td>
                                <td>{{ $message->assigned_employee ?? '-' }}</td>
                                <td>
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

                                </td>
                                <td>
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
                                </td>
                                {{-- <td>{{ $message->request }}</td> --}}
                                <td>
                                    @if ($message->sp_request == 'Accepted')
                                        <span class="badge rounded-pill"
                                            style="background-color: #51a800; color: black; padding: 5px;">
                                            <small>{{ $message->sp_request }}</small>
                                        </span>
                                    @elseif ($message->sp_request == 'Pending')
                                        <span class="badge rounded-pill"
                                            style="background-color: #ffd637; color: black; padding: 5px;">
                                            <small>{{ $message->sp_request }}</small>
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $message->institute_name ?? 'No institute Name Available' }}</td>
                                {{-- <td>{{ $message->institute->institute_type}}</td> --}}
                                <td>{{ $message->subject }}</td>
                                <td>
                                    <a href="{{ route('superAdmin.one.messages.view', $message->id) }}"
                                        class="btn btn-outline-primary btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <center>
                            <p>No messages found</p>
                        </center>
                    @endif
                </tbody>
            </table>

            {{-- Pagination section --}}
            <div style="margin-top:  30px">
                {{ $messages->links() }}
            </div>
        </section>

    @endsection

</body>

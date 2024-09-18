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

        .status-in-queue { background-color: #ffd637; }      /* Green */
        .status-in-progress { background-color: #f32121; }   /* Blue */
        .status-document-pending { background-color: #51a800; } /* Orange */
        .status-postponed { background-color: #f436f4; }     /* Red */
        .status-move-next-day { background-color: #705601; } /* Purple */
        .status-complete-next-day { background-color: #df7700; } /* Amber */
        .status-completed { background-color: #003c96; }     /* Teal */

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
    <div class="fs-3 ms-4">Manage Tasks</div>

    <hr class="me-3">

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
                            <div class="p-2 status-box status-in-progress mb-2" style="flex: 1 1 10%; min-width: 150px;">
                                In Progress
                                <span>{{ $statusCounts['In Progress'] }}</span>
                            </div>
                            <div class="p-2 status-box status-document-pending mb-2" style="flex: 1 1 10%; min-width: 150px;">
                                Document Pending
                                <span>{{ $statusCounts['Document Pending'] }}</span>
                            </div>
                            <div class="p-2 status-box status-postponed mb-2" style="flex: 1 1 10%; min-width: 150px;">
                                Postponed
                                <span>{{ $statusCounts['Postponed'] }}</span>
                            </div>
                            <div class="p-2 status-box status-move-next-day mb-2" style="flex: 1 1 10%; min-width: 150px;">
                                Move to Next Day
                                <span>{{ $statusCounts['Move to Next Day'] }}</span>
                            </div>
                            <div class="p-2 status-box status-complete-next-day mb-2" style="flex: 1 1 10%; min-width: 150px;">
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


    <!-- Display the message count by status -->
    {{-- <div class="status-container">
        <div class="status-box status-in-queue">
            In Queue
            <span>{{ $statusCounts['In Queue'] }}</span>
        </div>
        <div class="status-box status-in-progress">
            In Progress
            <span>{{ $statusCounts['In Progress'] }}</span>
        </div>
        <div class="status-box status-document-pending">
            Document Pending
            <span>{{ $statusCounts['Document Pending'] }}</span>
        </div>
        <div class="status-box status-postponed">
            Postponed
            <span>{{ $statusCounts['Postponed'] }}</span>
        </div>
        <div class="status-box status-move-next-day">
            Move to Next Day
            <span>{{ $statusCounts['Move to next day'] }}</span>
        </div>
        <div class="status-box status-completed-next-day">
            Completed in Next Day
            <span>{{ $statusCounts['Completed in next day'] }}</span>
        </div>
        <div class="status-box status-completed">
            Completed
            <span>{{ $statusCounts['Completed'] }}</span>
        </div>
    </div> --}}

    <section class="px-4 mb-4">
        <!-- Filter Form -->
        <form action="{{ route('superAdmin.allmessages.view') }}" method="GET" class="form-inline row">
            <div class="form-group col-md-3">
                <label for="assigned_employee" class="mr-2">Enter Employee Name:</label>
                <input type="text" name="assigned_employee" class="form-control w-100" placeholder="Enter employee name" value="{{ request()->assigned_employee }}">
            </div>


            <div class="form-group col-md-3">
                <label for="priority" class="mr-2">Priority:</label>
                <select name="priority" class="form-control w-100">
                    <option value="">None</option>
                    <option value="Top Urgent" {{ request()->priority == 'Top Urgent' ? 'selected' : '' }}>Top Urgent</option>
                    <option value="Urgent" {{ request()->priority == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                    <option value="Medium" {{ request()->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="Low" {{ request()->priority == 'Low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="progress" class="mr-2">Progress:</label>
                <select name="progress" class="form-control w-100">
                    <option value="">None</option>
                    <option value="In Queue" {{ request()->progress == 'In Queue' ? 'selected' : '' }}>In Queue</option>
                    <option value="In Progress" {{ request()->progress == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Document Pending" {{ request()->progress == 'Document Pending' ? 'selected' : '' }}>Document Pending</option>
                    <option value="Postponed" {{ request()->progress == 'Postponed' ? 'selected' : '' }}>Postponed</option>
                    <option value="Move to Next Day" {{ request()->progress == 'Move to Next Day' ? 'selected' : '' }}>Move to Next Day</option>
                    <option value="Complete in Next Day" {{ request()->progress == 'Complete in Next Day' ? 'selected' : '' }}>Complete in Next Day</option>
                    <option value="Completed" {{ request()->progress == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="form-group col-md-3 d-flex justify-content-between" style="height: 38px; margin-top: 24px;">
                <button type="submit" class="btn btn-primary w-50">Filter</button>
                <a href="{{ route('superAdmin.allmessages.view') }}" class="btn btn-warning ms-2 w-50">Reset</a>
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
                    <th style="height: 60px; vertical-align: middle;">Priority</th>
                    <th style="height: 60px; vertical-align: middle;">Progress</th>
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
                                <span class="badge rounded-pill" style="background-color: #705601; color: black; padding: 5px;">
                                    <small>{{ $message->priority }}</small>
                                </span>
                            @elseif ($message->priority == 'Urgent')
                                <span class="badge rounded-pill" style="background-color: #f32121; color: black; padding: 5px;">
                                    <small>{{ $message->priority }}</small>
                                </span>
                            @elseif ($message->priority == 'Medium')
                                <span class="badge rounded-pill" style="background-color: #51a800; color: black; padding: 5px;">
                                    <small>{{ $message->priority }}</small>
                                </span>
                            @elseif ($message->priority == 'Low')
                                <span class="badge rounded-pill" style="background-color: #ffd637; color: black; padding: 5px;">
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
                            <span class="badge rounded-pill" style="background-color: #ffd637; color: black; padding: 5px;">
                                <small>{{ $message->status }}</small>
                            </span>
                        @elseif ($message->status == 'In Progress')
                            <span class="badge rounded-pill" style="background-color: #f32121; color: black; padding: 5px;">
                                <small>{{ $message->status }}</small>
                            </span>
                        @elseif ($message->status == 'Document Pending')
                            <span class="badge rounded-pill" style="background-color: #51a800; color: black; padding: 5px;">
                                <small>{{ $message->status }}</small>
                            </span>
                        @elseif ($message->status == 'Postponed')
                            <span class="badge rounded-pill" style="background-color: #f436f4; color: black; padding: 5px;">
                                <small>{{ $message->status }}</small>
                            </span>
                        @elseif ($message->status == 'Move to Next Day')
                            <span class="badge rounded-pill" style="background-color: #705601; color: black; padding: 5px;">
                                <small>{{ $message->status }}</small>
                            </span>
                        @elseif ($message->status == 'Complete in Next Day')
                            <span class="badge rounded-pill" style="background-color: #df7700; color: black; padding: 5px;">
                                <small>{{ $message->status }}</small>
                            </span>
                        @elseif ($message->status == 'Completed')
                            <span class="badge rounded-pill" style="background-color: #003c96; color: black; padding: 5px;">
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
                            <span class="badge rounded-pill" style="background-color: #51a800; color: black; padding: 5px;">
                                <small>{{ $message->sp_request }}</small>
                            </span>
                        @elseif ($message->sp_request == 'Pending')
                            <span class="badge rounded-pill" style="background-color: #ffd637; color: black; padding: 5px;">
                                <small>{{ $message->sp_request }}</small>
                            </span>
                        @endif
                        </td>
                        <td>{{ $message->institute_name ?? 'No institute Name Available' }}</td>
                        {{-- <td>{{ $message->institute->institute_type}}</td> --}}
                        <td>{{ $message->subject }}</td>
                        <td>
                            <a href="{{ route('superAdmin.one.messages.view', $message->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                        </td>
                    </tr>

                @endforeach
                @else
                    <center><p>No messages found</p></center>
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


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

        .status-in-queue { background-color: #c4c000; }      /* Green */
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
                        <div class="d-flex p-2 mb-2 text-dark rounded justify-content-between">
                            <div class="p-2 status-box status-in-queue">
                                In Queue
                                <span>{{ $statusCounts['In Queue'] }}</span>
                            </div>
                            <div class="p-2 status-box status-in-progress">
                                In Progress
                                <span>{{ $statusCounts['In Progress'] }}</span>
                            </div>
                            <div class="p-2 status-box status-document-pending">
                                Document Pending
                                <span>{{ $statusCounts['Document Pending'] }}</span>
                            </div>
                            <div class="p-2 status-box status-postponed">
                                Postponed
                                <span>{{ $statusCounts['Postponed'] }}</span>
                            </div>
                            <div class="p-2 status-box status-move-next-day">
                                Move to Next Day
                                <span>{{ $statusCounts['Move to next day'] }}</span>
                            </div>
                            <div class="p-2 status-box status-complete-next-day">
                                Complete in Next Day
                                <span>{{ $statusCounts['Complete in next day'] }}</span>
                            </div>
                            <div class="p-2 status-box status-completed">
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
        <div class="p-2 mb-2 bg-white text-black rounded shado">
            <div class="text-center d-none d-sm-inline">
                <div class="row">
                    <div class="col-12 col-sm-auto col-md-1" >
                        <span class="">Date</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Assign</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Priority</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-2">
                        <span class="">Progress</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Request</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-2">
                        <span class="">Institute Name</span>
                    </div>
                    {{-- <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Institute Type</span>
                    </div> --}}
                    <div class="col-12 col-sm-auto col-md-3">
                        <span class="">Subject</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span class="">Action</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- in mobile view show this title --}}
        <div class="fs-4 text-center mb-4">
            <p class="d-inline d-sm-none">All Institute Messages</p>
        </div>

        @if (!empty($messages))
        @foreach ($messages as $message)
        {{-- start message content --}}
        <div class="p-1 mb-2 bg-primary-subtle text-dark messageBG rounded">
            <div class="text-center">
                <div class="row">
                    <div class="col-12 col-sm-auto col-md-1">
                        <small>{{ \Carbon\Carbon::parse($message->created_at)->format('Y M d') }}</small>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <span>{{ $message->assignedUser->name ?? 'No User Assigned' }}</span>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">

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
                            <span class="badge rounded-pill" style="background-color: #c4c000; color: black; padding: 5px;">
                                <small>{{ $message->priority }}</small>
                            </span>
                        @else
                            <span class="badge rounded-pill text-bg-info text-dark py-1 px-4">
                                <small>{{ $message->priority }}</small>
                            </span>
                        @endif

                    </div>
                    <div class="col-12 col-sm-auto col-md-2">

                        @if ($message->status == 'In Queue')
                            <span class="badge rounded-pill" style="background-color: #c4c000; color: black; padding: 5px;">
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

                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <small>{{ $message->request }}</small>
                    </div>
                    <div class="col-12 col-sm-auto col-md-2">
                        <small>{{ $message->institute->institute_name ?? 'No institute Name Available' }}</small>
                    </div>
                    {{-- <div class="col-12 col-sm-auto col-md-1">
                        <small>{{ $message->institute->institute_type}}</small>
                    </div> --}}
                    <div class="col-12 col-sm-auto col-md-3">
                            <small>{{ $message->subject }}</small>
                    </div>
                    <div class="col-12 col-sm-auto col-md-1">
                        <!-- Button that links to the view message page -->
                        <div class="d-grid gap-2 btnShado">
                            <a href="{{ route('superAdmin.one.messages.view', $message->id) }}" class="btn btn-primary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <center><p>No messages found</p></center>
        @endif
    </section>

    @endsection

</body>


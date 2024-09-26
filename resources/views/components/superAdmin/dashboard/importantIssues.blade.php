@extends('layouts.superAdminLayout')
@section('SuperAdminContent')
    <style>
        .th {
            height: 60px;
            vertical-align: middle;
        }
    </style>

    <nav aria-label="breadcrumb" class="ms-3 mt-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Important Action Required Issues Section</li>
        </ol>
    </nav>

    <h3 class="mt-3 mb-3 text-center">Important Action Required Issues Section</h3>

    <div class="container-fluid mt-5">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($issues as $issue)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{ $issue->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $issue->id }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ $issue->id }}">
                            <b>{{ $issue->institute->institute_name }}</b> : {{ $issue->subject }} -
                            {{ \Carbon\Carbon::parse($issue->created_at)->format('Y M d') }}
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $issue->id }}" class="accordion-collapse collapse"
                        aria-labelledby="flush-heading{{ $issue->id }}" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Priority:</strong>
                                    @php
                                        $priorityColors = [
                                            'Top Urgent' => '#705601',
                                            'Urgent' => '#f32121',
                                            'Medium' => '#51a800',
                                            'Low' => '#c4c000',
                                            'default' => '#17a2b8',
                                        ];
                                        $priorityColor =
                                            $priorityColors[$issue->priority] ?? $priorityColors['default'];
                                    @endphp
                                    <span class="badge rounded-pill" style="background-color: {{ $priorityColor }};">
                                        {{ $issue->priority }}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Status:</strong>
                                    @php
                                        $statusColors = [
                                            'In Queue' => '#c4c000',
                                            'In Progress' => '#f32121',
                                            'Document Pending' => '#51a800',
                                            'Postponed' => '#f436f4',
                                            'Move to Next Day' => '#705601',
                                            'Complete in Next Day' => '#df7700',
                                            'Completed' => '#003c96',
                                            'default' => '#17a2b8',
                                        ];
                                        $statusColor = $statusColors[$issue->status] ?? $statusColors['default'];
                                    @endphp
                                    <span class="badge rounded-pill" style="background-color: {{ $statusColor }};">
                                        {{ $issue->status }}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <strong>Institute:</strong> {{ $issue->institute->institute_name }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Assigned Employee:</strong> {{ $issue->assigned_employee }}
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <strong>Message:</strong>
                                    <p>{{ $issue->message }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <strong>Start Time:</strong> {{ $issue->start_time }}
                                </div>
                                <div class="col-md-4">
                                    <strong>End Time:</strong> {{ $issue->end_time }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Progress Note:</strong> {{ $issue->progress_note }}
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <strong>Support Description:</strong>
                                    <p>{{ $issue->support_description }}</p>
                                </div>
                            </div>

                            {{-- <div class="row mt-3">
                                <div class="col-md-4">
                                    <strong>Images:</strong>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($issue->{'img_' . $i})
                                            <img src="{{ asset('images/MessageWithProblem/' . $issue->{'img_' . $i}) }}"
                                                alt="Image {{ $i }}" class="img-thumbnail" width="100">
                                        @endif
                                    @endfor
                                </div>

                                <div class="col-md-4">
                                    <strong>Support Images:</strong>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($issue->{'support_img_' . $i})
                                            <img src="{{ asset('images/MessageWithProblem/' . $issue->{'support_img_' . $i}) }}"
                                                alt="Support Image {{ $i }}" class="img-thumbnail"
                                                width="100">
                                        @endif
                                    @endfor
                                </div> --}}
                                <div class="col-md-12" style="margin-left:12px">
                                    <strong>Viewed At:</strong> {{ $issue->viewed_at }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

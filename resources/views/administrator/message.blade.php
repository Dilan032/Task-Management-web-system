@extends('layouts.administratorLayout')
@section('administratorContent')

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

    <div class="mt-4">

        <!-- Filter Section -->
        <div class="mt-3">
            <form action="{{ route('administrator.messages') }}" method="GET">
                <div class="row mb-3 align-items-end">
                    <!-- Filter by Date Range -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <lable for="form_date" class="mr-2">Issue Created Date:From</lable>
                        <input type="date" name="date_from" class="form-control" placeholder="From Date"
                            value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-3 mb-2 mb-md-0">
                        <lable for="form_date" class="mr-2">Issue Created Date:To</lable>
                        <input type="date" name="date_to" class="form-control" placeholder="To Date"
                            value="{{ request('date_to') }}">
                    </div>

                    <!-- Filter by Message Status -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <select name="status" class="form-select">
                            <option value="" selected>Filter by Status</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>
                                Completed
                            </option>
                            <option value="Completed in next day"
                                {{ request('status') == 'Completed in next day' ? 'selected' : '' }}>
                                Completed in next day
                            </option>
                            <option value="Document Pending"
                                {{ request('status') == 'Document Pending' ? 'selected' : '' }}>
                                Document Pending
                            </option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>
                                In Progress
                            </option>
                            <option value="In Queue" {{ request('status') == 'In Queue' ? 'selected' : '' }}>
                                In Queue
                            </option>
                            <option value="Move to next day"
                                {{ request('status') == 'Move to next day' ? 'selected' : '' }}>
                                Move to next day
                            </option>
                            <option value="Postponed" {{ request('status') == 'Postponed' ? 'selected' : '' }}>
                                Postponed
                            </option>
                        </select>
                    </div>

                    <!-- Buttons Section -->
                    <div class="col-md-3 d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary me-2">Apply</button>
                        <a href="{{ route('administrator.messages') }}" class="btn btn-warning me-2">Reset</a>
                        <button class="btn btn-success" type="button" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" style="margin-left:10px">
                            New issue
                        </button>
                    </div>

                </div>
            </form>
        </div>

        @include('components.administrator.messageModel')

        <!-- Table Section -->
        <div class="table-responsive">
            <div class="bg-warning-subtle text-dark text-center fw-lighter mt-4">
                <small>
                    It is the manager's responsibility to confirm or reject messages.
                    After confirming the message, Nanosoft Solutions will receive the message.
                </small>
            </div>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr style="text-align:center">
                        <th style="height: 60px; vertical-align: middle;">Date</th>
                        <th style="height: 60px; vertical-align: middle;">Request</th>
                        <th style="height: 60px; vertical-align: middle;">Subject</th>
                        <th style="height: 60px; vertical-align: middle;">
                            Status
                            @if (request('status'))
                                <span class="position-relative">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $messages->total() }}
                                        <span class="visually-hidden">filtered status</span>
                                    </span>
                                </span>
                            @endif
                        </th>
                        <th style="height: 60px; vertical-align: middle;">Action</th>
                    </tr>
                </thead>
                <tbody style="text-align:center">
                    @if (!empty($messages))
                        @foreach ($messages as $msg)
                            <tr>
                                <td style="vertical-align: middle;">
                                    <small>{{ \Carbon\Carbon::parse($msg->created_at)->format('d M Y') }}</small>
                                </td>

                                @php
                                    // Define class mappings for request statuses
                                    $requestClasses = [
                                        'Accept' => 'text-bg-success',
                                        'Reject' => 'text-bg-danger',
                                    ];
                                    // Default to warning if not 'Accept' or 'Reject'
                                    $requestClass = $requestClasses[$msg->request] ?? 'text-bg-warning';

                                    // Define class mappings for message statuses
                                    $statusClasses = [
                                        'In Queue' => 'background-color: #c4c000;',
                                        'In Progress' => 'background-color: #f32121;',
                                        'Document Pending' => 'background-color: #51a800;',
                                        'Postponed' => 'background-color: #f436f4; color: black;',
                                        'Move to Next Day' => 'background-color: #705601;',
                                        'Complete in Next Day' => 'background-color: #df7700; color: black;',
                                        'Completed' => 'background-color: #003c96;',
                                    ];
                                    // Default to info if no match
                                    $statusClass = $statusClasses[$msg->status] ?? 'background-color: #d1e7dd;';
                                @endphp

                                <td style="vertical-align: middle;">
                                    <span
                                        class="badge rounded-pill {{ $requestClass }} py-1 px-4">{{ $msg->request }}</span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <small>{{ $msg->subject }}</small>
                                </td>
                                <td style="vertical-align: middle;">
                                    <span class="badge rounded-pill py-1 px-4" style="{{ $statusClass }}">
                                        {{ $msg->status }}
                                    </span>
                                </td>
                                <td style="vertical-align: middle;">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('oneMessageForAdministrator.show', $msg->id) }}"
                                            class="btn btn-outline-primary btn-sm" type="button">View</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <p>No Task found</p>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div style="margin-top:30px">
            {{ $messages->links() }}
        </div>

    </div>

@endsection

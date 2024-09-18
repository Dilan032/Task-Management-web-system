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

    <div class="container">
        <div class="mt-3">
            <!-- Filter Section -->
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

        <div class="bg-warning-subtle text-dark text-center fw-lighter">
            <small>
                It is the manager's responsibility to confirm or reject messages.
                After confirming the message, Nanosoft Solutions will receive the message.
            </small>
        </div>

        <section class="mt-1">
            <div class="p-2 mb-3 bg-black text-white">
                <div class="text-center d-none d-sm-inline">
                    <div class="row">
                        <div class="col-12 col-sm-auto col-md-2">
                            <span class="">Date</span>
                        </div>
                        <div class="col-12 col-sm-auto col-md-1">
                            <span class="">Request</span>
                        </div>
                        <div class="col-12 col-sm-auto col-md-6">
                            <span class="">Subject</span>
                        </div>
                        <div class="col-12 col-sm-auto col-md-2">
                            <span class="">Status</span>
                        </div>
                        <div class="col-12 col-sm-auto col-md-1">
                            <span class="">Action</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($messages->isNotEmpty())
                @foreach ($messages as $oneMessage)
                    <div class="p-1 mb-3 bg-white text-dark messageBG rounded">
                        <div class="text-center">
                            <div class="row">
                                <div class="col-12 col-sm-auto col-md-2">
                                    <small>{{ \Carbon\Carbon::parse($oneMessage->created_at)->format('d M Y') }}</small>
                                </div>
                                <div class="col-12 col-sm-auto col-md-1">
                                    @if ($oneMessage->request == 'Accept')
                                        <span
                                            class="badge rounded-pill text-bg-success btnInset py-1 px-3">{{ $oneMessage->request }}</span>
                                    @elseif ($oneMessage->request == 'Reject')
                                        <span
                                            class="badge rounded-pill text-bg-danger btnInset py-1 px-3">{{ $oneMessage->request }}</span>
                                    @else
                                        <span
                                            class="badge rounded-pill text-bg-warning btnInset py-1">{{ $oneMessage->request }}</span>
                                    @endif
                                </div>
                                <div class="col-12 col-sm-auto col-md-6">
                                    <span>
                                        <small>{{ $oneMessage->subject }}</small>
                                    </span>
                                </div>

                                <div class="col-12 col-sm-auto col-md-2">
                                    @php
                                        $statusClasses = [
                                            'Completed' => 'text-bg-success',
                                            'Completed in next day' => 'text-bg-warning',
                                            'Document Pending' => 'text-bg-info',
                                            'In Progress' => 'text-bg-info',
                                            'In Queue' => 'text-bg-info',
                                            'Move to next day' => 'text-bg-danger',
                                            'Postponed' => 'text-bg-danger',
                                        ];
                                        $statusClass = $statusClasses[$oneMessage->status] ?? 'text-bg-info';
                                    @endphp
                                    <span
                                        class="badge rounded-pill {{ $statusClass }} btnInset mt-1 py-1 px-4">{{ $oneMessage->status }}</span>
                                </div>

                                <div class="col-12 col-sm-auto col-md-1">
                                    <!-- Button trigger modal -->
                                    <div class="d-grid gap-2 btnShado">
                                        <a href="{{ route('oneMessageForAdministrator.show', $oneMessage->id) }}"
                                            class="btn btn-primary btn-sm" type="button">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Pagination links -->
                <div style="margin-top:30px">
                    {{ $messages->links() }}
                </div>
            @else
                <p>No messages found</p>
            @endif
        </section>
    </div>
@endsection

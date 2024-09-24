@extends('layouts.administratorLayout')
@section('administratorContent')
    <div class="row ps-2">
        <!-- Adjusted Messages Section to col-md-8 -->
        <div class="col-md-8">
            <!-- Messages Section -->
            <div class="p-3 mb-2 mt-4 bg-primary-subtle text-primary-emphasis border-bottom border-black border-5 rounded btnShado">

                <div class="d-flex justify-content-between">
                    {{-- Today's total recived messages --}}
                    <p class="fs-4">Today Messages <span
                            class="badge text-bg-light px-4 btnShado">{{ $totalMessages }}</span></p>
                </div>

                {{-- Today Pending, Accepted and Rejected messages --}}
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <div class="p-1 w-100 bg-white text-dark rounded btnShado">
                        | Employees Issues Requests
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            ⏳Pending
                            <span class="badge text-bg-warning px-5">{{ $PendingMsg }}</span>
                        </div>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            ✔Accepted
                            <span class="badge text-bg-success px-5">{{ $AcceptMsg }}</span>
                        </div>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            ❌Rejected
                            <span class="badge text-bg-danger px-5 mb-2">{{ $RejectMsg }}</span>
                        </div>
                    </div>

                    {{-- All Solved, Document Pending, Processing messages --}}
                    <div class="p-1 w-100 bg-white text-dark rounded btnShado">
                        | Nanosoft Solutions (Pvt)Ltd Status
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            ✔Solved
                            <span class="badge text-bg-success px-5">{{ $SolvedMsg }}</span>
                        </div>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            📜Document Pending
                            <span class="badge text-bg-warning px-5">{{ $DocPendingMsg }}</span>
                        </div>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            ⚙ Processing
                            <span class="badge text-bg-info px-5">{{ $ProcessingMsg }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Adjusted Registered Employees Section to col-md-4 -->
        <div class="col-md-4">
            <!-- All Registered Employees Section -->
            <div
                class="p-3 mb-2 mt-4 bg-primary-subtle text-primary-emphasis border-bottom border-black border-5 rounded btnShado">
                <p class="fs-4">Registered Employees <span
                        class="badge text-bg-light px-4 btnShado">{{ $NumAdministrators + $NumUsers }}</span></p>
                <div class="d-flex flex-column flex-sm-row">
                    <div class="p-1 w-100 bg-white text-dark rounded btnShado">
                        | Administrators &nbsp;&nbsp;&nbsp;<span
                            class="badge bg-primary-subtle text-dark px-3 btnShado">{{ $NumAdministrators }}</span>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            🙋‍♂️Active
                            <span class="badge text-bg-warning px-5">{{ $NumActiveAdministrators }}</span>
                        </div>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            🙇‍♂️Inactive
                            <span class="badge text-bg-success px-5">{{ $NumInactiveAdministrators }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row mt-2">
                    <div class="p-1 w-100 bg-white text-dark rounded btnShado">
                        | Users &nbsp;&nbsp;&nbsp;<span
                            class="badge bg-primary-subtle text-dark px-3 btnShado">{{ $NumUsers }}</span>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            🙋‍♂️Active
                            <span class="badge text-bg-success px-5">{{ $NumActiveUsers }}</span>
                        </div>
                        <div class="fs-6 fw-light d-flex justify-content-between px-4 mt-2">
                            🙇‍♂️Inactive
                            <span class="badge text-bg-warning px-5">{{ $NumInactiveUsers }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

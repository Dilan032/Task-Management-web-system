@extends('layouts.companyUserLayout')
@section('companyEmployeeContent')

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


        {{-- start filter section --}}
        
        <div class="container mt-3 mb-5">
            <form method="GET" action="">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label ms-2">Priority</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Priority</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="start_date" class="form-label ms-2">Institute</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Priority</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control datepicker" placeholder="YYYY-MM-DD" required>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <button type="submit" class="btn btn-primary px-3">Filter</button>
                        <button type="submit" class="btn btn-warning px-3">Reset</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- end filter section --}}


        <!-- Table Section -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr style="text-align:center">
                    <th style="height: 60px; vertical-align: middle;">Date</th>
                    <th style="height: 60px; vertical-align: middle;">Priority</th>
                    <th style="height: 60px; vertical-align: middle;">Institute</th>
                    <th style="height: 60px; vertical-align: middle;">Address</th>
                    <th style="height: 60px; vertical-align: middle;">Progess</th>
                    <th style="height: 60px; vertical-align: middle;">Action</th>
                </tr>
            </thead>
            <tbody style="text-align:center">
   
            @if (!empty($messages))
            @foreach ($messages as $oneMessage)
                    <tr>
                        <td>
                            <small>{{ \Carbon\Carbon::parse($oneMessage->created_at)->format('d M Y') }}</small>
                        </td>
                        <td>
                            @if ($oneMessage->priority == 'Top Urgent')
                                <span class="badge rounded-pill px-2 btnInset" style="background-color: #705601;">
                                    {{ $oneMessage->priority }}
                                </span>
                            @elseif ($oneMessage->priority == 'Urgent')
                                <span class="badge rounded-pill px-3 ms-1 btnInset" style="background-color: #f32121;">
                                    {{ $oneMessage->priority }}
                                </span>
                            @elseif ($oneMessage->priority == 'Medium')
                                <span class="badge rounded-pill px-3 btnInset" style="background-color: #51a800;">
                                    {{ $oneMessage->priority }}
                                </span>
                            @elseif ($oneMessage->priority == 'Low')
                                <span class="badge rounded-pill px-4 ms-1 btnInset" style="background-color: #c4c000;">
                                    {{ $oneMessage->priority }}
                                </span>
                            @else
                                <span class="badge rounded-pill text-bg-info btnInset text-dark py-1 px-4">
                                    {{ $oneMessage->priority }}
                                </span>
                            @endif
                        </td>
                        <td>{{  $oneMessage->institute->institute_name }}</td>
                        <td>{{ $oneMessage->institute->institute_address }}</td>
                        <td>
                            @if ($oneMessage->status == 'In Queue')
                                <span class="badge rounded-pill btnInset px-5" style="background-color: #c4c000;">
                                    {{ $oneMessage->status }}
                                </span>
                            @elseif ($oneMessage->status == 'In Progress')
                                <span class="badge rounded-pill btnInset px-5" style="background-color: #f32121;">
                                    {{ $oneMessage->status }}
                                </span>
                            @elseif ($oneMessage->status == 'Document Pending')
                                <span class="badge rounded-pill btnInset px-4" style="background-color: #51a800;">
                                    {{ $oneMessage->status }}
                                </span>
                            @elseif ($oneMessage->status == 'Postponed')
                                <span class="badge rounded-pill btnInset px-5" style="background-color: #f436f4; color: black;">
                                    {{ $oneMessage->status }}
                                </span>
                            @elseif ($oneMessage->status == 'Move to Next Day')
                                <span class="badge rounded-pill btnInset ms-3" style="background-color: #705601;">
                                    {{ $oneMessage->status }}
                                </span>
                            @elseif ($oneMessage->status == 'Complete in Next Day')
                                <span class="badge rounded-pill btnInset" style="background-color: #df7700; color: black;">
                                    {{ $oneMessage->status }}
                                </span>
                            @elseif ($oneMessage->status == 'Completed')
                                <span class="badge rounded-pill btnInset px-5" style="background-color: #003c96;">
                                    {{ $oneMessage->status }}
                                </span>
                            @else
                                <span class="badge rounded-pill text-bg-info text-dark py-1 px-4 btnInset">
                                    {{ $oneMessage->status }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('company.employee.messageView', $oneMessage->id) }}" method="post">
                                @csrf
                                <div class="d-grid gap-2 btnShado">
                                    <button class="btn btn-primary btn-sm" type="submit">View</button>
                                </div>
                            </form>
                        </td>
                        
                    </tr>
            @endforeach
            @else
                <p>No Task found</p>
            @endif

            </tbody>
        </table>

@endsection
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

        {{-- Start filter section --}}
<div class="container mt-3 mb-5">
    <form action="{{ route('company.employee.dashboard') }}" method="GET" class="form-inline row">
        {{-- Filter by institute --}}
        <div class="form-group col-md-3">
            <label for="institute" class="mr-2">Institute :</label>
            <select name="institute_id" class="form-control w-100">
                <option value="">None</option>
                @foreach ($assignedInstitutes as $institute)
                    <option value="{{ $institute->id }}" {{ request()->institute_id == $institute->id ? 'selected' : '' }}>
                        {{ $institute->institute_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter by priority --}}
        <div class="form-group col-md-3">
            <label for="priority" class="mr-2">Priority :</label>
            <select name="priority" class="form-control w-100">
                <option value="">None</option>
                <option value="Top Urgent" {{ request()->priority == 'Top Urgent' ? 'selected' : '' }}>Top Urgent</option>
                <option value="Urgent" {{ request()->priority == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                <option value="Medium" {{ request()->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                <option value="Low" {{ request()->priority == 'Low' ? 'selected' : '' }}>Low</option>
            </select>
        </div>

        {{-- Filter by progress/status --}}
        <div class="form-group col-md-3">
            <label for="progress" class="mr-2">Progress :</label>
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
            <!-- Filter Button -->
            <button type="submit" class="btn btn-primary" style="width: 120px;">Filter</button>
            <!-- Reset Button -->
            <a href="{{ route('company.employee.dashboard') }}" class="btn btn-warning ms-1" style="width: 120px;">Reset</a>
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

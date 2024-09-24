<div class="mt-5">


     <!-- Table Section -->
     <div class="table-responsive">
     <table class="table table-sm align-middle">
        <thead class="table-dark">
            <tr style="text-align:center">
                <td style="height: 30px; ">Date</td>
                <td style="height: 30px; ">Request</td>
                <td style="height: 30px;  ">Subject</td>
                <td style="height: 30px; ">Progress</td>
                <td style="height: 30px; ">Action</td>
            </tr>
        </thead>
        <tbody style="text-align:center">

        @if (!empty($messages))
        @foreach ($messages as $msg)
                <tr>
                    <td>
                        <small>{{ \Carbon\Carbon::parse($msg->created_at)->format('d M Y') }}</small>
                    </td> 
                    <td>
                        @if ($msg->request == 'Accept')
                            <span
                                class="badge rounded-pill text-bg-success btnInset mt-1 py-1 px-3">{{ $msg->request }}</span>
                        @elseif ($msg->request == 'Reject')
                            <span
                                class="badge rounded-pill text-bg-danger btnInset mt-1 py-1 px-3">{{ $msg->request }}</span>
                        @else
                            <span
                                class="badge rounded-pill text-bg-warning btnInset mt-1 py-1 px-2">{{ $msg->request }}</span>
                        @endif
                    </td>   
                    <td>
                        <small>{{ $msg->subject }}</small>
                    </td> 
                    <td style="vertical-align: middle;">
                        @if ($msg->status == 'In Queue')
                            <span class="badge rounded-pill btnInset px-5" style="background-color: #c4c000;">
                                {{ $msg->status }}
                            </span>
                        @elseif ($msg->status == 'In Progress')
                            <span class="badge rounded-pill btnInset px-5" style="background-color: #f32121;">
                                {{ $msg->status }}
                            </span>
                        @elseif ($msg->status == 'Document Pending')
                            <span class="badge rounded-pill btnInset px-4" style="background-color: #51a800;">
                                {{ $msg->status }}
                            </span>
                        @elseif ($msg->status == 'Postponed')
                            <span class="badge rounded-pill btnInset px-5" style="background-color: #f436f4; color: black;">
                                {{ $msg->status }}
                            </span>
                        @elseif ($msg->status == 'Move to Next Day')
                            <span class="badge rounded-pill btnInset ms-3" style="background-color: #705601;">
                                {{ $msg->status }}
                            </span>
                        @elseif ($msg->status == 'Complete in Next Day')
                            <span class="badge rounded-pill btnInset" style="background-color: #df7700; color: black;">
                                {{ $msg->status }}
                            </span>
                        @elseif ($msg->status == 'Completed')
                            <span class="badge rounded-pill btnInset px-5" style="background-color: #003c96;">
                                {{ $msg->status }}
                            </span>
                        @else
                            <span class="badge rounded-pill text-bg-info text-dark py-1 px-4 btnInset">
                                {{ $msg->status }}
                            </span>
                        @endif
                    </td>   
                    <td>
                        <!-- Button trigger modal -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('oneMessageForUser.show', $msg->id) }}" class="btn btn-primary btn-sm"
                                type="button">View</a>
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

    {{-- Pagination links --}}
    <div style="margin-top:30px">
        {{ $messages->links() }}
    </div>

</div>


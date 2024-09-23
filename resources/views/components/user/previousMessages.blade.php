<div class="table-responsive">
    <div class="table-wrapper">

        <!-- Table Section -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr style="text-align:center">
                    <th style="height: 60px; vertical-align: middle;">
                        Date
                    </th>
                    <th style="height: 60px; vertical-align: middle;">
                        Request
                    </th>
                    <th style="height: 60px; vertical-align: middle;">Subject</th>
                    <th style="height: 60px; vertical-align: middle; width: 20%;">Progress</th>
                    <th style="height: 60px; vertical-align: middle;">Actions</th>
                </tr>
            </thead>
            <tbody style="text-align:center">
                @foreach ($messages as $msg)
                    <tr>
                        <td>{{ $msg->created_at->format('Y-m-d') }}</td>

                        <!-- Request Column with Conditions -->
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

                        <!-- Subject Column -->
                        <td>{{ $msg->subject }}</td>

                        <!-- Status Column with Conditions -->
                        <td>
                            @if ($msg->status == 'Completed')
                                <span
                                    class="badge rounded-pill text-bg-success btnInset mt-1 py-1 px-5">{{ $msg->status }}</span>
                            @elseif ($msg->status == 'Completed in next day')
                                <span
                                    class="badge rounded-pill text-bg-warning btnInset mt-1 py-1 px-2">{{ $msg->status }}</span>
                            @elseif ($msg->status == 'Document Pending')
                                <span
                                    class="badge rounded-pill text-bg-info btnInset mt-1 py-1 px-4">{{ $msg->status }}</span>
                            @elseif (in_array($msg->status, ['In Progress', 'In Queue']))
                                <span
                                    class="badge rounded-pill text-bg-info btnInset mt-1 py-1 px-5">{{ $msg->status }}</span>
                            @elseif ($msg->status == 'Move to next day')
                                <span
                                    class="badge rounded-pill text-bg-danger btnInset mt-1 py-1 px-4">{{ $msg->status }}</span>
                            @elseif ($msg->status == 'Postponed')
                                <span
                                    class="badge rounded-pill text-bg-danger btnInset mt-1 py-1 px-5">{{ $msg->status }}</span>
                            @else
                                <span
                                    class="badge rounded-pill text-bg-info btnInset mt-1 text-dark py-1 px-4">{{ $msg->status }}</span>
                            @endif
                        </td>

                        <!-- Actions Column -->
                        <td>
                            <div class="d-grid gap-2">
                                <a href="{{ route('oneMessageForUser.show', $msg->id) }}"
                                    class="btn btn-outline-primary" type="button">View</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div style="margin-top:30px">
            {{ $messages->links() }}
        </div>
    </div>
</div>

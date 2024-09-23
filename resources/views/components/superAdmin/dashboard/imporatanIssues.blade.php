<style>
    .th {
        height: 60px;
        vertical-align: middle;
    }
</style>

<div class="container-fluid mt-3">
    <div class="table-responsive">
        <div class="table-wrapper">

            {{-- Table section --}}
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr style="text-align:center">
                        <th>Date</th>
                        <th>Assign</th>
                        <th>Priority</th>
                        <th>Progress</th>
                        <th>Request</th>
                        <th>Institute Name</th>
                        <th>Subject</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($issues as $issue)
                        <tr>
                            <td>{{ $issue->id }}</td>
                            <td>{{ $issue->title }}</td>
                            <td><span class="badge bg-{{ $issue->status_class }}">{{ $issue->status }}</span></td>
                            <td><span class="badge bg-{{ $issue->priority_class }}">{{ $issue->priority }}</span></td>
                            <td>{{ $issue->assigned_to }}</td>
                            <td>{{ $issue->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

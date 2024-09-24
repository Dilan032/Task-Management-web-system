<div class="card">
    <div class="card-header">Issues List</div>
    <div class="card-body">
        <ul class="list-group">
            @foreach($issuesList as $issue)
                <li class="list-group-item">
                    <strong>Subject:</strong> {{ $issue->subject }} <br>
                    <strong>Priority:</strong> {{ $issue->priority }} <br>
                    <strong>Status:</strong> {{ $issue->status }}
                </li>
            @endforeach
        </ul>
    </div>
</div>

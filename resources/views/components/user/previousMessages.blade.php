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
            @if ($messages->first()->request !== 'pending')  {{-- Check if the first message's request is not 'pending' --}}
            <div class="col-12 col-sm-auto col-md-2">
                <span class="">Progress</span>
            </div>
            @endif
            <div class="col-12 col-sm-auto col-md-1">
                <span class="">Action</span>
            </div>
        </div>
    </div>
</div>

@foreach ($messages as $msg)
    {{-- start message content --}}
    <div class="mb-3 bg-primary-subtle text-black messageBG rounded">
        <div class="text-center">
            <div class="row">
                <div class="col-12 col-sm-auto col-md-2">
                    <small>{{ \Carbon\Carbon::parse($msg->created_at)->format('d M Y') }}</small>
                </div>
                <div class="col-12 col-sm-auto col-md-1">
                    @if ($msg->request == 'accept')
                        <span class="badge rounded-pill text-bg-success btnInset mt-1 py-1 px-3">{{ $msg->request }}</span>
                    @elseif ($msg->request == 'reject')
                        <span class="badge rounded-pill text-bg-danger btnInset mt-1 py-1 px-3">{{ $msg->request }}</span>
                    @else
                        <span class="badge rounded-pill text-bg-warning btnInset mt-1 py-1 px-2">{{ $msg->request }}</span>
                    @endif
                </div>
                <div class="col-12 col-sm-auto col-md-6">
                    <span>
                        <small>{{ $msg->subject }}</small>
                    </span>
                </div>
                @if ($msg->request !== 'pending')  {{-- Conditionally show Progress column --}}
                <div class="col-12 col-sm-auto col-md-2">
                    @if ($msg->status == 'Completed')
                        <span class="badge rounded-pill text-bg-success btnInset mt-1 py-1 px-5">{{ $msg->status }}</span>
                    @elseif ($msg->status == 'Completed in next day')
                        <span class="badge rounded-pill text-bg-warning btnInset mt-1 py-1 px-2">{{ $msg->status }}</span>
                    @elseif ($msg->status == 'Document Pending')
                        <span class="badge rounded-pill text-bg-info btnInset mt-1 py-1 px-4">{{ $msg->status }}</span>
                    @elseif ($msg->status == 'In Progress')
                        <span class="badge rounded-pill text-bg-info btnInset mt-1 py-1 px-5">{{ $msg->status }}</span>
                    @elseif ($msg->status == 'In Queue')
                        <span class="badge rounded-pill text-bg-info btnInset mt-1 py-1 px-5">{{ $msg->status }}</span>
                    @elseif ($msg->status == 'Move to next day')
                        <span class="badge rounded-pill text-bg-danger btnInset mt-1 py-1 px-4">{{ $msg->status }}</span>
                    @elseif ($msg->status == 'Postponed')
                        <span class="badge rounded-pill text-bg-danger btnInset mt-1 py-1 px-5">{{ $msg->status }}</span>
                    @else
                        <span class="badge rounded-pill text-bg-info btnInset mt-1 text-dark py-1 px-4">{{ $msg->status }}</span>
                    @endif
                </div>
                @endif
                <div class="col-12 col-sm-auto col-md-1">
                    <!-- Button trigger modal -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('oneMessageForUser.show', $msg->id) }}" class="btn btn-primary btn-sm" type="button">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Pagination links --}}
<div style="margin-top:30px">
    {{ $messages->links() }}
</div>

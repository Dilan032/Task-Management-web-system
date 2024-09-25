@extends('layouts.superAdminLayout')
@section('SuperAdminContent')



@endsection


<!-- Display the issue details -->
{{-- <div class="container">
    <h2>Important Issue Details</h2>
    <div class="p-3 mb-2 bg-light text-dark rounded">
        <h4>Subject: {{ $issue->subject }}</h4>
        <p>Status: {{ $issue->status }}</p>
        <p>Priority: {{ $issue->priority }}</p>
        <p>Institute: {{ $issue->institute->institute_name }}</p>
        <p>Created At: {{ \Carbon\Carbon::parse($issue->created_at)->format('d M Y h:i A') }}</p>
        <h5>Message Sender Details</h5>
        <p>Name: {{ $issue->user->name }}</p>
        <p>Contact: {{ $issue->user->user_contact_num }}</p>
        <p>Email: {{ $issue->user->email }}</p>
    </div>
</div> --}}

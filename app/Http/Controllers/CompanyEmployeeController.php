<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyEmployeeController extends Controller
{
    //company Employee Dashboard
    public function index(Request $request) {
        $loginUserId = Auth::user()->id;
        $employee = DB::table('users')->where('id', $loginUserId)->select('name')->first();
        $employeeName = $employee->name;

        // Fetch all institutes assigned to the employee
        $assignedInstitutes = DB::table('institutes')->where('assigned_employee', $employeeName)->get();

        // Initialize query for filtering messages
        $messagesQuery = Message::with('institute')
            ->where('assigned_employee', $employeeName)
            ->where('sp_request', 'Accepted'); // Ensure messages are accepted

        // Apply filters if present
        if ($request->has('institute') && $request->institute != '') {
            $messagesQuery->whereHas('institute', function($query) use ($request) {
                $query->where('institute_name', $request->institute);
            });
        }

        if ($request->has('priority') && $request->priority != '') {
            $messagesQuery->where('priority', $request->priority);
        }

        if ($request->has('progress') && $request->progress != '') {
            $messagesQuery->where('status', $request->progress);
        }

        // Sort by created_at in descending order (or use any other column like updated_at, id, etc.)
        $messagesQuery->orderBy('created_at', 'DESC');

        // Get filtered messages
        $messages = $messagesQuery->get();

        return view('companyEmployee/dashboard', [
            'messages' => $messages,
            'assignedInstitutes' => $assignedInstitutes,
        ]);

    }

    //view institute user message and store current time
    public function messageView($id)
    {
    $messages = Message::findOrFail($id);

    if (is_null($messages->viewed_at)) {
        $messages->viewed_at = now();
        $messages->save();
    }

    return view('companyEmployee/message', ['messages' => $messages]);

    }

    //change company employee password
    public function changePassword(){
        return view('companyEmployee.changePassword');
    }

    public function updateStatus(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'status' => 'required|string',
        'progress_note' => 'nullable|string',  // Add validation for progress_note
    ]);

    // Find the message by ID
    $messages = Message::find($id);

    if ($messages) {
        // Update the status and progress note
        $messages->status = $request->input('status');
        $messages->progress_note = $request->input('progress_note');  // Store progress note
        $messages->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    return redirect()->back()->withErrors('Message not found.');
}


public function updatePriority(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'priority' => 'required|string',
    ]);

    // Find the message by ID
    $messages = Message::find($id);

    if ($messages) {
        // Update the priority with a string value
        $messages->priority = $request->input('priority');
        $messages->save();

        return redirect()->back()->with('success', 'Priority updated successfully!');
    }

    return redirect()->back()->withErrors('Message not found.');
}

public function startTimer($id)
{
    $messages = Message::find($id);
    $messages->start_time = now();
    $messages->status = 'In Progress';
    $messages->save();

    return response()->json(['status' => 'success']);
}

public function endTimer($id)
{
    $messages = Message::find($id);
    $messages->end_time = now();
    $messages->status = 'Completed';
    $messages->save();

    return response()->json(['status' => 'success']);
}

public function updateTimesAndStatus(Request $request, $id)
{
    $message = Message::find($id);

    if ($request->has('start_time')) {
        $message->start_time = $request->input('start_time');
    }

    if ($request->has('end_time')) {
        $message->end_time = $request->input('end_time');
    }

    if ($request->has('status')) {
        $message->status = $request->input('status');
    }

    $message->save();

    return response()->json(['status' => 'success']);
}

public function updateProgressNote(Request $request, $id)
{
    // Validate the input
    $request->validate([
        'progress_note' => 'required|string',
    ]);

    // Find the message by ID
    $messages = Message::find($id);

    if ($messages) {
        // Update the progress note
        $messages->progress_note = $request->input('progress_note');
        $messages->save();

        return redirect()->back()->with('success', 'Progress note updated successfully!');
    }

    return redirect()->back()->withErrors('Message not found.');
}
}

<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ViewMessageController extends Controller
{
    public function show($mid)
    {
        $message = Message::find($mid);  // Find the message by ID
        $oneMessage = DB::table('messages')
            ->where('id', $mid)
            ->orderBy('created_at', 'DESC')
            ->first();

        // Get all employees with user_type 'company employee' or 'super admin'
        $employees = User::whereIn('user_type', ['company employee', 'super admin'])
            ->select('id', 'name') // Select only the ID and name
            ->get();

        // Check if message exists and the current user is the assigned employee
        if ($message && Auth::user()->name === $message->assigned_employee) {
            // Update the viewed_at timestamp if it's not already set
            if (!$message->viewed_at) {
                $message->viewed_at = now(); // Store current timestamp
                $message->save(); // Save the changes
            }
        }

        if ($message) {
            return view('superAdmin.viewmessage', compact('message', 'employees', 'oneMessage'));  // Return the view with message and employees
        } else {
            return redirect()->route('superAdmin.allmessages.view')->with('error', 'Message not found');  // Redirect if not found
        }
    }

    // Update assigned employee when dropdown is changed
    public function updateAssignedEmployee(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        // Validate the input
        $request->validate([
            'assigned_employee' => 'required|string',
            'assigned_employee_id' => 'required|integer', // Validate the employee ID as well
        ]);

        // Update the assigned_employee and assigned_employee_id in the message
        if ($message) {
            // Set the assigned_employee and assigned_employee_id from the request
            $message->assigned_employee = $request->input('assigned_employee');
            $message->assigned_employee_id = $request->input('assigned_employee_id'); // Store the ID

            // Reset start_time, end_time, and viewed_at when the assigned_employee changes
            $message->start_time = null;
            $message->end_time = null;
            $message->viewed_at = null;

            // Set the progress status to 'In Queue'
            $message->status = 'In Queue';

            // Save the changes to the database
            $message->save();
        }

        return redirect()->back()->with('success', 'Employee assigned successfully!');
    }




    public function updateStatus(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'status' => 'required|string',
            'progress_note' => 'nullable|string',  // Add validation for progress_note
        ]);

        // Find the message by ID
        $message = Message::find($id);

        if ($message) {
            // Update the status and progress note
            $message->status = $request->input('status');
            $message->progress_note = $request->input('progress_note');  // Store progress note
            $message->save();

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
        $message = Message::find($id);

        if ($message) {
            // Update the priority with a string value
            $message->priority = $request->input('priority');
            $message->save();

            return redirect()->back()->with('success', 'Priority updated successfully!');
        }

        return redirect()->back()->withErrors('Message not found.');
    }

    public function startTimer($id)
    {
        $message = Message::findOrFail($id);
        $message->start_time = now();
        $message->status = 'In Progress';
        $message->save();

        return response()->json(['status' => 'success']);
    }

    public function endTimer($id)
    {
        $message = Message::findOrFail($id);
        $message->end_time = now();
        $message->status = 'Completed';
        $message->save();

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
        $message = Message::find($id);

        if ($message) {
            // Update the progress note
            $message->progress_note = $request->input('progress_note');
            $message->save();

            return redirect()->back()->with('success', 'Progress note updated successfully!');
        }

        return redirect()->back()->withErrors('Message not found.');
    }

    // Accept SP request and update assigned_employee_id
    public function acceptSpRequest(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        // Validate the assigned_employee_id
        $request->validate([
            'assigned_employee_id' => 'required|integer',
        ]);

        // Update the SP request status and the assigned_employee_id
        $message->sp_request = 'Accepted';
        $message->assigned_employee_id = $request->input('assigned_employee_id');  // Update the assigned employee ID
        $message->save();

        return redirect()->back()->with('success', 'SP request accepted and employee assigned.');
    }
}

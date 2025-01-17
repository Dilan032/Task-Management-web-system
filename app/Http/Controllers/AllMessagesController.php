<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AllMessagesController extends Controller
{
    // Display all messages with optional filtering
    public function index(Request $request)
    {
        // Retrieve query parameters for filtering
        $assignedUser = $request->input('assigned_employee');
        $priority = $request->input('priority');
        $progress = $request->input('progress');

        // Query to get messages with filters applied
        $query = DB::table('messages')
            ->leftJoin('institutes', 'messages.institute_id', '=', 'institutes.id') // Join with the institutes table
            ->select('messages.*', 'institutes.institute_name') // Select messages fields and institute_name
            ->where('messages.request', 'Accept')  // Only show messages where request is 'Accept'
            ->orderBy('messages.created_at', 'DESC'); // Order messages by created_at

        // Apply filters
        if ($assignedUser) {
            $query->where('messages.assigned_employee', $assignedUser);
        }

        if ($priority) {
            $query->where('messages.priority', $priority);
        }

        if ($progress) {
            $query->where('messages.status', $progress);
        }

        // Paginate results
        $messages = $query->paginate(10);

        // Retrieve all institutes to populate dropdown for filtering or selecting an institute
        $institutes = DB::table('institutes')->select('id', 'institute_name')->get();

        // Status counts for the dashboard
        $statusCounts = [
            'In Queue' => Message::where('status', 'In Queue')->where('request', 'Accept')->count(),
            'In Progress' => Message::where('status', 'In Progress')->where('request', 'Accept')->count(),
            'Document Pending' => Message::where('status', 'Document Pending')->where('request', 'Accept')->count(),
            'Postponed' => Message::where('status', 'Postponed')->where('request', 'Accept')->count(),
            'Move to Next Day' => Message::where('status', 'Move to Next Day')->where('request', 'Accept')->count(),
            'Complete in Next Day' => Message::where('status', 'Complete in Next Day')->where('request', 'Accept')->count(),
            'Completed' => Message::where('status', 'Completed')->where('request', 'Accept')->count(),
        ];

        // Return view with data, including the list of institutes
        return view('superAdmin.allmessages', compact('messages', 'statusCounts', 'institutes'));
    }

    public function store(Request $request)
    {
        // Get all employees with user_type 'company employee' or 'super admin'
        $employees = User::whereIn('user_type', ['company employee', 'super admin'])
            ->select('id', 'name') // Select only the ID and name
            ->get();

        // Define validation rules
        $rules = [
            'institute_id' => 'required|integer|exists:institutes,id',
            'assigned_employee_id' => 'required|integer',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'img_1' => 'nullable|image|max:4096',
            'img_2' => 'nullable|image|max:4096',
            'img_3' => 'nullable|image|max:4096',
            'img_4' => 'nullable|image|max:4096',
            'img_5' => 'nullable|image|max:4096',
        ];

        // Validate request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the authenticated user ID
        $userId = Auth::id();

        // Retrieve the selected institute ID from the request
        $instituteId = $request->input('institute_id');

        // Retrieve the assigned employee's ID from the selected institute
        $assignedEmployeeId = Institute::where('id', $instituteId)->value('assigned_employee');

        // Check if the assigned employee ID is valid
        if (!$assignedEmployeeId) {
            return redirect()->back()->withErrors(['assigned_employee' => 'No employee is assigned to this institute.'])->withInput();
        }

        // Create a new message instance
        $newMessage = new Message;
        $newMessage->user_id = $userId;
        $newMessage->institute_id = $instituteId;
        $newMessage->assigned_employee = $assignedEmployeeId; // Store the assigned employee ID
        $newMessage->subject = $request->input('subject');
        $newMessage->message = $request->input('message');

        // Set the 'request' and 'sp_request' columns
        $newMessage->request = 'Accept';
        $newMessage->sp_request = 'Accepted';

        // Handle the image file uploads
        $imageFields = ['img_1', 'img_2', 'img_3', 'img_4', 'img_5'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $imageName = uniqid() . '_' . $field . '.' . $request->file($field)->extension();
                $request->file($field)->move(public_path('images/MessageWithProblem'), $imageName);
                $newMessage->$field = $imageName;
            }
        }

        // Save the message to the database
        $newMessage->save();

        // Redirect back with a success message
        return redirect()->route('superAdmin.allmessages.view')->with('success', 'Message sent to the NanoSoft Solutions Company.');
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Return view with data
        return view('superAdmin.allmessages', compact('messages', 'statusCounts'));
    }
}

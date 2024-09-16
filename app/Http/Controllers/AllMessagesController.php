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
        $query = Message::query();

        // Build query with search and filters
        $query = DB::table('messages')->orderBy('created_at', 'DESC');

        if ($assignedUser) {
            $query->where('assigned_employee', $assignedUser);
        }

        if ($priority) {
            $query->where('priority', $priority);
        }

        if ($progress) {
            $query->where('status', $progress);
        }

        // Paginate results
        $messages = $query->paginate(10);

        // Status counts for the dashboard
        $statusCounts = [
            'In Queue' => Message::where('status', 'In Queue')->count(),
            'In Progress' => Message::where('status', 'In Progress')->count(),
            'Document Pending' => Message::where('status', 'Document Pending')->count(),
            'Postponed' => Message::where('status', 'Postponed')->count(),
            'Move to Next Day' => Message::where('status', 'Move to Next Day')->count(),
            'Complete in Next Day' => Message::where('status', 'Complete in Next Day')->count(),
            'Completed' => Message::where('status', 'Completed')->count(),
        ];

        return view('superAdmin.allmessages', compact('messages', 'statusCounts'));
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Message;
use Illuminate\Http\Request;

class AllMessagesController extends Controller
{
    // public function allMessagesShow()
    // {
    //     return view('superAdmin.allmessages');
    // }

    public function index()
    {
        // Retrieve all messages from the database
        $messages = Message::all();

        $statusCounts = [
            'In Queue' => Message::where('status', 'In Queue')->count(),
            'In Progress' => Message::where('status', 'In Progress')->count(),
            'Document Pending' => Message::where('status', 'Document Pending')->count(),
            'Postponed' => Message::where('status', 'Postponed')->count(),
            'Move to next day' => Message::where('status', 'Move to next day')->count(),
            'Complete in next day' => Message::where('status', 'Complete in next day')->count(),
            'Completed' => Message::where('status', 'Completed')->count(),
        ];

        return view('superAdmin.allmessages', compact('messages', 'statusCounts'));
    }
}

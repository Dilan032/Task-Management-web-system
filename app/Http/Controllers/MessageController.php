<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function SaveMessage(Request $request)
    {
        // Define validation rules
        $rules = [
            'subject' => 'Required|String|max:255',
            'message' => 'Required|String',
            'img_1' => 'nullable|image|max:4096',
            'img_2' => 'nullable|image|max:4096',
            'img_3' => 'nullable|image|max:4096',
            'img_4' => 'nullable|image|max:4096',
            'img_5' => 'nullable|image|max:4096',
        ];

        // Check rules
        $validator = Validator::make($request->all(), $rules);

        // If rules fail
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the authenticated user ID and institute_id
        $userId = Auth::id();
        $userInstituteId = Auth::user()->institute_id;

        // Retrieve the assigned employee for the user's institute
        $assignedEmployee = Institute::where('id', $userInstituteId)->value('assigned_employee');

        // Create a new message
        $NewMessage = new Message;
        $NewMessage->user_id = $userId;
        $NewMessage->institute_id = $userInstituteId;
        $NewMessage->assigned_employee = $assignedEmployee; // Set the assigned employee
        $NewMessage->subject = $request->input('subject');
        $NewMessage->message = $request->input('message');

        // Handle image uploads
        $imageFields = ['img_1', 'img_2', 'img_3', 'img_4', 'img_5'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $imageName = uniqid() . '_' . $field . '.' . $request->$field->extension();
                $request->$field->move(public_path('images/MessageWithProblem'), $imageName);
                $NewMessage->$field = $imageName;
            }
        }

        // Save the message to the database
        $NewMessage->save();

        return redirect()->route('message.save')->with('success', 'Message Sent to the institute Administrator');
    }

    public function showOneMessage($mid)
    {
        $user_id = Auth::id();
        $oneMessage = DB::table('messages')
            ->where('id', $mid)
            ->orderBy('created_at', 'DESC')
            ->first();
        $messagesTableDataUser = Message::with('user')
            ->where('id', $mid)
            ->first();

        return view('user.oneMessage', compact('oneMessage', 'messagesTableDataUser'));
    }
}

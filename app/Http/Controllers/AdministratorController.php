<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Institute;
use Illuminate\Http\Request;
use App\Mail\mail_for_problem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    //Institute administrator dashboard view load function
    public function index(Request $request)
    {
        if (Auth::check()) {
            $instituteId = Auth::user()->institute_id;
            $userName = Auth::user()->name;
        } else {
            // Redirect to the login page or show an error
            return redirect()->route('login');
        }

        $institute = DB::table('institutes')
            ->where('id', $instituteId)
            ->first();

        $NumAdministrators = DB::table('users')
            ->where('institute_id', $instituteId)
            ->where('user_type', 'administrator')
            ->count();

        $NumActiveAdministrators = DB::table('users')
            ->where('institute_id', $instituteId)
            ->where('user_type', 'administrator')
            ->where('status', 'active')
            ->count();
        $NumInactiveAdministrators = DB::table('users')
            ->where('institute_id', $instituteId)
            ->where('user_type', 'administrator')
            ->where('status', 'inactive')
            ->count();

        // count institute users
        $NumUsers = DB::table('users')
            ->where('institute_id', $instituteId)
            ->where('user_type', 'user')
            ->count();

        $NumActiveUsers = DB::table('users')
            ->where('institute_id', $instituteId)
            ->where('user_type', 'user')
            ->where('status', 'active')
            ->count();
        $NumInactiveUsers = DB::table('users')
            ->where('institute_id', $instituteId)
            ->where('user_type', 'user')
            ->where('status', 'inactive')
            ->count();

        //get message table details send by institute employee
        $NumMessages = DB::table('messages')
            ->where('institute_id', $instituteId)
            ->count();

        // $NumPendingMsg = DB::table('messages')
        //     ->where('institute_id', $instituteId)
        //     ->where('request', 'pending')
        //     ->count();
        // $NumAcceptMsg = DB::table('messages')
        //     ->where('institute_id', $instituteId)
        //     ->where('request', 'accept')
        //     ->count();
        // $NumRejectMsg = DB::table('messages')
        //     ->where('institute_id', $instituteId)
        //     ->where('request', 'reject')
        //     ->count();

        // Get the selected filter from the request
        $filter = $request->input('filter', 'today'); // Default to 'today'

        // Base query for messages
        $messagesQuery = DB::table('messages')->where('institute_id', $instituteId);

        // Apply filter based on selection
        if ($filter === 'yesterday') {
            $messagesQuery->whereDate('created_at', now()->subDay());
        } elseif ($filter === 'last_week') {
            $messagesQuery->whereDate('created_at', '>=', now()->subWeek());
        } elseif ($filter === 'last_month') {
            $messagesQuery->whereDate('created_at', '>=', now()->subMonth());
        } else {
            // Default is today
            $messagesQuery->whereDate('created_at', now());
        }

        // Count messages based on the filter
        $NumMessages = $messagesQuery->count();

        // Count specific message requests based on the same filter
        $NumPendingMsg = $messagesQuery->clone()->where('request', 'pending')->count();
        $NumAcceptMsg = $messagesQuery->clone()->where('request', 'accept')->count();
        $NumRejectMsg = $messagesQuery->clone()->where('request', 'reject')->count();

        // Message status count
        $NumSolvedMsg = $messagesQuery->clone()->where('status', 'Completed')->count();
        $NumDocPendingMsg = $messagesQuery->clone()->where('status', 'Document Pending')->count();

        // Count for processing statuses
        $NumProcessing = $messagesQuery->clone()->whereIn('status', [
            'In Queue',
            'In Progress',
            'Postponed',
            'Move to next day',
            'Complete in next day'
        ])->count();

        return view('administrator.administratorDashbord', [
            'institute' => $institute,
            'userName' => $userName,
            'NumAdministrators' => $NumAdministrators,
            'NumUsers' => $NumUsers,
            'NumActiveUsers' => $NumActiveUsers,
            'NumInactiveUsers' => $NumInactiveUsers,
            'NumActiveAdministrators' => $NumActiveAdministrators,
            'NumInactiveAdministrators' => $NumInactiveAdministrators,
            'NumMessages' => $NumMessages,
            'NumPendingMsg' => $NumPendingMsg,
            'NumAcceptMsg' => $NumAcceptMsg,
            'NumRejectMsg' => $NumRejectMsg,
            'NumSolvedMsg' => $NumSolvedMsg,
            'NumDocPendingMsg' => $NumDocPendingMsg,
            'NumProcessing' => $NumProcessing,
        ]);
    }

    //Institute administrator message showing function.
    public function messages(Request $request)
    {
        if (Auth::check()) {
            $userInstituteId = Auth::user()->institute_id;
            $query = DB::table('messages')
                ->where('institute_id', $userInstituteId);

            // Apply filter for date range
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }

            // Apply filter for status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Get messages with pagination
            $messages = $query->orderBy('created_at', 'DESC')->paginate(5);

            return view('administrator.message', ['messages' => $messages]);
        } else {
            // Redirect to the login page or show an error
            return redirect()->route('login');
        }
    }

    //Institute administrator specific message showing function.
    public function showOneMessage($mid)
    {
        if (Auth::check()) {
            $userid = Auth::id();
            $oneMessage = DB::table('messages')
                ->where('id', $mid)
                ->first();
            $messagesTableDataUser = Message::with('user')
                ->where('id', $mid)
                ->first();

            // Determine the display name based on the user's type
            $userName = ($messagesTableDataUser->user->user_type == 'super admin' || $messagesTableDataUser->user->user_type == 'company employee')
                ? 'Nanosoft Solution'
                : $messagesTableDataUser->user->name;

            return view('administrator.messageOne', compact('oneMessage', 'messagesTableDataUser', 'userName'));
        } else {
            // Redirect to the login page or show an error
            return redirect()->route('login');
        }
    }

    //Institute administrator messages conform function
    public function ConformMessage(Request $request, $mid)
    {
        $message = Message::findOrFail($mid);
        $message->request = $request->input('request');
        $message->update();

        //get message data from message table
        $problemSendserUserId = $message->user_id;
        $subject = $message->subject;
        $messageDetails = $message->message;

        if (Auth::check()) {
            //get authenticate user details
            $userInstituteId = Auth::user()->institute_id;
            $administratorName = Auth::user()->name;
            $administratorEmail = Auth::user()->email;
            $administratorContactNumber = Auth::user()->user_contact_num;
        } else {
            return redirect()->route('login');
        }
        //get problem occur user details
        $problemSendserUser = DB::table('users')
            ->where('id', $problemSendserUserId)
            ->select('name', 'user_contact_num', 'email')
            ->first();

        $userName = $problemSendserUser->name;
        $user_contact_num = $problemSendserUser->user_contact_num;
        $email = $problemSendserUser->email;

        //get institute details
        $instituteDetails = DB::table('institutes')
            ->where('id', $userInstituteId)
            ->first();

        //get problem send user details
        // Get the user_id from the messages table
        // $messageUserId = DB::table('messages')
        // ->where('id', $mid)
        // ->select('user_id')
        // ->first();
        // Now retrieve the user details using the user_id
        // $user = DB::table('users')
        // ->where('id', $messageUserId->user_id)
        // ->get();


        //get institute name, Address from institute table

        $instituteName = $instituteDetails->institute_name;
        $instituteAddress = $instituteDetails->institute_address;
        $instituteContactNumber = $instituteDetails->institute_contact_num;

        //get Super Admin Email Adress
        $superAdminEmail = DB::table('users')
            ->where('user_type', 'super admin')
            ->pluck('email')
            ->toArray();

        Mail::to($superAdminEmail)->send(new mail_for_problem(
            $subject,
            $messageDetails,
            $administratorName,
            $administratorEmail,
            $administratorContactNumber,
            $instituteName,
            $instituteAddress,
            $instituteContactNumber,
            $userName,
            $user_contact_num,
            $email
        ));


        return redirect()->back()->with('success', 'User message send to the NanoSoft Solutions (Pvt)Ltd');
    }

    //Institute administrator message reject function
    public function RejectMessage(Request $request, $mid)
    {
        $message = Message::findOrFail($mid);
        $message->request = $request->input('request');
        $message->update();

        return redirect()->back()->with('success', 'User message rejected');
    }

    //Administrator write new message(issue message) function
    public function SaveMessageAdministrator(Request $request)
    {
        //define validation rules
        $rules = [
            'subject' => 'Required|String|max:255',
            'message' => 'Required|String',
            'img_1' => 'nullable|image|max:4096',
            'img_2' => 'nullable|image|max:4096',
            'img_3' => 'nullable|image|max:4096',
            'img_4' => 'nullable|image|max:4096',
            'img_5' => 'nullable|image|max:4096',
        ];

        //check rules
        $validator = Validator::make($request->all(), $rules);

        //if rules fail
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the authenticated user ID
        $userId = Auth::id();
        $userInstituteId = Auth::user()->institute_id;

        // Retrieve the assigned employee for the user's institute
        $assignedEmployee = Institute::where('id', $userInstituteId)->value('assigned_employee');

        $NewMessage = new Message;
        $NewMessage->user_id = $userId;
        $NewMessage->institute_id = $request->input('institute_id');
        $NewMessage->assigned_employee = $assignedEmployee;
        $NewMessage->subject = $request->input('subject');
        $NewMessage->request = $request->input('request');
        $NewMessage->message = $request->input('message');

        // Handle the image file uploads
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

        // Get authenticated user details
        if (Auth::check()) {
            $administratorName = Auth::user()->name;
            $administratorEmail = Auth::user()->email;
            $administratorContactNumber = Auth::user()->user_contact_num;
        } else {
            return redirect()->route('login');
        }


        //get institute details
        $instituteDetails = DB::table('institutes')
            ->where('id', $userInstituteId)
            ->first();
        //get institute name, Address from institute table
        $instituteName = $instituteDetails->institute_name;
        $instituteAddress = $instituteDetails->institute_address;
        $instituteContactNumber = $instituteDetails->institute_contact_num;

        //get Super Admin Email Adress
        $superAdminEmail = DB::table('users')
            ->where('user_type', 'super admin')
            ->pluck('email')
            ->toArray();

        //get email data for send email
        $problemSendserUserId = $NewMessage->user_id;
        $subject = $NewMessage->subject;
        $messageDetails = $NewMessage->message;

        //get problem occur user details
        $problemSendserUser = DB::table('users')
            ->where('id', $problemSendserUserId)
            ->select('name', 'user_contact_num', 'email')
            ->first();

        $userName = $problemSendserUser->name;
        $user_contact_num = $problemSendserUser->user_contact_num;
        $email = $problemSendserUser->email;

        Mail::to($superAdminEmail)->send(new mail_for_problem(
            $subject,
            $messageDetails,
            $administratorName,
            $administratorEmail,
            $administratorContactNumber,
            $instituteName,
            $instituteAddress,
            $instituteContactNumber,
            $userName,
            $user_contact_num,
            $email
        ));


        // Redirect back to 'administrator.messages' route
        return redirect()->route('administrator.messages')->with('success', 'Message sent to the NanoSoft Solutions Company.');
    }


    //Institute administrator, institute's employee management function
    public function users(Request $request)
    {
        // Retrieve the currently logged-in user's institute_id
        $instituteId = Auth::user()->institute_id;

        // Retrieve the institute based on the logged-in user's institute_id
        $institute = Institute::findOrFail($instituteId);

        // Build query to retrieve employees of the institute with user_type 'administrator' and 'user'
        $employeeQuery = DB::table('users')
            ->select('id', 'name', 'user_type', 'status', 'email', 'user_contact_num')
            ->where('institute_id', $instituteId)
            ->whereIn('user_type', ['administrator', 'user']);

        // Apply search by employee name
        if ($request->filled('search_employee_name')) {
            $employeeQuery->where('name', 'like', '%' . $request->search_employee_name . '%');
        }

        // Apply filter by employee type
        if ($request->filled('filter_employee_type')) {
            $employeeQuery->where('user_type', $request->filter_employee_type);
        }

        // Apply filter by employee status (active or not)
        if ($request->filled('filter_employee_status')) {
            $employeeQuery->where('status', $request->filter_employee_status);
        }

        // Paginate the results
        $employees = $employeeQuery->paginate(5);

        // Pass the data to the view
        return view('administrator.user_overview', [
            'institute' => $institute,
            'employees' => $employees,
        ]);
    }

    //Institute employee data management Update function in administrator account.
    public function instituteEmpUpdate(Request $request, $id)
    {
        // Find the company employee or super admin by ID
        $employee = User::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'user_contact_num' => 'required|string|max:12',
            'password' => 'nullable|string|min:8|confirmed',
            'status' => 'required|in:active,inactive', // Adding status validation
        ];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update employee details
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->status = $request->input('status');
        $employee->user_contact_num = $request->input('user_contact_num');

        // Check if password is provided and update it
        if ($request->filled('password')) {
            $employee->password = Hash::make($request->input('password'));
        }

        // Save the updated employee details
        $employee->update();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    //Institute employee data management Delete function in administrator account.
    public function instituteEmpDelete($id)
    {
        $user = User::find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->back()->with('error', 'Employee not found.');
        }

        // Store the user type for custom message
        $userType = strtolower($user->user_type); // Convert to lowercase for case-insensitive check

        // Delete the user
        $user->delete();

        // Customize the success message based on user type
        if ($userType == 'administrator') {
            $message = 'Administrator deleted successfully.';
        } elseif ($userType == 'user') {
            $message = 'Institute Employee deleted successfully.';
        } else {
            $message = ucfirst($userType) . ' deleted successfully.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function changePassword()
    {
        return view('administrator.changePassword');
    }

    // [administrator ] for logout
    public function administratorLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

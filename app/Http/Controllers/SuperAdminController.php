<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Institute;
use Illuminate\Http\Request;
use App\Models\InstituteTypes;
use App\Mail\userWellcomeMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function superadminDashbord()
    {
        $NumMsg = DB::table('messages')
            ->count();
        $NumMsgSolved = DB::table('messages')
            ->where('status', 'solved')
            ->count();
        $NumMsgNotSolved = DB::table('messages')
            ->where('status', 'not resolved')
            ->count();
        $NumMsgProcessing = DB::table('messages')
            ->where('status', 'Processing')
            ->count();
        $NumMsgViewed = DB::table('messages')
            ->where('status', 'Viewed')
            ->count();

        $NumInstitute = DB::table('institutes')
            ->count();

        $Numusers = DB::table('users')
            ->where('user_type', 'administrator')
            ->orWhere('user_type', 'user')
            ->count();
        $NumAdministrators = DB::table('users')
            ->where('user_type', 'administrator')
            ->count();
        $NumActiveAdministrators = DB::table('users')
            ->where('user_type', 'administrator')
            ->where('status', 'active')
            ->count();
        $NumUsers = DB::table('users')
            ->where('user_type', 'user')
            ->count();
        $NumActiveUsers = DB::table('users')
            ->where('user_type', 'user')
            ->where('status', 'active')
            ->count();

        $superAdmin = DB::table('users')
            ->where('user_type', 'super admin')
            ->get();


        return view(
            'superAdmin.superAdminDashbord',
            [
                'NumMsg' => $NumMsg,
                'NumMsgSolved' => $NumMsgSolved,
                'NumMsgNotSolved' => $NumMsgNotSolved,
                'NumInstitute' => $NumInstitute,
                'Numusers' => $Numusers,
                'NumAdministrators' => $NumAdministrators,
                'NumUsers' => $NumUsers,
                'NumActiveAdministrators' => $NumActiveAdministrators,
                'NumActiveUsers' => $NumActiveUsers,
                'superAdmin' => $superAdmin,
                'NumMsgProcessing' => $NumMsgProcessing,
                'NumMsgViewed' => $NumMsgViewed
            ]
        );
    }

    public function ViewMessages()
    {

        $solvedMessageCount = Message::where('request', 'accept')
            ->where('status', 'solved')
            ->count();

        $noSolvedMessageCount = Message::where('status', 'not resolved')
            ->where('request', 'accept')
            ->count();

        $ViewedMessageCount = Message::where('status', 'Viewed')
            ->where('request', 'accept')
            ->count();

        $processingMessageCount = Message::where('status', 'Processing')
            ->where('request', 'accept')
            ->count();


        $messagesAndInstitute = Message::with('institute')
            ->where('request', 'accept')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('superAdmin.messages', [
            'messagesAndInstitute' => $messagesAndInstitute,
            'noSolvedMessageCount' => $noSolvedMessageCount,
            'solvedMessageCount' => $solvedMessageCount,
            'ViewedMessageCount' => $ViewedMessageCount,
            'processingMessageCount' => $processingMessageCount
        ]);
    }

    // public function superAdminDetails($id)
    // {
    //     $superAdmin = User::where('user_type', 'super admin')->findOrFail($id);
    //     return view('superAdmin.superAdminDeatils', ['superAdmin' => $superAdmin]);
    // }


    public function companyEmpUpdate(Request $request, $id) // Company Employee Details Update function
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

    public function companyEmpDelete($id)
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
        if ($userType == 'super admin') {
            $message = 'Super Admin deleted successfully.';
        } elseif ($userType == 'company employee') {
            $message = 'Company Employee deleted successfully.';
        } else {
            $message = ucfirst($userType) . ' deleted successfully.';
        }

        return redirect()->back()->with('success', $message);
    }

    // for User Registration super admin
    public function RegisterSuperAdmin(Request $request)
    {
        $rules = [
            'user_type' => 'required|string',
            'password' => 'required|string|min:8|max:32|confirmed',
            'user_contact_num' => 'required|string|max:12',
            'email' => 'required|string|email|max:255|unique:users,email',
            'name' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newUser = new User;
        $newUser->user_type = $request->input('user_type');
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->user_contact_num = $request->input('user_contact_num');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->save();

        $plainPassword = $request->input('password');

        if (Auth::check()) {
            $RegisterAdminName = Auth::user()->name;
            $RegisterUserType = Auth::user()->user_type;
            $RegisterAadminEmail = Auth::user()->email;
            $RegisterAdminContactNumber = Auth::user()->user_contact_num;
        } else {
            return redirect()->route('login');
        }

        Mail::to($newUser->email)->send(new userWellcomeMessage(
            $newUser->user_type,
            $newUser->name,
            $newUser->email,
            $newUser->user_contact_num,
            $plainPassword,
            $RegisterAdminName,
            $RegisterUserType,
            $RegisterAadminEmail,
            $RegisterAdminContactNumber
        ));

        return redirect()->back()->with('success', 'User registered successfully!');
    }

    public function ViewOneMessages($id)
    {
        $oneMessage = Message::findorFail($id);

        return view('superAdmin.messageOne', ['oneMessage' => $oneMessage]);
    }

    public function ProblemResolvedOrNot(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        $rules = ['status' => 'required|string'];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $message->status = $request->input('status');
        $message->update();

        return redirect()->back()->with('success', 'Message status updated');
    }

    //$Institute variable used for while user registration form generate institute name list
    public function ViewUsers(Request $request)
    {
        // Build the query with filtering and search capabilities
        $employeeQuery = User::select('id', 'name', 'user_type', 'email', 'user_contact_num', 'last_seen', 'status')
            ->whereIn('user_type', ['super admin', 'company employee']);

        // Apply search for employee name
        if ($request->filled('search_employee_name')) {
            $employeeQuery->where('name', 'like', '%' . $request->search_employee_name . '%');
        }

        //Apply filter for employee type
        if ($request->filled('filter_employee_type')) {
            $employeeQuery->where('user_type', $request->filter_employee_type);
        }

        //Apply filter for employee status (online/offline)
        if ($request->filled('filter_employee_status')) {
            if ($request->filter_employee_status === 'online') {
                $employeeQuery->whereNotNull('last_seen');
            } elseif ($request->filter_employee_status === 'offline') {
                $employeeQuery->whereNull('last_seen');
            }
        }

        // Paginate the result
        $employees = $employeeQuery->paginate(5);

        $employeeCount = User::whereIn('user_type', ['super admin', 'company employee'])->count();

        // Get institutes data
        $institute = Institute::orderBy('created_at', 'DESC')->get();

        // Pass data to the view
        return view('superAdmin.users', [
            'employees' => $employees,
            'institute' => $institute,
            'employeeCount' => $employeeCount,
        ]);
    }

    public function deleteAllEmployees(Request $request)
    {
        // Validate the user ID (assuming you have user authentication)
        $userId = $request->input('user_id');

        // Check if the user ID is correct (you may need to implement your own authentication logic)
        if (Auth::user()->id != $userId) {
            return redirect()->back()->withErrors('Invalid user ID.');
        }

        // Delete all employees who are either 'super admin' or 'company employee'
        User::whereIn('user_type', ['super admin', 'company employee'])->delete();

        // Redirect with success message
        return redirect()->route('superAdmin.users.view')->with('success', 'All employees have been deleted.');
    }

    public function ViewInstitute(Request $request)
    {
        // Get data for institute list component
        $types = InstituteTypes::all();

        // Retrieve users with specific user types (super admin and company employee)
        // For institute assigned company employees
        $employees = DB::table('users')
            ->select('id', 'name', 'user_type')
            ->whereIn('user_type', ['super admin', 'company employee'])
            ->get();

        // Build query with search and filters
        $instituteQuery = DB::table('institutes')->orderBy('created_at', 'DESC');

        // Apply search for institute name
        if ($request->filled('search_institute_name')) {
            $instituteQuery->where('institute_name', 'like', '%' . $request->search_institute_name . '%');
        }

        // Apply filter for institute type
        if ($request->filled('filter_institute_type')) {
            $instituteQuery->where('institute_type', $request->filter_institute_type);
        }

        // Apply filter for assigned employee
        if ($request->filled('filter_assigned_employee')) {
            $instituteQuery->where('assigned_employee', $request->filter_assigned_employee);
        }

        // Paginate results
        $institute = $instituteQuery->paginate(3);

        // Get total counts
        $instituteCount = Institute::count();
        $activeInstituteCount = Institute::where('status', 'active')->count();
        $inactiveInstituteCount = Institute::where('status', 'inactive')->count();

        return view('superAdmin.institute', [
            'users' => DB::table('users')->get(),
            'institute' => $institute,
            'instituteCount' => $instituteCount,
            'activeInstituteCount' => $activeInstituteCount,
            'inactiveInstituteCount' => $inactiveInstituteCount,
            'types' => $types,
            'employees' => $employees,
        ]);
    }

    public function ViewOneInstitute($id)
    {
        $institute = Institute::find($id);
        return view('superAdmin.editInstitute', ['institute' => $institute]);
    }

    public function instituteUpdate(Request $request, $id)
    {
        // Find a single institute by ID
        $institute = Institute::findOrFail($id);

        // Validation rules
        $rules = [
            'institute_contact_num' => 'required|string|max:10',
            'email' => 'required|string|email|max:255',
            'institute_address' => 'required|string|max:255',
            'institute_name' => 'required|string|max:255',
            'assigned_employee' => 'required|string',
            'institute_type' => 'required|string',
        ];

        // Validate the input
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update institute fields
        $institute->institute_name = $request->input('institute_name');
        $institute->institute_address = $request->input('institute_address');
        $institute->institute_contact_num = $request->input('institute_contact_num');
        $institute->email = $request->input('email');
        $institute->institute_type = $request->input('institute_type');
        $institute->assigned_employee = $request->input('assigned_employee');

        // Save the changes
        $institute->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Institute updated successfully.');
    }


    public function instituteDelete($id)
    {
        $institute = Institute::find($id);
        $institute->delete();
        return redirect()->back()->with('success', 'institute Remove successfully.');
    }

    // [super admin] for logout
    public function superAdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}

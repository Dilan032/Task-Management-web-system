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

    public function superAdminDetails($id)
    {
        $superAdmin = User::where('user_type', 'super admin')->findOrFail($id);
        return view('superAdmin.superAdminDeatils', ['superAdmin' => $superAdmin]);
    }

    public function superAdminUpdate(Request $request, $id)
    {
        $superAdmin = User::where('user_type', 'super admin')->findOrFail($id);
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'user_contact_num' => 'required|string|max:12',
            'password' => 'nullable|string|min:8|confirmed',
        ];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $superAdmin->user_type = 'super admin';
        $superAdmin->name = $request->input('name');
        $superAdmin->email = $request->input('email');
        $superAdmin->status = $request->input('status');
        $superAdmin->user_contact_num = $request->input('user_contact_num');

        // Check if password is provided and update it
        if ($request->filled('password')) {
            $superAdmin->password = Hash::make($request->input('password'));
        }

        $superAdmin->update();

        // Redirect with a success message
        return redirect()->back()->with('success', 'User Update successfully!');
    }

    public function deleteSuperAdmin($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Super Admin deleted successfully.');
    }

    // for User Registration super admin
    public function RegisterSuperAdmin(Request $request)
    {
        $rules = [
            'password' => 'required|string|min:8|max:32|confirmed',
            'user_contact_num' => 'required|string|max:12',
            'email' => 'required|string|email|max:255|unique:users,email',
            'name' => 'required|string|max:255',
        ];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $newUser = new User;
        // $newUser->institute_id = $request->input('institute_id');
        $newUser->user_type = 'super admin';
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->user_contact_num = $request->input('user_contact_num');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->save();

        //for sent the new register user
        $plainPassword = $request->input('password');

        //get user register pertion details
        if (Auth::check()) {
            //get authenticate admin details
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

        // Redirect with a success message
        return redirect()->back()->with('success', 'User Registration successfully!');
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
    public function ViewUsers()
    {
        //get data for institute list component
        $users = DB::table('users')->get();
        $institute = DB::table('institutes')
            ->orderBy('created_at', 'DESC')
            ->get();
        //end



        return view(
            'superAdmin.users',
            ['users' => $users, 'institute' => $institute,]
        );
    }

    public function ViewInstitute()
    {
        // Get data for institute list component
        $types = InstituteTypes::all();

        // Retrieve users with specific user types (super admin and company employee)
        $employees = DB::table('users')
            ->select('id', 'name', 'user_type') // Only select the required fields
            ->whereIn('user_type', ['super admin', 'company employee']) // Filter by user type
            ->get();

        $users = DB::table('users')->get();

        // Ensure this uses paginate, not get
        $institute = DB::table('institutes')
            ->orderBy('created_at', 'DESC')
            ->paginate(10); // This returns a paginator instance

        $instituteCount = Institute::count();
        $activeInstituteCount = Institute::where('status', 'active')->count();
        $inactiveInstituteCount = Institute::where('status', 'inactive')->count();

        // Pass 'types' and 'institute' to the view
        return view('superAdmin.institute', [
            'users' => $users,
            'institute' => $institute,
            'instituteCount' => $instituteCount,
            'activeInstituteCount' => $activeInstituteCount,
            'inactiveInstituteCount' => $inactiveInstituteCount,
            'types' => $types,
            'employees' => $employees // This now contains only the relevant fields
        ]);
    }

    public function ViewOneInstitute($id)
    {
        $institute = Institute::find($id);
        return view('superAdmin.editInstitute', ['institute' => $institute]);
    }

    public function instituteUpdate(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);
        // validation rules
        $rules = [
            'institute_contact_num' => 'required|string|max:10',
            'email' => 'required|string|email|max:255',
            'institute_address' => 'required|string|max:255',
            'institute_name' => 'required|string|max:255',
        ];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $institute->institute_name = $request->input('institute_name');
        $institute->institute_address = $request->input('institute_address');
        $institute->institute_contact_num = $request->input('institute_contact_num');
        $institute->email = $request->input('email');
        $institute->update();

        return redirect()->back()->with('success', 'institute Update successfully.');
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

<?php

namespace App\Http\Controllers;

use App\Mail\userWellcomeMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $user_id = Auth::id();
            $instituteList = DB::table('institutes')
                                ->orderBy('created_at', 'DESC')
                                ->get();
            $messages =Message::with('user')
                                ->where('user_id', $user_id)
                                ->orderBy('created_at', 'DESC')
                                ->get();
            return view('user.userDashboard', compact('instituteList', 'messages', 'user_id'));
        } else {
            // Redirect to the login page or show an error
            return redirect()->route('login');
        }
    }

    //Showing user's send previous messages page.
    public function previousMessages()
    {
        $user_id = Auth::id();
        $instituteList = DB::table('institutes')
                                ->orderBy('created_at', 'DESC')
                                ->get();
        $messages =Message::with('user')
                                ->where('user_id', $user_id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);

        return view('user.previousMessages', compact('messages', 'instituteList'));
    }

    //show selected user data
    public function oneUserDetailsForAdministrator($id){
        $user =User::find($id);
        return view('administrator.userEdit', compact('user'));
    }

    //show selected user data
    public function oneUserDetailsForSuperAdmin($id){
        $userInstituteId = DB::table('users')
                    ->where('id', $id)
                    ->value('institute_id');

        $instituteID = DB::table('institutes')
                    ->where('id', $userInstituteId)->first();


        $adminDetails = DB::table('users')
                    ->where('institute_id', $userInstituteId)
                    ->where('user_type', 'administrator')
                    ->get();

        $userDetails = DB::table('users')
                    ->where('institute_id', $userInstituteId)
                    ->where('user_type', 'user')
                    ->get();

        $user =User::find($id);
        return view('superAdmin.editUser', compact('user', 'adminDetails', 'userDetails'));
    }

     //user update Function for administrator
     public function UsersUpdate(Request $request , $uid){
        $user = User::findOrFail($uid);

        $rules = [
            'user_type' => 'required|string|in:administrator,user,super admin',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'user_contact_num' => 'required|string|max:12',
        ];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->user_type = $request->input('user_type');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->status = $request->input('status');
        $user->user_contact_num = $request->input('user_contact_num');
        $user->update();

        // Redirect with a success message
        return redirect()->back()->with('success', 'User Update successfully!');
    }

    // for User Registration
    public function RegisterUsers(Request $request){
        $rules = [
            'institute_id' => 'required|exists:institutes,id',
            'password' => 'required|string|min:8|max:32|confirmed',
            'user_contact_num' => 'required|string|max:12',
            'email' => 'required|string|email|max:255|unique:users,email',
            'user_type' => 'required|string|in:administrator,user',
            'name' => 'required|string|max:255',
        ];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $newUser = new User;
        $newUser->institute_id = $request->input('institute_id');
        $newUser->user_type = $request->input('user_type');
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
            $RegisterAdminName=Auth::user()->name;
            $RegisterUserType=Auth::user()->user_type;
            $RegisterAadminEmail=Auth::user()->email;
            $RegisterAdminContactNumber=Auth::user()->user_contact_num;
        } else {
            return redirect()->route('login');
        }

        Mail::to($newUser->email)->send(new userWellcomeMessage($newUser->user_type, $newUser->name, $newUser->email, $newUser->user_contact_num, $plainPassword,
                $RegisterAdminName, $RegisterUserType, $RegisterAadminEmail, $RegisterAdminContactNumber));

        // Redirect with a success message
        return redirect()->back()->with('success', 'User Registration successfully!');
    }

    // [User ] for logout
    public function userLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function deleteUser($id){
        $user =User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function deleteUserForAdmin($id){
        $user =User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

}

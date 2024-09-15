<?php

namespace App\Http\Controllers;

use App\Mail\mail_for_problem;
use App\Models\Institute;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    public function index(){
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

            //get message table details
            $NumMessages = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->count();

            $NumPendingMsg = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->where('request', 'pending')
                            ->count();
            $NumAcceptMsg = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->where('request', 'accept')
                            ->count();
            $NumRejectMsg = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->where('request', 'reject')
                            ->count();

            // message status count
            $NumSolvedMsg = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->where('status', 'solved')
                            ->count();
            $NumNotSolvedMsg = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->where('status', 'not resolved')
                            ->where('request', 'accept')
                            ->count();
            $NumProcessing = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->where('status', 'Processing')
                            ->count();
            $NumViewed = DB::table('messages')
                            ->where('institute_id', $instituteId)
                            ->where('status', 'Viewed')
                            ->count();

            $superAdminDetails = DB::table('users')
                    ->where('user_type', 'super admin')
                    ->get();

            return view('administrator.administratorDashbord',

            ['institute' => $institute, 'userName' => $userName, 'NumAdministrators' => $NumAdministrators,
            'NumUsers' => $NumUsers, 'NumActiveUsers' => $NumActiveUsers, 'NumInactiveUsers' => $NumInactiveUsers,
            'NumActiveAdministrators' => $NumActiveAdministrators, 'NumInactiveAdministrators' => $NumInactiveAdministrators,
            'NumMessages' => $NumMessages, 'NumPendingMsg' => $NumPendingMsg, 'NumAcceptMsg' => $NumAcceptMsg, 'NumRejectMsg' => $NumRejectMsg,
            'NumSolvedMsg' => $NumSolvedMsg, 'NumNotSolvedMsg' => $NumNotSolvedMsg, 'superAdminDetails'=> $superAdminDetails, 'NumProcessing'=>$NumProcessing, 'NumViewed'=>$NumViewed]);

    }

    public function messages(){
        if (Auth::check()) {
            $userInstituteId = Auth::user()->institute_id;
            $messages = DB::table('messages')
                    ->where('institute_id', $userInstituteId)
                    ->orderBy('created_at', 'DESC')
                    ->get();

            return view('administrator.message', ['messages' => $messages ]);
        } else {
            // Redirect to the login page or show an error
            return redirect()->route('login');
        }
    }

    public function showOneMessage($mid){
        if (Auth::check()) {
            $userid = Auth::id();
            $oneMessage = DB::table('messages')
                    ->where('id', $mid)
                    ->first();
            $messagesTableDataUser =Message::with('user')
                    ->where('id', $mid)
                    ->first();

            return view('administrator.messageOne', compact('oneMessage','messagesTableDataUser'));
        } else {
            // Redirect to the login page or show an error
            return redirect()->route('login');
        }
    }

    public function ConformMessage(Request $request, $mid){
        $message=Message::findOrFail($mid);
        $message->request = $request->input('request');
        $message->update();

        //get message data from message table
        $subject = $message->subject;
        $messageDetails = $message->message;

        if (Auth::check()) {
            //get authenticate user details
            $userInstituteId=Auth::user()->institute_id;
            $administratorName=Auth::user()->name;
            $administratorEmail=Auth::user()->email;
            $administratorContactNumber=Auth::user()->user_contact_num;
        } else {
            return redirect()->route('login');
        }

        //get institute details
        $instituteDetails=DB::table('institutes')
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
        $instituteName=$instituteDetails->institute_name;
        $instituteAddress=$instituteDetails->institute_address;
        $instituteContactNumber=$instituteDetails->institute_contact_num;

        //get Super Admin Email Adress
        $superAdminEmail=DB::table('users')
                        ->where('user_type', 'super admin')
                        ->pluck('email')
                        ->toArray();
      
        Mail::to($superAdminEmail)->send(new mail_for_problem
        ($subject, $messageDetails, $administratorName, $administratorEmail, $administratorContactNumber, $instituteName, $instituteAddress, $instituteContactNumber));

        return redirect()->back()->with('success', 'User message send to the Nanosoft Solutions (Pvt)Ltd');
    }

    public function RejectMessage(Request $request, $mid){
        $message=Message::findOrFail($mid);
        $message->request = $request->input('request');
        $message->update();

        return redirect()->back()->with('success', 'User message rejected');
    }

    public function SaveMessageAdminisrator(Request $request){
        //define validation rules
        $rules = [
            'subject'=> 'Required|String|max:255',
            'message'=> 'Required|String',
            'img_1'=> 'nullable|image|max:4096',
            'img_2'=> 'nullable|image|max:4096',
            'img_3'=> 'nullable|image|max:4096',
            'img_4'=> 'nullable|image|max:4096',
            'img_5'=> 'nullable|image|max:4096',
        ];

        //check rules
        $validator = Validator::make($request->all(),$rules);

        //if rules fails
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the authenticated user ID
        $userId = Auth::id();

        $NewMessage = new Message;
        $NewMessage->user_id = $userId;
        $NewMessage->institute_id = $request->input('institute_id');
        $NewMessage->subject = $request->input('subject');
        $NewMessage->request = $request->input('request');
        $NewMessage->message = $request->input('message');

        // Handle the image file uploads
        $imageFields = ['img_1', 'img_2', 'img_3', 'img_4', 'img_5'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $imageName = uniqid() .'_'. $field.'.'.$request->$field->extension();
                $request->$field->move(public_path('images/MessageWithProblem'), $imageName);
                $NewMessage->$field = $imageName;
            }
        }

        // Save the message to the database
        $NewMessage->save();

        //get athenticate user data to send the email
        if (Auth::check()) {
            //get authenticate user details
            $userInstituteId=Auth::user()->institute_id;
            $administratorName=Auth::user()->name;
            $administratorEmail=Auth::user()->email;
            $administratorContactNumber=Auth::user()->user_contact_num;
        } else {
            return redirect()->route('login');
        }

        //get institute details
        $instituteDetails=DB::table('institutes')
                    ->where('id', $userInstituteId)
                    ->first();
        //get institute name, Address from institute table
        $instituteName=$instituteDetails->institute_name;
        $instituteAddress=$instituteDetails->institute_address;
        $instituteContactNumber=$instituteDetails->institute_contact_num;

        //get Super Admin Email Adress
        $superAdminEmail=DB::table('users')
                        ->where('user_type', 'super admin')
                        ->pluck('email')
                        ->toArray();

        //get email data for send email
        $subject = $NewMessage->subject;
        $messageDetails = $NewMessage->message;

        Mail::to($superAdminEmail)->send(new mail_for_problem($subject, $messageDetails, $administratorName, $administratorEmail, $administratorContactNumber, $instituteName, $instituteAddress, $instituteContactNumber));

        return redirect()->route('administrator.messages')->with('success','Message Send to the Nanosoft Solutions Comapany');
    }

    public function users(){
        if (Auth::check()) {
            $userInstituteId = Auth::user()->institute_id;
            //this $institute variable used for user registration model, for get institute list
            $institute = DB::table('institutes')
                    ->where('id', $userInstituteId)
                    ->get();
            $users = DB::table('users')
                    ->get();

            return view('administrator.users', ['institute' => $institute, 'users'=> $users ]);
        } else {
            // Redirect to the login page or show an error
            return redirect()->route('login');
        }
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

<?php

namespace App\Http\Controllers;

use App\Mail\news_send;
use App\Models\NewsEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewsEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function newsSend(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'announcement' => 'required|string',
    ]);

    

    // Get the authenticated user name and email (super admin details)
    // $superAdminName = Auth::user()->name;
    // $superAdminEmail = Auth::user()->email;

    $announcement = $request->input('announcement');

    // Determine recipients based on checkboxes
    $subscribedUsers = $request->input('allSubscribedUsers');
    $companyEmployees = $request->input('allCompanyEmployees');

    if (!empty($subscribedUsers) && !empty($companyEmployees)) {
        // Get company employees emails as an array
        $company_employees_email = DB::table('users')
            ->where('user_type', 'company employee')
            ->pluck('email')
            ->toArray();

        // Get subscribed users emails as an array
        $subscribe_users_email = DB::table('news_emails')
            ->pluck('email')
            ->toArray();

        // Combine both arrays of emails
        $allEmails = array_merge($company_employees_email, $subscribe_users_email);

        // Send the email to all recipients
        Mail::to($allEmails)->send(new news_send($announcement, Auth::user()->name, Auth::user()->email));

    } elseif (!empty($subscribedUsers)) {
        // Get subscribed users emails as an array
        $subscribe_users_email = DB::table('news_emails')
            ->pluck('email')
            ->toArray();

        // Send the email to subscribed users
        Mail::to($subscribe_users_email)->send(new news_send($announcement, Auth::user()->name, Auth::user()->email));

    } elseif (!empty($companyEmployees)) {
        // Get company employees emails as an array
        $company_employees_email = DB::table('users')
            ->where('user_type', 'company employee')
            ->pluck('email')
            ->toArray();

        // Send the email to company employees
        Mail::to($company_employees_email)->send(new news_send($announcement, Auth::user()->name, Auth::user()->email));
    } else {
        return redirect()->back()->with('error', 'No recipients selected.');
    }

    return redirect()->back()->with('success', 'Announcements sent to selected users');
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email|unique:news_emails,email',
        ]);

        // Store the email in the database
        NewsEmail::create([
            'email' => $request->input('email'),
        ]);

        // Redirect back or to a success page with a message
        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }


    /**
     * Display the specified resource.
     */
    public function show(NewsEmail $newsEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsEmail $newsEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NewsEmail $newsEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NewsEmail $newsEmail)
    {
        //
    }
}

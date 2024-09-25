<?php

namespace App\Http\Controllers;

use App\Models\NewsEmail;
use Illuminate\Http\Request;

class NewsEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

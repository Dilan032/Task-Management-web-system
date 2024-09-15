<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InstituteController extends Controller
{
    // [super admin] for Institute Registration
    public function RegisterInstitute(Request $request)
    {

        // validation rules
        $rules = [
            'institute_contact_num' => 'required|string|max:10',
            'email' => 'required|string|email|max:255',
            'institute_address' => 'required|string|max:255',
            'institute_name' => 'required|string|max:255',
            'institute_type' => 'required|string|max:255',
            'assigned_employee' => 'required|string|max:255',
        ];

        // Create validator instance and validate
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $institute = new Institute;
        $institute->institute_name = $request->input('institute_name');
        $institute->institute_type = $request->input('institute_type');
        $institute->institute_address = $request->input('institute_address');
        $institute->institute_contact_num = $request->input('institute_contact_num');
        $institute->email = $request->input('email');
        $institute->assigned_employee = $request->input('assigned_employee');
        $institute->save();

        // Redirect with a success message
        return redirect()->route('superAdmin.institute.view')->with('success', 'Institute Registration successful!');
    }

}


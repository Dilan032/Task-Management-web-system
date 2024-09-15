<?php

namespace App\Http\Controllers;

use App\Models\InstituteTypes;
use Illuminate\Http\Request;

class InstituteTypesController extends Controller
{
    /**
     * Add a new institute type.
     */
    public function AddInstituteType(Request $request)
    {
        // Validate the request input
        $request->validate([
            'institute_type' => 'required|string|max:255|unique:institute_types,institute_type',
        ]);

        // Create a new institute type
        InstituteTypes::create([
            'institute_type' => $request->input('institute_type'),
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Institute type added successfully.');
    }

    /**
     * Update an existing institute type.
     */
    public function UpdateInstituteType(Request $request)
    {
        // Validate the request input
        $request->validate([
            'institute_type' => 'required|string|max:255|unique:institute_types,institute_type,' . $request->input('institute_type_id'),
        ]);

        // Find the existing institute type and update it
        $instituteType = InstituteTypes::find($request->input('institute_type_id'));

        if ($instituteType) {
            $instituteType->update([
                'institute_type' => $request->input('institute_type'),
            ]);

            return redirect()->back()->with('success', 'Institute type updated successfully.');
        }

        return redirect()->back()->withErrors('Error: Institute type not found.');
    }
}

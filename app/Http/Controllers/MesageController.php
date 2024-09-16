<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MesageController extends Controller
{
    public function SaveMessage(Request $request){
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

        return redirect()->route('message.save')->with('success','Message Send to the institute Administrator');
    }

    public function showOneMessage($mid){
        $userid = Auth::id();
        $oneMessage = DB::table('messages')
                ->where('id', $mid)
                ->orderBy('created_at', 'DESC')
                ->first();
        $messagesTableDataUser =Message::with('user')
                ->where('id', $mid)
                ->first();

        return view('user.oneMessage', compact('oneMessage','messagesTableDataUser'));
    }




}

<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyEmployeeController extends Controller
{
    //company Employee Dashbord
    public function index(){

        $loginUserId = Auth::user()->id;
        $employee = DB::table('users')
                ->where('id', $loginUserId)
                ->select('name')
                ->first();

        $employeeName = $employee->name;

        $messages =Message::with('institute')
                ->where('assigned_employee',$employeeName)
                ->where('sp_request', 'Accepted')
                ->get();
        return view('companyEmployee/dashbord',['messages'=>$messages]);
    }

    //view institute user message and store current time
    public function messageView($id){
        $messages = Message::findorFail($id);

        $messages->viewed_at = now();
        $messages->save();

        return view('companyEmployee/message',['messages'=>$messages]);
    }

    //change company employee password
    public function changePassword(){
        return view('companyEmployee.changePassword');
    }
}

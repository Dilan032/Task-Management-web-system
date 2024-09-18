<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyEmployeeController extends Controller
{
    public function index(){
        $messages =Message::with('institute')->get();
        return view('companyEmployee/dashbord',['messages'=>$messages]);
    }

    public function messageView($id){
        $messages = Message::findorFail($id);

        $messages->viewed_at = now();
        $messages->save();

        return view('companyEmployee/message',['messages'=>$messages]);
    }
}

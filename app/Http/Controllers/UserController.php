<?php

namespace App\Http\Controllers;

use App\Jobs\PasswordUpdateJob;
use App\Models\Employees;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function PasswordUpdateView()
    {
        return view('web.auth.password');
    }

    public function PasswordUpdate(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|confirmed'
        ]);

        if(Session::get('role') == 2){
           $User =  Employees::where('email',Session::get('email'))->where('is_delete','0');
        }else{
           $User = User::where('email',Session::get('email'));
        }
        $User->update(['password' => Hash::make($request->password)]);

        PasswordUpdateJob::dispatch(Session::get('email'),['name' => $User->first()->name]);

        return redirect()->back()->withSuccess('Password Updated Successfully');
    }

}

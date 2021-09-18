<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Jobs\SendResetlinkJob;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
// use Illuminate\Contracts\Session\Session;
use Session;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class ResetPasswordEmp extends Controller
{
    public function view()
    {
        return view('web.auth.reset.forgot');
    }

    public function MailCheck(Request $request)
    {
       $User = Employees::where('email',$request->email);

       Session::put('its_employee','true');

        if($User->exists()){
            $User = $User->first();
            $CryptID = Crypt::encrypt($User->id,);
            SendResetlinkJob::dispatch($User->email,['name' => $User->name , 'id' => $CryptID ]);
            return redirect()->route('emp.login.view')->withsuccess('Please Check your mail | Reset link mailed you');

        }
        return back()->withErrors('User not found');
    }




    public function Store(Request $request)
    {
        $this->validate($request,['password'=> 'required|confirmed']);

        Session::forget('token');
        // $request->session()->forget('key');
        $User = User::find($request->user_token);
        $User->update(['password' => Hash::make($request->password)]);



            return redirect()->route('login.view')->withsuccess('Great, Your password has been changed ');


    }
}

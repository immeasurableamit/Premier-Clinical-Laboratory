<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Jobs\SendResetlinkJob;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
// use Illuminate\Contracts\Session\Session;
use Session;
use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Session\Session as SessionSession;
use App\Models\Employees;
use App\Jobs\PasswordUpdateJob;

class ResetPassword extends Controller
{
    private $RedirectRoute = 'login.view';



    public function view()
    {
        $TypeRoute = 'check.mail';
        return view('web.auth.reset.forgot',compact('TypeRoute'));
    }
    public function viewemp()
    {
        $TypeRoute = 'check.mail.emp';
        return view('web.auth.reset.forgot',compact('TypeRoute'));
    }

    public function MailCheck(Request $request)
    {
        $User = User::where('email', $request->email);
        if ($User->exists()) {
            $User = $User->first();
            $CryptID = Crypt::encrypt($User->id,true);
            SendResetlinkJob::dispatch($User->email, ['name' => $User->name, 'id' => $CryptID,'type'=> '1']);
            return redirect()->route('login.view')->withsuccess('Please Check your mail | Reset link mailed you');
        }
        return back()->withErrors('User not found');
    }


    public function VerifyToken(Request $request, $token,$type)
    {
        try {
            $decrypted = Crypt::decrypt($token);
        } catch (DecryptException $e) {
            return redirect()->route('login.view')->withErrors('Something went wrong');
        }
        $id = $decrypted;
        Session::put(['token' => $token]);
        Session::put(['type' => $type]);
        return view('web.auth.reset.set-new', compact('id'));
    }

    public function Store(Request $request)
    {
        $this->validate($request, ['password' => 'required|confirmed']);

        switch (Session::get('type')) {
            case '1':
                $User = User::find($request->user_token);
                $this->RedirectRoute = 'login.view';
            break;
            case '2':
                $User = Employees::find($request->user_token);
                $this->RedirectRoute = 'emp.login.view';
            break;
            default:
                    return redirect()->route($this->RedirectRoute)->withErrors('Something went wrong');
            break;
        }
        Session::forget(['type','token']);

        $User->update(['password' => Hash::make($request->password)]);
            PasswordUpdateJob::dispatch($User->email,['name' => $User->name]);

        return redirect()->route($this->RedirectRoute)->withsuccess('Great, Your password has been changed ');
    }



    public function MailCheckEmp(Request $request)
    {

        $User = Employees::where('email', $request->email)->where('is_delete','0');
        Session::put('its_employee', 'true');
        if ($User->exists()) {
            $User = $User->first();
            $CryptID = Crypt::encrypt($User->id,);
            SendResetlinkJob::dispatch($User->email, ['name' => $User->name, 'id' => $CryptID,'type'=> '2']);
            return redirect()->route('emp.login.view')->withsuccess('Please Check your mail | Reset link mailed you');
        }
        return back()->withErrors('User not found');
    }
}

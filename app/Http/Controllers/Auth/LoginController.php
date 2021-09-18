<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SMSController;
use App\Jobs\SendResetlinkJob;
use App\Mail\SendResetlink;
use App\Models\Employees;
use App\Models\Customers;
use App\Models\SiteAdmin;
use App\Models\SuperAdmin;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;


class LoginController extends Controller
{
    public function LoginView()
    {
        return view('web.auth.login');
    }

    public function CustomerLoginView()
    {

        return view('web.auth.customerlogin');
    }

    public function LandingPage()
    {

        return view('web.home');
    }

    public function Login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);


        $User = User::with('SiteAdmin')->where(['email' => $request->email])->first();
        if (Hash::check($request->password, $User->password)) {

            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ]);

            switch ($User->role) {
                case User::ADMIN:
                    Session::put(['user_id' => $User->id, 'email' => $User->email, 'role' => $User->role]);
                    return redirect()->route('admin.dash')->withSuccess('Login Successfully');
                    break;
                case User::SITEOWNER:

                    if ($User->SiteAdmin->is_delete == '1') {
                        return redirect()->route('login.view')->withErrors('User not found');
                    }
                    Session::put([
                        'user_id' => $User->id,
                        'email' => $User->email,
                        'name' => $User->name,
                        'role' => $User->role,
                        'site_id' => $User->SiteAdmin->site_id,
                        'site_name' => $User->SiteAdmin->Sitename()
                    ]);

                    return redirect()->route('admin.site.dash')->withSuccess('Login Successfully');
                    break;
                case User::Employes:
                    $Employee = Employees::where('user_id', $User->id)->first();
                    Session::put([
                        'user_id' => $User->id,
                        'email' => $User->email,
                        'name' => $User->name,
                        'role' => $User->role,
                    ]);
                default:
                    return redirect()->route('login.view')->withInputs()->withErrors('Invalid Request');
                    break;
            }
        } else {
            return redirect()->back()->withErrors('Invalid Request');
        }
    }

    public function Logout()
    {
        Session::flush();
        return redirect()->route('landing.view')->withSuccess('Logout Successfully');
    }


    public function EmployeeView(Request $request)
    {
        return view('web.auth.emp-login');
    }


    public function CustomerLogin(Request $request)
    {

        $this->validate($request, ['email' => 'email|required', 'password' => 'required']);
        $User = Customers::where(['email' => $request->email])->first();

        if (!$User) {
            return redirect()->back()->withErrors('Your email not matched with our records');
        }

        if ($User->email_verify_status == 0) {
            $emailotp = random_int(100000, 999999);
            Customers::find($User->id)->update([
                'email_otp' => $emailotp
            ]);
            Session::put(['email' => $User->email]);

            $message =  "OTP for covis app is " . $emailotp;
            SMSController::Send($User->phone, $message);

            SendResetlinkJob::dispatch($User->email, ['otp' => $emailotp]);
            return redirect()->route('verify.email.view')->withSuccess('Please Verify Your email | OTP sent your mail');
        }


        if (Hash::check($request->password, $User->password)) {
            Session::put([
                'user_id' => $User->id,
                'email' => $User->email,
                'name' => $User->first_name . ' ' . $User->last_name,
                'phone' => $User->phone,
                'role' => User::Customer,

            ]);
            return redirect()->route('customer.dash')->withSuccess('Login Successfully');
        } else {
            return redirect()->back()->withErrors('Your password not matched with our records');
        }
    }

    public function EmployeeLogin(Request $request)
    {
        // return $response->json();
        $this->validate($request, ['email' => 'email|required', 'password' => 'required']);
        $User = Employees::where(['email' => $request->email, 'is_delete' => '0'])->latest()->first();
        if (!$User) {
            return redirect()->back()->withErrors('Your email not matched with our records');
        }

        if (Hash::check($request->password, $User->password)) {
            //$DeviceId = Uuid::uuid();
            //$DeviceToken = Uuid::uuid();
            Session::put([
                'user_id' => $User->id,
                'email' => $User->email,
                'name' => $User->name,
                'role' => User::Employes,

            ]);
            //$User->update(['device_id' => $DeviceId,'device_token' => $DeviceToken,]);
            // Employee Has any site assined
            return redirect()->route('employee.dash')->withSuccess('Login Successfully');
        } else {
            return redirect()->back()->withErrors('Your password not matched with our records');
        }
    }
}

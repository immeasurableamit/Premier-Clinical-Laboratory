<?php

namespace App\Http\Controllers\Auth;

use Session;
use Twilio\Rest\Client;
use Faker\Provider\Uuid;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Jobs\Passwordsendjob;
use App\Jobs\SendResetlinkJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\SMSController;
use App\Jobs\CustomerOtpJob;
use App\Jobs\EmployeeLoginJob;

class SignupController extends Controller
{
    public function CustomerSignupView()
    {
        return view('web.auth.signup');
    }

    // customer registration function
    public function signup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'lastname' => 'required|alpha',
            'firstname' => 'required|alpha',
            'gender' => 'required',
            'dob' => 'required|nullable|date_format:Y-m-d|before:today',
            'email' => 'required',
            'phone' => 'required|numeric|min:13',
        ]);


        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $dob = $request->dob;
        $gender = $request->gender;
        $email = $request->email;
        $phone = $request->phone;
        $emailotp = random_int(100000, 999999);
        $mobileotp = random_int(100000, 999999);
        // $password = $hashed_random_password = Hash::make(str_random(8));
        $password =  str_random(8);

        $customer = Customers::where(['email' => $email, 'email_verify_status' => 1])->first();

        if ($customer) {
            return redirect()->route('cust.signup.view')->withErrors('User Already Exists');
        } else {

            $receiverNumber = $phone;
            $message = "OTP for covis app is " . $emailotp;

            $data = [
                'email' => $request->email,
                'emailotp' => $emailotp,
            ];

            dispatch(new CustomerOtpJob($data))->delay(now()->addSeconds(5));

            SMSController::Send($receiverNumber, $message);

            Customers::create([
                'uuid' => Uuid::uuid(),
                'first_name' => $firstname,
                'last_name' => $lastname,
                'dob' => $dob,
                'gender' => $gender,
                'email' => $email,
                'password' => Hash::make($password),
                'phone' => $phone,
                'email_otp' => $emailotp,
                'mobile_otp' => $mobileotp,
                'image' => 'notfound.png',
                'mobile_verify_status' => 0,
                'email_verify_status' => 0,
            ]);


            Session::put([
                'email' => $email, 'mobile' => $phone,
            ]);
            return redirect()->route('verify.email.view')->withSuccess('Please Verify Your email | OTP sent your email');
        }
    }


    public function VerifyView()
    {

        return view('web.auth.emailverification');
    }


    public function verifymethod(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'emailotp' => 'required|min:6|max:6',

        ]);

        $customer = Customers::where(['email' => $request->email])->latest()->first();

        if ($customer->email_otp == $request->emailotp || $customer->mobile_otp == $request->emailotp) {
            $random_password = str_random(8);

            Customers::find($customer->id)->update([
                'password' => Hash::make($random_password),
                'email_verify_status' => 1,
            ]);

            $data = [
                'random_password' => $random_password,
                'email' => $customer->email,
            ];

            dispatch(new EmployeeLoginJob($data))->delay(now()->addSeconds(5));

            return redirect()->route('cust.login.view')->withSuccess('Email verified Successfully, Login Details are sent to your email');
        } else {

            return redirect()->back()->withErrors('OTP verification failed. Please try again');
        }
    }


    public function Forgot()
    {
        return view('web.auth.reset.user-forgot');
    }

    public function Checkmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|exists:customers,email']);

        $User = Customers::where('email', $request->email)->first();
        $emailotp = random_int(100000, 999999);
        Customers::find($User->id)->update([
            'email_otp' => $emailotp
        ]);
        Session::put(['email' => $User->email]);

        SendResetlinkJob::dispatch($User->email, ['otp' => $emailotp]);
        return redirect()->route('verify.email.view')->withSuccess('Please Verify Your email | OTP sent your email');
    }
}

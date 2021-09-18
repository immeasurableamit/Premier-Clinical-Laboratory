<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\Customers;
use App\Models\Question;
use Illuminate\Http\Request;
use Faker\Provider\Uuid;
use App\Models\Package;
use App\Jobs\Passwordsendjob;
use App\Jobs\CustomEmailJob;
use Illuminate\Support\Facades\Hash;
use App\Models\Site;
use Session;
use App\Models\EmployeeQuestion;
use App\Models\Temperature;
class EmployeeController extends Controller
{


    public function addcustomer(){

        $Sites = Site::where('is_delete','0')->get();
        return view('web.employee.addcustomer', compact('Sites'));
    }


    public function customeraddlogic(Request $request){

        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'lastname' => 'required|alpha',
            'firstname'=>'required|alpha',
            'gender'=>'required',
            'dob'=>'required|nullable|date_format:Y-m-d|before:today',
            'email'=>'required',
            'package_type'=>'required',
            'phone'=>'required|numeric|min:10',
        ]);


        $emp = Employees::find(Session::get('user_id'));


        $firstname = $request->firstname;
        $lastname= $request->lastname;
        $dob = $request->dob;
        $gender = $request->gender;
        $email= $request->email;
        $phone=$request->phone;
        $emailotp=random_int(100000, 999999);
        $mobileotp=random_int(100000, 999999);
        //$password = $hashed_random_password = Hash::make(str_random(8));
        $password =  str_random(8);


        $customer = Customers::where(['email' => $email])->first();

        $dateFormate = date('m/d/y',strtotime($request->date));
        if($customer){


            // $package_number = $customer->first_name[0].$customer->last_name[0]."-".$dateFormate."-".$customer->id;

            Package::create([
                'customer_id' => $customer->id,
                'employee_id' => Session::get('user_id'),
                'book_date' => now(),
                'site_id' => $emp->AssigneSite()->site_id,
                'package_type' => $request->package_type,
            ]);

            // CustomEmailJob::dispatch($email, [
            //     'subject'=> 'Covid Test location',
            //     'message' => 'Please visit at '.$emp->AssigneSite()->site->address.' to give your sample for covid test. Thankyou.',
            //     'email' => $email]);
            return redirect()->route('employee.customeradd')->withSuccess('User Already Exists, test created successfully');

        }else{


            $customer = Customers::create([
                'uuid'=> Uuid::uuid(),
                'first_name'=>$firstname,
                'last_name'=>$lastname,
                'dob'=>$dob,
                'gender'=>$gender,
                'email'=>$email,
                'password'=>Hash::make($password),
                'phone'=>$phone,
                'email_otp'=>$emailotp,
                'mobile_otp'=>$mobileotp,
            ]);
            Passwordsendjob::dispatch($email, ['password' => $password, 'email' => $email]);



            Package::create([
                'employee_id' => Session::get('user_id'),
                'customer_id' => $customer->id,
                'book_date' => now(),
                'site_id' =>  $emp->AssigneSite()->site_id,
                'package_type' => $request->package_type,
                // 'package_number' => $package_number
            ]);

            // CustomEmailJob::dispatch($email, [
            //     'subject'=> 'Test location',
            //     'message' => 'Please visit '.$emp->AssigneSite()->site->address.' to give your sample for covid
            //     test. Thankyou.',
            //     'email' => $email]);



            return redirect()->route('employee.dash')->withSuccess('User added successfuly');

        }




    }


    public function signup(Request $request){

        $this->validate($request, [
            'email' => 'required|email|exists:customers,email',
            'lastname' => 'required|alpha',
            'firstname'=>'required|alpha',
            'dob'=>'required|nullable|date_format:Y-m-d|before:today',
            'email'=>'required',
            'phone'=>'required|numeric|min:10',


        ]);


        $firstname = $request->firstname;
        $lastname= $request->lastname;
        $dob = $request->dob;
        $email= $request->email;
        $phone=$request->phone;
        $emailotp=random_int(100000, 999999);
        $mobileotp=random_int(100000, 999999);
        //$password = $hashed_random_password = Hash::make(str_random(8));
        $password =  str_random(8);



       // $customer = Customers::find()->where('email',$email);

        $customer = Customers::where(['email' => $email])->first();

        if($customer){

            return redirect()->route('cust.signup.view')->withErrors('User Already Exists');

        }else{


            $receiverNumber = "+91".$phone;
            $message = "OTP for covis app is ".$password;


            //sms sending code



            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);





            //OTP email sending code

            SendResetlinkJob::dispatch($email,['otp' => $emailotp ]);



            //password send code

            Passwordsendjob::dispatch($email,['password'=>  $password,'email' => $email]);



            Customers::create([
                'first_name'=>$firstname,
                'last_name'=>$lastname,
                'dob'=>$dob,
                'email'=>$email,
                'password'=>Hash::make($password),
                'phone'=>$phone,
                'email_otp'=>$emailotp,
                'mobile_otp'=>$mobileotp,
            ]);


            Session::put([
                'email' => $email,
                'mobile' => $phone,


            ]);

            return redirect()->route('verify.email.view')->withSuccess('Verify Your email');


        }








    }

    public function Screening(Request $request)
    {


         $emp = Employees::find(Session::get('user_id'));

        if($emp->test_expire_date){
             $ExpireDate = date('y-m-d',strtotime($emp->test_expire_date));
             if(date('y-m-d') < $ExpireDate ){

                $Question = Question::all();
                foreach ($Question as  $value) {
                    EmployeeQuestion::create([
                        'question_id' => $value->id,
                        'employee_id' =>  $emp->id ,
                        'answer' => 2
                    ]);
                }

             }
            }


        $Screening = EmployeeQuestion::where('employee_id',Session::get('user_id'))->whereDate('created_at', '=',
        date('Y-m-d'))->exists();

        if($Screening){
            return redirect()->route('employee.dash')->withSuccess('Your screening already submitted    ');
        }
         $items = Question::all();
         $item = Employees::find(Session::get('user_id'));

         return view('web.employee.self.own-screening',compact('items','item'));
    }


    public function ScreeningStore(Request $request)
    {

         $data = [];
         $risk = 'LOW';
         foreach ($request->question as $value) {
             if($request->answer[$value] == 1){
                $risk = 'HIGH';
             }
         array_push($data,['question_id' => $value,'employee_id' => $request->user_id,'answer' =>
         $request->answer[$value],'created_at'=> now(),'updated_at' => now()]);
         }

         Employees::find($request->user_id)->update(['risk_level' => $risk]);
         EmployeeQuestion::insert($data);
        // Temperature::create(['employee_id' => $request->user_id,'temperature' => $request->temperature]);

         return redirect()->route('employee.dash')->withSuccess('Your screening submit successfully');
    }


    public function GetRequestedPackages()
    {
        $emp = Employees::find(Session::get('user_id'));
        $items =   Package::where('package_status',Package::PACKAGE_REQUESTED)->with('Site','Customer');
        // if (Session::has('site_id')) {
            $items->where('site_id', $emp->AssigneSite()->site_id);
        // }
        $items =  $items->get();

        return view('web.employee.packages.requested', compact('items'));
    }


    public function GetPendingPackages()
    {
        $emp = Employees::find(Session::get('user_id'));
        $items =   Package::where('package_status',Package::PACKAGE_PENDING)->with('Site');
        // if (Session::has('site_id')) {
            $items->where('site_id', $emp->AssigneSite()->site_id);
        // }

        $items =  $items->get();

        return view('web.employee.packages.pending', compact('items'));
    }

    public function GetCompletedPackages()
    {
        $emp = Employees::find(Session::get('user_id'));
        $items =   Package::where('package_status',Package::PACKAGE_COMPLETED)->with('Site');
        // if (Session::has('site_id')) {
            $items->where('site_id', $emp->AssigneSite()->site_id);
        // }
        $items =  $items->where('status','0')->get();
        return view('web.employee.packages.completed', compact('items'));
    }


    public function PackageDetails($id)
    {
        $item =   Package::where('id',$id)->with('Site','Customer')->first();
        $title = 'RequestDetails';
        // return $item;
        return view('web.employee.packages.details', compact('title','item'));
    }


    public function PendingPackageDetails($id)
    {
        $item = Package::where('id',$id)->with('Site','Customer')->first();
        Package::where('id',$id)->with('Site','Customer')->update([
            "secondary_barcode" => $item->package_number,
            "package_status" => Package::PACKAGE_COMPLETED,
            "employee_id" => Session::get('user_id')
        ]);
        $title = 'RequestDetails';
        // return $item;
         return redirect()->route('employee.package.completed')->withSuccess('Sample collection successful');
    }


    public function ApprovePackage($id)
    {
        $emp = Employees::find(Session::get('user_id'));
        $title = 'Request Details';

        $item = Package::where('id',$id);
         $customer = Customers::find($item->first()->customer_id);
        $dateFormate = date('m/d/y',strtotime($customer->dob));
        $package_number = $customer->first_name[0].$customer->last_name[0]."-".$dateFormate."-".$item->first()->id;

        $item->update(["package_status"=>Package::PACKAGE_PENDING,"employee_id" => $emp->id,
                        "approved_at" => now(),'package_number' => $package_number]);


        // return $item;
         return redirect()->route('employee.package.requested')->withSuccess('Request Approved successfully');
    }


    public function SetPositive($id)
    {
        $emp = Employees::find(Session::get('user_id'));
        $item =   Package::where('id',$id)->update([
            "status"=>Package::POSITIVE,
        ]);
         return redirect()->route('employee.package.requested')->withSuccess('Test result updated successfully');
    }

    public function SetNegative($id)
    {
        $emp = Employees::find(Session::get('user_id'));
        $item =   Package::where('id',$id)->update([
            "status"=>Package::NEGATIVE,
        ]);
        return redirect()->route('employee.package.requested')->withSuccess('Test result updated successfully');
    }

    public function PrintBarcode($id){

        $Package = Package::find($id);
        $id = $Package->package_number;
        return view('web.employee.packages.printbarcode', compact('id'));
    }


    public function LookUp()
    {
         $emp = Employees::find(Session::get('user_id'));
         $items = Package::with('Customer','Employee','Site')->where('site_id', $emp->AssigneSite()->site_id)->get();
        return view('web.employee.lookup',compact('items'));
    }


      public function DownloadResult($id)
      {
      $item = Package::with('Customer','Employee','Site')->where('id',$id)->first();
      return view('web.customer.report',compact('item'));
      }


}

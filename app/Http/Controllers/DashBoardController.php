<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Site;
use App\Models\SiteAdmin;
use App\Models\Employees;
use App\Models\Customers;
use App\Models\Package;
use App\Models\SiteEmployees;
use Session;
use App\Models\EmployeeQuestion;

class DashBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Data['Site'] = Site::where('is_delete', '0')->get();
        $Data['Employees'] = Employees::where('is_delete', '0')->count();

        $Data['Positive'] = Package::where('status', Package::POSITIVE)->count();
        $Data['Negative'] = Package::where('status', Package::NEGATIVE)->count();
        $Data['Pending'] = Package::where('status', Package::PENDING)->count();
        $Data['NotPending'] = Package::where('status', '!=', Package::PENDING)->count();
        $Data['alerts'] = Employees::where('risk_level', 'high')->count();


        $Tests = Package::with('Employee', 'Site')->latest()->limit(10)->get();
        return view('web.dashboard.index', compact('Data', 'Tests'));
    }

    public function SiteDash()
    {
        $Data['Employees'] = SiteEmployees::where('is_delete', '0')->where('site_id', Session::get('site_id'))->count();
        $Data['Positive'] = Package::where('site_id', Session::get('site_id'))->where('status', Package::POSITIVE)->count();
        $Data['Negative'] = Package::where('site_id', Session::get('site_id'))->where('status', Package::NEGATIVE)->count();
        $Data['Pending'] = Package::where('site_id', Session::get('site_id'))->where('status', Package::PENDING)->count();
        $Data['NotPending'] = Package::where('site_id', Session::get('site_id'))->where('status', '!=', Package::PENDING)->count();
        $Tests = Package::with('Employee', 'Site')->where('site_id', Session::get('site_id'))->latest()->limit(10)->get();


        $Data['alerts'] = SiteEmployees::with('Employee')->join('employees', 'employees.id',
        '=','site_employees.employee_id')
        ->where('site_employees.end_date','>=' ,date('Y-m-d'))
        ->where('employees.risk_level','high')->count();

        return view('web.dashboard.site-dash', compact('Data', 'Tests'));
    }



    public function Employee(Request $request)
    {
        // Check Screeing Complated For today
        /*
        $Screening = EmployeeQuestion::where('employee_id', Session::get('user_id'))->whereDate(
            'created_at',
            '=',
            date('Y-m-d')
        )->exists();
        if (!$Screening) {
            return redirect()->route('employee.screening')->withSuccess('Please submit you screening');
        }
        */
        $items = Employees::find(Session::get('user_id'));

        $SiteName = null;
        if(Session::has('site_id')){
            $SiteName = Site::find(Session::get('site_id'))->name;
        }


        return view('web.dashboard.emp-dash',compact('items','SiteName'));

    }


    public function Customer(Request $request){

        $items = Customers::find(Session::get('user_id'));

        if($items){
            return view('web.dashboard.cust-dash',compact('items'));
        }else{

            return redirect()->back()->withErrors('No Such customer find with our records');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function PendingTests()
    {
        $items = Package::where('status',Package::PENDING)->get();
        $title = 'Pending test List';
        return view('web.package.show',compact('items','title'));
    }


    public function PositiveTests()
    {
        $title = 'Positive test List';
        $items = Package::where('status',Package::POSITIVE)->get();
        return view('web.package.show',compact('items','title'));
    }

    public function NegativeTests()
    {
        $title = 'Negative test List';
        $items = Package::where('status',Package::NEGATIVE)->get();
        return view('web.package.show',compact('items','title'));
   }

   public function AlertsEmployes()
   {

        $title = 'High risk Employees';
        $items = Employees::where('risk_level','high')->get();
        if(Session::get('site_id')){
         $items = SiteEmployees::with('Employee')->join('employees', 'employees.id', '=','site_employees.employee_id')
        ->where('site_employees.end_date','>=' ,date('Y-m-d'))
        ->where('employees.risk_level','high')->get();
         return view('web.package.show3',compact('items','title'));

        }

       return view('web.package.show2',compact('items','title'));

   }

   public function DownRisk($id)
   {

       Employees::find($id)->update(['risk_level' => 'LOW']);

       return back()->withsuccess('Employee risk down successfully');
   }
}

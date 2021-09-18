<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\Site;
use Session;

class CustomerController extends Controller
{
    public function RequestAntigen()
    {
        $title = 'Request Antigent Test';
        $labs = Site::all();
        return view('web.customer.antigen',compact('labs','title'));
    }

    public function RequestPCR()
    {
        $title = 'Request PCR Test';
        $labs = Site::all();
        return view('web.customer.pcr',compact('labs','title'));
    }

    public function Result()
    {
        $title = 'Recent Tests';
        $UserId = Session::get('user_id');
        $items = Package::where('customer_id',$UserId)->get();
        return view('web.customer.results',compact('items','title'));
    }



    public function AntigenStore(Request $request)
    {
        $this->validate($request,[
            // 'date' => 'required|date'
        ]);

        $UserId = Session::get('user_id');

        $package_details = Package::create([
            'customer_id' => $UserId,
            'book_date' => now(),
            'site_id' => $request->lab_id,
            'package_type' => Package::ANTIGEN,
        ]);

        $site_details = Site::where('id',$request->lab_id)->first();
        if($site_details){
            return view('web.customer.confirmation',compact('site_details','package_details'));
        }else{
            return back()->withsuccess('Your request is sent successfully');
        }
        
    }


    public function PCRStore(Request $request)
    {
        $this->validate($request,[
            // 'date' => 'required|date'
        ]);

        $UserId = Session::get('user_id');

        $package_details = Package::create([
            'customer_id' => $UserId,
            'book_date' => now(),
            'site_id' => $request->lab_id,
            'package_type' => Package::PCR,
        ]);

        $site_details = Site::where('id',$request->lab_id)->first();
        if($site_details){
            return view('web.customer.confirmation',compact('site_details','package_details'));
        }else{
            return back()->withsuccess('Your request is sent successfully');
        }
    }

    public function DownloadResult($id)
    {
        $item = Package::with('Customer','Employee','Site')->where('id',$id)->first();
        return view('web.customer.report',compact('item'));
    }
}

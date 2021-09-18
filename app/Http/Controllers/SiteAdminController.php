<?php

namespace App\Http\Controllers;

use App\Models\SiteAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Package;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendEmailJob;
use Session;

class SiteAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = SiteAdmin::with(['User', 'Site'])->where('is_delete', '0')->get();
        return view('web.site-admin.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Sites = Site::where('is_delete', '0')->get();
        return view('web.site-admin.create', compact('Sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'unique:users,email',
            'password'  => 'required|confirmed'
        ]);

        $User = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => User::SITEOWNER
            ]
        );

        SendEmailJob::dispatch(
            $request->email,
            [
                'email' => $request->email,
                'password' => $request->password
            ]
        );

        SiteAdmin::create([
            'user_id' => $User->id,
            'site_id' => $request->site_id
        ]);

        return redirect()
            ->route('admin.site-admin.create')
            ->withSuccess('Site Admin Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Sites = Site::where('is_delete', '0')->get();
        $item = SiteAdmin::with(['User', 'Site'])->where('user_id', $id)->first();
        return view('web.site-admin.edit', compact('Sites', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteAdmin  $siteAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'unique:users,email,' . $id . ',id',
            'password'  => 'confirmed'
        ]);

        $data = ['name' => $request->name, 'email' => $request->email];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        User::find($id)->update($data);
        SiteAdmin::where('user_id', $id)->update(['site_id' => $request->site_id]);
        return redirect()->back()->withSuccess('Site Admin Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteAdmin  $siteAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User::findorfail($id)->where();
        SiteAdmin::where('user_id', $id)->update(['is_delete' => '1']);
        return redirect()->back()->withSuccess('Site Admin Deleted Successfully');
    }

    public function list_tests()
    {
        $emp = SiteAdmin::where('user_id', Session::get('user_id'))->first();
        $items = Package::with('Customer', 'Employee', 'Site')->where('site_id', $emp->site_id)->get();
        $title = ' Lookup Customer';
        return view('web.employee.lookup', compact('items', 'title'));
    }


    public function SetPositive($id)
    {

        Package::where('id', $id)->update(["status" => Package::POSITIVE]);
        return redirect()->back()->withSuccess('Test result updated successfully');
    }

    public function SetNegative($id)
    {

        Package::where('id', $id)->update(["status" => Package::NEGATIVE]);
        return redirect()->back()->withSuccess('Test result updated successfully');
    }
}

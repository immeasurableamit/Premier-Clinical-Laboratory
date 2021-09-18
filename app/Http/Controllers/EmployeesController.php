<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Package;
use Faker\Provider\Base;
use Faker\Provider\Uuid;
use App\Models\Employees;
use App\Jobs\SendEmailJob;
use App\Models\Temperature;
use Illuminate\Http\Request;
use App\Models\SiteEmployees;
use App\Jobs\EmployeeLoginJob;
use App\Exports\EmployeesExport;
use App\Imports\EmployeesImport;
use App\Models\EmployeeQuestion;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\EmployeePostRequest;

class EmployeesController extends Controller
{
    public $email, $name;
    public $emails, $phones;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Employees::where('is_delete', '0')->get();
        $sites = Site::where('is_delete', '0')->get();

        return view('web.employee.index', compact('items', 'sites'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::all();

        return view('web.employee.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeePostRequest $request)
    {
        $random_password = str_random(10);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'days' => 0,
            'uuid' =>  Uuid::uuid(),
            'password' => Hash::make($random_password)
        ];

        $data['random_password'] = $random_password;

        if (isset($_FILES['image'])) {
            $file = $request->file('image');

            if (!empty($file)) {
                $movingdetsinator = 'photo' . time() . '_' . $file->getClientOriginalName();
                $destinationPath = 'uploads';
                $file->move($destinationPath, $movingdetsinator);
                $image = $movingdetsinator;
                $data['image'] = $image;
            }
        }

        $employees = Employees::create($data);

        SiteEmployees::create(
            [
                'site_id' => $request->site,
                'employee_id' => $employees->id,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d')
            ]
        );

        dispatch(new EmployeeLoginJob($data))->delay(now()->addSeconds(5));

        return redirect()->route('admin.employess.create')->withSuccess('Employee added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sites = Site::where('is_delete', '0')->get();
        $item = Employees::findorfail($id);

        return view('web.employee.edit', compact('item', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeePostRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'days' => $request->days
        ];

        if (isset($_FILES['image'])) {
            $file = $request->file('image');

            if (!empty($file)) {
                $movingdetsinator = 'photo' . time() . '_' . $file->getClientOriginalName();
                $destinationPath = 'uploads';
                $file->move($destinationPath, $movingdetsinator);
                $image = $movingdetsinator;
                $data['image'] = $image;
            }
        }
        Employees::find($id)->update($data);

        return redirect()->route('admin.employess.edit', $id)
            ->withSuccess('Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siteEmployees = SiteEmployees::where(['employee_id' => $id])->first();

        if ($siteEmployees) {
            $siteEmployees->update(['is_delete' => '1']);
        }

        Employees::findorfail($id)->update(['is_delete' => '1']);
        return redirect()->route('admin.employess.index')
            ->withSuccess('Employess deleted Successfully');
    }


    public function Details($id)
    {
        $item = Employees::findorfail($id);

        $screenings = EmployeeQuestion::where('employee_id', $id)->get();
        $temp = Temperature::where('employee_id', $id)->limit(3)->get();
        $test = Package::where('employee_id', $id)->limit(3)->get();

        return view('web.employee.show', compact('item', 'screenings', 'temp', 'test'));
    }

    public function Print($id)
    {
        $item = Employees::findorfail($id);
        return view('web.employee.print', compact('item'));
    }

    public function Assign(Request $request)
    {
        $this->validate(
            $request,
            [
                'site_id' => 'required'
            ]
        );

        SiteEmployees::create([
            'site_id' => $request->site_id,
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'employee_id' => $request->employee_id
        ]);

        return back()->withSuccess('Site Assign Successfully');
    }


    public function ImportView()
    {
        return view('web.employee.import.bulk');
    }

    public function ImportBulk(Request $request)
    {
        return view('web.employee.import.bulk');
    }

    public function ImportStore(Request $request)
    {
        $this->validate($request, [
            'import' => 'required'
        ]);

        $Data = (new EmployeesImport)->toArray($request->file('import'));
        $employees = $Data[0];
        array_shift($employees);
        $formatdata = [];
        $emails = [];
        $phones = [];

        foreach ($employees as $key =>  $value) {
            $GenratePassword = Base::numerify(str_replace(' ', '', $value[0]) . '###');

            array_push($formatdata, [
                'uuid' => Uuid::uuid(),
                'name' => $value[0],
                'email' => $value[1],
                'phone' => $value[2],
                'days' => $value[3],
                'image' => 'undefine.png',
                'device_token' => $GenratePassword,
                'password' => Hash::make($GenratePassword),
            ]);

            array_push($emails, $value[1]);

            if ($value[2] == 'N/A' || $value[2] == 'NA' || $value[2] == '' || $value[2] == '-' || $value[2] == ' - ') {
                // code here
            } else {
                array_push($phones, $value[2]);
            }
        }

        $this->emails = $emails;
        $this->phones = $phones;

        $existrecord = Employees::where('is_delete', '0')->where(function ($query) {
            $query->whereIn('email', $this->emails)
                ->orWhereIn('phone', $this->phones);
        })->get();

        $deletedkeys = [];
        foreach ($existrecord as $value) {
            $key = array_search($value->email, array_column($formatdata, 'email'));
            array_push($deletedkeys, $key);
        }

        foreach ($deletedkeys as $value) {
            unset($formatdata[$value]);
        }

        foreach ($formatdata as $value) {

            SendEmailJob::dispatch(
                $value['email'],
                [
                    'email' => $value['email'],
                    'password' => $value['device_token']
                ]
            );
        }

        Employees::insert($formatdata);

        if (count($existrecord)) {
            return Excel::download(new EmployeesExport($existrecord), 'rejected - ' . now() . '.xlsx');
        }
        return back()->withsuccess('All Records imported successfully ');
    }

    public function historyScreening($id)
    {
        Employees::find($id);
        $items = EmployeeQuestion::where('employee_id', $id)->get();

        return view('web.employee.history.screening', compact('items'));
    }

    public function historyTest($id)
    {
        Employees::find($id);
        $items = Package::where('employee_id', $id)->get();
        return view('web.employee.history.tests', compact('items'));
    }
}

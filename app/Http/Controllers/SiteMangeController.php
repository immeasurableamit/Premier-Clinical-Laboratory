<?php

namespace App\Http\Controllers;

use Mail;
use Session;
use App\Models\Package;
use App\Models\Question;
use Faker\Provider\Base;
use Faker\Provider\Uuid;
use App\Models\Employees;
use App\Jobs\SendEmailJob;
use App\Models\Temperature;
use Illuminate\Http\Request;
use App\Models\SiteEmployees;
use App\Models\EmployeeQuestion;
use Illuminate\Support\Facades\Hash;


class SiteMangeController extends Controller
{
    public function list()
    {
        $items = SiteEmployees::with('Employee')
            ->where('is_delete', '0')
            ->where('site_id', Session::get('site_id'))
            ->get();

        return view('web.employee.index2', compact('items'));
    }

    public function Details($id)
    {
        $item = Employees::findorfail($id);
        $screenings = EmployeeQuestion::where('employee_id', $id)->get();
        $temp = Temperature::where('employee_id', $id)->get();
        $test = Package::where('employee_id', $id)->get();

        return view('web.employee.show', compact('item', 'screenings', 'temp', 'test'));
    }

    public function Screening($id)
    {
        $Screening = EmployeeQuestion::with('Questions')
            ->where('employee_id', $id)
            ->whereDate('created_at', '=', date('Y-m-d'));
        $item = Employees::findorfail($id);
        if ($Screening->exists()) {
            Session::flash('info', 'Employee screening already done');
            $items = $Screening->get();
            $temperature = Temperature::where('employee_id', $id)->whereDate('created_at', '=', date('Y-m-d'))->first();
            return view('web.employee.screening.details', compact('items', 'item', 'temperature'));
        }

        $items = Question::all();
        return view('web.employee.screening', compact('items', 'item'));
    }

    public function ScreeningStore(Request $request)
    {
        // return  $request->question;
        $data = [];
        $risk = 'LOW';
        foreach ($request->question as  $value) {
            if ($request->answer[$value] == 1) {
                $risk = 'HIGH';
            }
            array_push($data, ['question_id' => $value, 'employee_id' => $request->user_id, 'answer' => $request->answer[$value], 'created_at' => now(), 'updated_at' => now()]);
        }
        // return $data;
        EmployeeQuestion::insert($data);

        $temp = (float) $request->temperature;

        if ($temp > 37.00) {
            $risk = 'HIGH';
        }
        Employees::find($request->user_id)->update(['risk_level' => $risk]);
        Temperature::create(['employee_id' => $request->user_id, 'temperature' => $request->temperature]);
        return redirect()->route('admin.manage.details', $request->user_id)->withSuccess('Employess Screening complated Successfully');
    }

    public function Print($id)
    {
        $item = Employees::findorfail($id);
        return view('web.employee.print', compact('item'));
    }

    public function AddInSite()
    {

        return view('web.employee.site.create');
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
            'email' => 'required|unique:employees,email',
            'phone' => 'required',

            'image' => 'required',
        ]);

        $GenratePassword = Base::numerify(str_replace(' ', '', $request->name) . '###');

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'days' => 0,
            'uuid' => Uuid::uuid(),
            'password' => Hash::make($GenratePassword)
        ];

        // return $data;

        $this->email = $request->email;
        $this->name = $request->name;


        SendEmailJob::dispatch($this->email, ['email' => $this->email, 'password' => $GenratePassword]);

        // Mail::send('mail.password', ['email' => $this->email, 'password' => $GenratePassword], function ($message) {
        //     $message->from(config('mail.from.address'), config('app.name'));
        //     $message->sender(config('mail.from.address'), config('app.name'));
        //     $message->to($this->email, $this->name);
        //     $message->cc(config('mail.from.address'), config('app.name'));
        //     $message->bcc(config('mail.from.address'), config('app.name'));
        //     $message->replyTo(config('mail.from.address'), config('app.name'));
        //     $message->subject('Welcome to healthpass ZA Employee Screeening Portal');
        //     $message->priority(1);
        // });

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
        $Employee =    Employees::create($data);

        SiteEmployees::create([
            'site_id' => Session::get('site_id'),
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
            'employee_id' => $Employee->id
        ]);

        return redirect()->route('admin.manage.addinsite')->withSuccess('Employee added successfully');
    }


    public function CheckQr(Request $request)
    {
        $id = base64_decode($request->id);
        return Employees::where(['id' => $id, 'is_delete' => '0'])->first();
    }


    public function TempStore(Request $request)
    {

        Temperature::create(['employee_id' => $request->user_id, 'temperature' => $request->temperature]);

        $temp = (float) $request->temperature;
        if ($temp > 37.00) {
            $risk = 'HIGH';
            Employees::find($request->user_id)->update(['risk_level' => $risk]);
        }
        Session::flash('info', 'Employee temperature recorded');

        return redirect()->route('admin.manage.details', $request->user_id);
    }
}

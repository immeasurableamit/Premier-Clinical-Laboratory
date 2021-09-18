<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Session;
use App\Exports\PackageExport;
use App\Imports\PackageImport;
use App\Models\Employees;
use Maatwebsite\Excel\Facades\Excel;
use File;
use Illuminate\Support\Facades\Http;
use Str;
use Illuminate\Support\Facades\Mail;
use ZipArchive;

class PackageController extends Controller
{

    public $filename;
    public $ZipFile;
    public $ExcelExtesion = '.xlsx';
    public $ZipExtesion = '.zip';
    public $ZipPassword = 'password';

    public function Assign(Request $request)
    {
        $this->validate($request, ['barcode' => 'required', 'secondary_barcode' => 'required']);

        Package::create(
            [
                'package_number' => $request->barcode,
                'secondary_barcode' => $request->secondary_barcode,
                'employee_id' => $request->employee_id,
                'assign_by' => $request->assign_by,
                'site_id' => $request->site_id,
            ]
        );

        return back()->withSuccess('Package assign successfully');
    }


    public function index()
    {
        $items =   Package::with('Employee', 'Site');
        if (Session::has('site_id')) {
            $items->where('site_id', Session::get('site_id'));
        }
        $items =  $items->get();
        return view('web.package.index', compact('items'));
    }
    public function DoneTests()
    {
        $items =   Package::with('Employee', 'Site')->where('status' ,'!=', Package::PENDING);
        if (Session::has('site_id')) {
            $items->where('site_id', Session::get('site_id'));
        }
         $items =  $items->get();
        return view('web.package.done', compact('items'));
    }
    public function Export()
    {
        $items =   Package::with('Employee', 'Site');
        if (Session::has('site_id')) {
            $items->where('site_id', Session::get('site_id'));
        }

        $items =  $items->where('status', Package::PENDING)->get();

        return view('web.package.export', compact('items'));
    }
    public function ExcelExport()
    {

        $this->filename = Session::get('site_name') . '_' . date('h-m-i d-m-Y');
        Excel::store(new PackageExport, $this->filename.$this->ExcelExtesion, 'exports');

        $this->ZipFile = public_path('zip/'.$this->filename.$this->ZipExtesion);
        $zip = new ZipArchive;

        if ($zip->open($this->ZipFile, ZipArchive::CREATE) === TRUE) {

            $zip->addFile(public_path('exports/'.$this->filename.$this->ExcelExtesion),
            $this->filename.$this->ExcelExtesion);
            $zip->setEncryptionName($this->filename.$this->ExcelExtesion, ZipArchive::EM_AES_256, $this->ZipPassword);
            $zip->close();

        }

        Mail::send('mail.test', [], function ($message) {
            $message->to(Session::get('email'), Session::get('site_name'));
            $message->subject( $this->filename . '-' . now());
            $message->priority(1);
            $message->attach($this->ZipFile);
        });

        return redirect()->back()->withsuccess('Document sent you email | please check your mail');
    }


    public function Import()
    {
        $path = public_path('Imports');
        $files = scandir($path);

        $data = [];
        foreach ($files as $INDEX => $in) {

            if (str_contains($in, '.xlsx')) {
                $FilesData = (new PackageImport)->toArray(public_path('Imports/' . $in));
                array_push($data, $FilesData[0]);
                rename(public_path('Imports/' . $in), public_path('Imports/old/' . $in));
            }
        }

        foreach ($data as $file) {

            foreach ($file as $p_index => $package) {
                if ($p_index == 0) {
                    continue;
                }


                $emp = Employees::find($package[1]);

                $riskhigh = '';
                $message = '';
                $valid_up_to_date = date('Y-m-d', strtotime("0 days"));
                switch (Str::upper($package[2])) {
                    case 'PENDING':
                        $status  = 0;

                        break;
                    case 'POSITIVE':
                        $status  = 1;
                        $riskhigh = 'HIGH';
                        $message = 'Your COVID test has been completed and returned as POSITIVE';
                        $valid_up_to_date = date('Y-m-d', strtotime("0 days"));
                        break;

                    case 'NEGATIVE':
                        $status  = 2;
                        $riskhigh = 'LOW';
                        $message = 'Your COVID test has been completed and returned as NEGATIVE';
                        $valid_up_to_date = date('Y-m-d', strtotime( $emp->days." days"));

                        break;

                    default:
                        $status  = 0;
                        break;
                }

                $code = '27';
                if($emp->phone == '8950357771'){
                    $code = '91';
                }
                Http::get('https://platform.clickatell.com/messages/http/send?apiKey=eFLxbSMPStum1wsqJhxx3w==&to='.$code.$emp->phone.'&content='.$message);


                // SMSController::Send($emp->phone ,$message ?? '-');
                // if($message){

                // }

                $emp->update(['current_test_status'=>Str::upper($package[2]),'risk_level' => $riskhigh, 'test_expire_date' => $valid_up_to_date]);
                Package::where('package_number', $package[0])->update(
                    [
                        'status' => $status,
                        'genes' => $package[3],
                        's_gene' => $package[4],
                        'n_gene' => $package[5],
                        'orf_1_ab' => $package[6],
                         'updated_at' => date('Y-m-d h:m:i')

                ]);
            }
        }

        foreach ($files as $INDEX => $in) {
        }


        $data;
    }


    public function ComplateTest()
    {
        $title = 'Done Tests';
        $items = Package::whereIn('status', [Package::POSITIVE, Package::NEGATIVE])->get();
        return view('web.package.show', compact('title', 'items'));
    }


}

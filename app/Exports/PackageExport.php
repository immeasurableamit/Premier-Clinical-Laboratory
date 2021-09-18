<?php

namespace App\Exports;

use App\Models\Package;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Session;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PackageExport implements FromView , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Package::all();
    // }

    public function view(): View
    {
        return view('exports.package', [
            'Package' => Package::where(['site_id'=> Session::get('site_id'),'status' => Package::PENDING])->get()
        ]);
    }
}

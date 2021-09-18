<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class EmployeesExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
         return view('exports.employee', [
                'items' => $this->data
         ]);
    }
}

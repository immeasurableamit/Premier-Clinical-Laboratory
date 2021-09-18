<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeesImport implements ToModel
{
   use Importable;
   /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
   public function model(array $row)
   {
    return $row;
   }
}

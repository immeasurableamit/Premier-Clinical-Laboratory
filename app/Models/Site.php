<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SiteEmployees;

class Site extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','is_delete'];


    public function EmployeeCount()
    {
        return SiteEmployees::withsite($this->id)->active()->count();
    }

}

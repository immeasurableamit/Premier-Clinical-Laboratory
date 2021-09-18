<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Faker\Provider\Uuid;
use Illuminate\Cache\RateLimiting\Limit;

class Employees extends Model
{
    use HasFactory;


    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'image',
        'start_date',
        'end_date',
        'is_delete',
        'password',
        'is_active',
        'is_login',
        'device_id',
        'device_token',
        'days',
        'test_expire_date',
        'risk_level',
        'current_test_status'
    ];


    public function AssigneSite()
    {
        return SiteEmployees::with('Site')
        ->where('employee_id',$this->id)->first();

        return 0;
    }


    public function Status()
    {
        return SiteEmployees::with('Site')
        ->where('employee_id',$this->id)->exists();
        return 0;
    }

    public function EmployeeID()
    {

        return 'EMP-'. sprintf('%05d',$this->id) ;
    }

    // public function setUuidAttribute($key, $value)
    // {
    //     return
    // }

    public function getImageAttribute($value)
    {
        if (!$value) {
            return 'http://placehold.it/160x160';
        }

        return config('app.url').'/uploads/'.$value;

    }

    public function screenings($limit = null){


        $query = EmployeeQuestion::where('employee_id',$this->id);
        if($limit){
            $query->limit($limit);
        }
        return $query->latest()->get();
    }

    public function Temperature($limit = null)
    {
        $query =Temperature::where('employee_id',$this->id);
        if($limit){
            $query->limit($limit);
        }
        return $query->latest()->get();
    }

    public function Package($limit = null)
    {
        $query = Package::where('employee_id',$this->id);
         if($limit){
            $query->limit($limit);
        }
        return $query->latest()->get();
    }

}

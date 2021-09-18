<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['uuid','first_name','last_name','dob','email','password','phone','image','email_otp','mobile_otp','email_verify_status','mobile_verify_status','gender'];



    public function Age()
    {

        return date('Y') - date('Y',strtotime($this->dob));
    }


    public function Gender()
    {
        

        return config('constant.gender')[$this->gender];
    }



}

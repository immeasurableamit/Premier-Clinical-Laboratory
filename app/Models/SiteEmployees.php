<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteEmployees extends Model
{
    use HasFactory;

    protected $fillable = ['site_id','employee_id','start_date','end_date','is_delete'];


    public function Site()
    {
        return  $this->hasOne(Site::class,'id','site_id');
    }

    public function Employee()
    {
        return  $this->hasOne(Employees::class,'id','employee_id');
    }

    public function scopeActive($query)
    {
        return $query->where('end_date', '>=', date('d-m-y'));
    }



    public function scopeWithsite($query,$id)
    {
        return $query->where('site_id',$id);
    }

}

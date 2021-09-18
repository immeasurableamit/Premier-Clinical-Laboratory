<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employees;
use App\Models\Customers;
use App\Models\Site;

class Package extends Model
{

    use HasFactory;
    CONST POSITIVE = 1;
    CONST NEGATIVE = 2;
    CONST PENDING = 0;

    CONST ANTIGEN = 1;
    CONST PCR = 2;




    CONST PACKAGE_REQUESTED = 'Requested';
    CONST PACKAGE_PENDING = 'Pending';
    CONST PACKAGE_COMPLETED = 'Completed';


    protected $fillable =
    [
        'package_number','secondary_barcode','site_id',
        'employee_id','assign_by','status','updated_at',
        'orf_1_ab','genes','s_gene','n_gene','orf_1_ab',
        'package_type','customer_id','collected_by','package_status','book_date','sample_date'
];

    public function Employee()
    {
        return $this->hasOne(Employees::class,'id','employee_id');
    }
    public function Customer()
    {
        return $this->hasOne(Customers::class,'id','customer_id');
    }

    public function Report()
    {

        return config('constant.status')[$this->status];
    }



    public function ReportLable()
    {
        return config('constant.status-label')[$this->status];
    }


    public function Type($shorthand = false)
    {
        if($shorthand){
            return config('constant.test-type-shorthand')[$this->package_type];
        }
        return config('constant.test-type')[$this->package_type];
    }


    public function TypeLable()
    {
        return config('constant.test-type-label')[$this->package_type];
    }



    public function Site()
    {

        return $this->hasOne(Site::class,'id','site_id');
    }

    public function SiteName()
    {
        $Site = Site::find($this->site_id);

        if($Site){
            return $Site->name;
        }
        return ' Deleted ';

    }

    public function SiteAddress()
    {
        $Site = Site::find($this->site_id);

        if($Site){
            return $Site->address;
        }
        return ' Deleted ';

    }











}

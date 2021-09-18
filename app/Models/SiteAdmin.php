<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Site;
use App\Models\User;

class SiteAdmin extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'site_id', 'is_delete'];


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Site()
    {
        return  $this->belongsTo(Site::class, 'site_id', 'id');
    }

    public function Sitename()
    {
        return Site::find($this->site_id)->name;
    }
}

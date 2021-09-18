<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class EmployeeQuestion extends Model
{
    use HasFactory;

    protected $table = 'employee_questions';
    protected $fillable = ['question_id','employee_id','answer'];



    public function Questions()
    {
        return $this->hasOne(Question::class,'id','question_id');
    }


    public function Answers()
    {
        return config('constant.Answer')[$this->answer];
    }

    public function AnswersLables()
    {
    return config('constant.Answer-lable')[$this->answer];
    }



}

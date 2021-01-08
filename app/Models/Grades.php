<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;

    public function school()
    {
        return $this->belongsTo(School::class);
    }


    public static function getGradesBySchoolId($sch_id)
    {
       return self::where('status',1)->where('school_id',$sch_id)
            ->select('id','school_id','grade_name','subject','price','class_hour','types')
            ->get()
            ->toArray();
    }
}

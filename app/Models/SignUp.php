<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','user_name','gender','idnumber','school_id','sign_type','status','sign_time'];

    public function school()
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function getSignTimeAttribute($sign_time)
    {
        return date("Y-m-d H:i:s",$sign_time);
    }

    public function exam()
    {
        return $this->hasMany(Exam::class,'sign_id','id');
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public static function getSignUps($user_id)
    {
       return self::where('user_id',$user_id)
           ->with('exam','school')
           ->with('school')
           ->where('status',1)
           ->first();
    }
}

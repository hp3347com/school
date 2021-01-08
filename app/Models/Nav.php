<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    use HasFactory;

    public static function getNav()
    {
       return self::where('status',1)->orderBy('sort','ASC')
           ->select('id','title','image','link')->get()->toArray();
    }

    public function getImageAttribute($image)
    {
        return toMedia($image);
    }
}

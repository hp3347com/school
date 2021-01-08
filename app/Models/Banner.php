<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;

    public function getPositionAttribute($position)
    {
        return json_decode($position);
    }
    public static function getBanner($position=0)
    {
        return self::where('position','like',"%$position%")->select('title','image','link')->get()->toArray();
    }

    public function getImageAttribute($image)
    {
        return toMedia($image);
    }

    public static function positionValue()
    {
        return [
            1=>'首页',
            2=>'详情页',
            3=>'驾校页'
        ];
    }
}

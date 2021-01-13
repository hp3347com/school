<?php

namespace App\Models;

use App\Admin\Controllers\SchoolController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Teacher extends Model
{
    use HasFactory;

    public function getTagsAttribute($tag)
    {
        return json_decode($tag,true);
    }

    public function setTagsAttribute($tag)
    {
        return $this->attributes['tags'] = json_encode($tag);
    }
    /**
     * 多对一关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public static function getYuYueTeachersInSchool($school_id)
    {
        return self::where('school_id',$school_id)
            ->select('id','teach_name')
            ->where('status',1)
            ->get()->toArray();
    }
}

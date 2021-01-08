<?php

namespace App\Models;

use App\Admin\Controllers\SchoolController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function getTagsAttribute($tag)
    {
        return json_decode($tag,true);
    }

    /**
     * 多对一关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}

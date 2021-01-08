<?php

namespace App\Models;

use App\Services\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory,ModelTrait;

    public function setImagesAttribute($image)
    {
        if (is_array($image)) {
            $this->attributes['images'] = json_encode($image);
        }
    }

    public function getImagesAttribute($image)
    {
        return json_decode($image, true);
    }

    public function getSchoolLogoAttribute($school_logo)
    {
        return toMedia($school_logo);
    }
    /**
     * 设置标签
     * @param $tags
     */
    public function setTagsAttribute($tags)
    {
        if (is_array($tags)) {
            $this->attributes['tags'] = json_encode($tags);
        }
    }

    /**
     * 获取标签
     * @param $tags
     * @return mixed
     */
    public function getTagsAttribute($tags)
    {
        return json_decode($tags, true);
    }

    /**
     * 一对多关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    /**
     * 班次
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grades()
    {
        return $this->hasMany(Grades::class);
    }
    public static function getOption()
    {
        $school = self::getAll();
        $option=[];
        foreach ($school as $k=>$v){
            $option[$v['id']]=$v['school_name'];
        }
        return $option;
    }


    /**
     * 首页驾校推荐
     * @return mixed
     */
    public static function getRecommand()
    {
        $school=self::where('status',1)->where('is_recomment',1)
            ->select('id','school_name','sub_name','school_logo','score','tags')
            ->orderBy('sort','desc')->get()->toArray();
        if($school){
            foreach ($school as $k=>&$v){
                $v['price'] = self::getLowerPrice($v['id']);
            }
        }
        return $school;
    }

    /**
     * 驾校最低价
     * @param $sch_id
     * @return int|mixed
     */
    public static function getLowerPrice($sch_id)
    {
        $grads = Grades::getGradesBySchoolId($sch_id);
        $grads = array_column($grads,'price');
        if(count($grads)){
            return min($grads);
        }
       return 0;
    }

    /**
     * 驾校列表
     * @return mixed
     */
    public static function getList()
    {
       return self::where('status',1)->select('id','school_name')->get()->toArray();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/11
 * Time: 17:41
 */

namespace App\Services;

use Illuminate\Support\Facades\DB;
trait  ModelTrait
{
    private static $errorMsg;

    private static $transaction = 0;

    private static $DbInstance = [];

    private static $error = '操作失败,请稍候再试!';

    /**
     * 设置错误信息
     * @param string $errorMsg
     * @param bool $rollback
     * @return bool
     */
    protected static function setErrorInfo($errorMsg= "操作失败,请稍候再试!",$rollback=false)
    {
        if($rollback){
            self::rollbackTrans();
        }
        self::$errorMsg = $errorMsg;
        return false;
    }

    /**
     * 获取错误信息
     * @param string $defaultMsg
     * @return string
     */
    public static function getErrorInfo($defaultMsg ='操作失败,请稍候再试!')
    {
        return !empty(self::$errorMsg) ? self::$errorMsg : $defaultMsg;
    }

    /**
     * 开启事务
     */
    public static function beginTrans()
    {
        DB::beginTransaction();
    }

    /**
     * 回滚事务
     */
    public static function rollbackTrans()
    {
        DB::rollBack();
    }

    /**
     * 提交事务
     */
    public static function commitTrans()
    {
        DB::commit();
    }

    /**
     * 根据结果提交滚回事务
     * @param $res
     */
    public static function checkTrans($res)
    {
        if ($res) {
            self::commitTrans();
        } else {
            self::rollbackTrans();
        }
    }

    /**
     * 查询一条数据是否存在
     * @param $map
     * @param string $field
     * @return bool 是否存在
     */
    public static function be($map, $field = '')
    {
        $model = (new self);
        if (!is_array($map) && empty($field)) $field = $model->getKey();
        $map = !is_array($map) ? [$field => $map] : $map;
        return 0 < $model->where($map)->count();
    }

    /**
     * 获取所有数据
     * @return mixed
     */
    public static function getAll()
    {
        $model = (new self);
        return $model->get()->toArray();
    }
}
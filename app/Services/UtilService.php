<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/11
 * Time: 19:51
 */


    /**
     * 操作失败
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function fails($msg='',$code=0)
    {
        return response()->json([
            'code'=>$code,
            'msg'=>$msg
        ]);
    }

    /**
     * 返回成功
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    function success($data=[])
    {
        return response()->json([
            'code'=>200,
            'res'=>$data
        ]);
    }

    function toMedia($image)
    {
        if(!$image){
            return '';
        }
        if(!preg_match("/^http(s)?:\\/\\/.+/",$image)){
            return config('app.url')."/upload/".$image;
        }
        return $image;
    }


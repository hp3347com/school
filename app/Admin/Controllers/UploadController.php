<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2020/12/25
 * Time: 19:27
 */

namespace App\Admin\Controllers;

use Illuminate\Http\Request;
use Encore\Admin\Controllers\AdminController;
use Illuminate\Support\Str;

class UploadController extends AdminController
{
    public function uploadImage(Request $request)
    {
        $files = $request->file('images');
        if(!empty($files)){
            if(count($files)> 25){
                return response()->json(['code'=>6,'msg'=>'最多上传25张']);
            }
            $m = 0;
            $k = 0;
            $exts = ['jpg', 'png', 'gif', 'jpeg'];
            $msg='';
            $return=[];
            foreach ($files as $key=>$file){
                $n =$key+1;
                $ext = strtolower($file->extension());
                if(!in_array($ext,$exts)){
                    $return[] = ['code' => 2, 'info' =>$n. '上传文件不合法'];
                }else{
                    $filename = time() . Str::random(6) . "." . $ext;
                    $filepath = 'uploads/images/' . date('Ym') . '/';
                    if (!file_exists($filepath)) {
                        @mkdir($filepath);
                    }
                    $savepath = config('app.url') . '/' . $filepath . $filename;
                    if ($file->move($filepath, $filename)) {
                        $data[] = $savepath;
                        $m +=1;
                    }else{
                        $k +=1;
                    }
                    $msg = $m . "张图片上传成功 " . $k . "张图片上传失败<br>";
                    $return[] = ['code' => 0, 'info' => $msg, 'newFileName' => $savepath];
                }
            }
        }else{
            $return = ['code' => 5, 'info' => "请选择一个文件"];
        }
        return response()->json($return);
    }
}
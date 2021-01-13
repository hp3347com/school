<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController  extends Controller
{
    /**
     * 图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $file = $request->file('image');
        if(!$file){
            return fails('上传图片为空');
        }
        $exts = ['jpg', 'png', 'gif', 'jpeg'];

        $ext = strtolower($file->extension());
        if(!in_array($ext, $exts)){
            return fails('请上传正确的图片类型');
        }
        $filename = time() . Str::random(6) . "." . $ext;
        $filepath = 'uploads/license/' . date('Ym') . '/';
        if (!file_exists($filepath)) {
            @mkdir($filepath);
        }
        $savepath = config('app.url') . '/' . $filepath . $filename;
        if ($file->move($filepath, $filename)) {
            $img = $savepath;
            return  success(['image' => $img]);
        }
        return fails('上传失败');
    }
}
